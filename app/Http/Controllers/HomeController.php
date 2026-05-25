<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function searchProducts(Request $request)
    {
        $validated = $request->validate([
            'q' => 'required|string|min:1|max:255',
        ]);

        $q = trim($validated['q']);

        $products = Product::with('type')
            ->where('status', 1)
            ->where(function ($query) use ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%')
                    ->orWhere('metal_type', 'LIKE', '%' . $q . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $q . '%')
                    ->orWhere('description', 'LIKE', '%' . $q . '%');
            })
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        $html = view('products.ajax_search_results', compact('products'))->render();

        return response()->json([
            'status' => 1,
            'message' => 'Search results fetched successfully.',
            'html' => $html,
        ]);
    }

    public function index() {

        $products = Product::with('type')
            ->where('status', 1)
            ->get();

        return view('frontend/index', compact('products'));
    }

    public function home_view($id) {
        $product = Product::with('type')->findOrFail($id);
        $html = view('modal/ajax_get_product_view_home_modal', compact('product'))->render();

        return response()->json([
            'status' => 1,
            'message' => 'Product render successfully.',
            'html' => $html
        ]);
    }

    public function add_to_list() {
        $products = Product::with('type')
            ->where('status', 1)
            ->where('is_add_to_list', 1)
            ->orderBy('id', 'desc')
            ->get();

        $subtotal = $products->sum(function ($product) {
            return max(0, $product->price - $product->discount);
        });

        $html = view('modal/ajax_get_add_to_list_modal', compact('products'))->render();

        return response()->json([
            'status' => 1,
            'message' => 'Add to list render successfully.',
            'html' => $html,
            'count' => $products->count(),
            'subtotal' => '₹' . number_format($subtotal, 2),
        ]);
    }

    public function store_add_to_list($id) {
        $product = Product::where('status', 1)->findOrFail($id);

        if (!$product->is_add_to_list) {
            $product->update([
                'is_add_to_list' => 1,
            ]);
        }

        return $this->add_to_list();
    }

    public function checkout(Request $request, $id) {
        $validated = $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $product = Product::with('type')
            ->where('status', 1)
            ->findOrFail($id);

        if ($product->qty < $validated['qty']) {
            return response()->json([
                'status' => 0,
                'message' => 'Requested quantity is not available.',
            ], 422);
        }

        $stripeSecret = config('services.stripe.secret');

        if (blank($stripeSecret)) {
            return response()->json([
                'status' => 0,
                'message' => 'Stripe secret key is not configured.',
            ], 500);
        }

        $unitAmount = (int) round(max(0, $product->price - $product->discount) * 100);

        if ($unitAmount < 100) {
            return response()->json([
                'status' => 0,
                'message' => 'Product price must be at least ₹1.00.',
            ], 422);
        }

        try {
            $stripe = new StripeClient($stripeSecret);
            $productData = [
                'name' => $product->name,
            ];

            if (filled($product->short_description ?: $product->description)) {
                $productData['description'] = str($product->short_description ?: $product->description)
                    ->limit(900, '')
                    ->toString();
            }

            $session = $stripe->checkout->sessions->create([
                'mode' => 'payment',
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'inr',
                        'unit_amount' => $unitAmount,
                        'product_data' => $productData,
                    ],
                    'quantity' => $validated['qty'],
                ]],
                'metadata' => [
                    'product_id' => (string) $product->id,
                    'quantity' => (string) $validated['qty'],
                ],
                'success_url' => route('home') . '?payment=success&session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('home') . '?payment=cancelled',
            ]);

            return response()->json([
                'status' => 1,
                'checkout_url' => $session->url,
            ]);
        } catch (ApiErrorException $exception) {
            return response()->json([
                'status' => 0,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
}
