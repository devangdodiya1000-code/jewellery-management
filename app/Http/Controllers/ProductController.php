<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() {
        $title = 'Products';

        return view('products/index', compact('title'));
    }

    public function get() {
        $products = Product::with('type')->orderBy('id', 'desc')->get();

        $html = view('products/ajax_get_products_list', compact('products'))->render();

        return response()->json([
            'status' => 1,
            'message' => 'Product listed successfully.',
            'html' => $html,
        ]);
    }

    public function create() {
        $title = "Add Products";
        $types = Type::where('status', 1)->get();
        $product = null;

        $html = view('products/ajax_get_add_products_modal', compact('title', 'types', 'product'))->render();

        return response()->json([
            'status' => 1,
            'message' => 'product create modal open successfully.',
            'html' => $html,
        ]);
    }

    public function store(Request $request) {

        $product_id = $request->product_id;

        $product = $request->validate([
            'name' => ($request->product_id ? 'required|string|max:255' : 'required|string|max:255|unique:products,name'),
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'type_id' => 'required|integer|exists:types,id',
            'price' => 'required|numeric|min:0',
            'is_add_to_list' => 'required|boolean',
            'discount' => 'nullable|numeric|min:0',
            'metal_type' => 'required|string|max:100',
            'weight' => 'required|numeric|min:0',
            'status' => 'required|boolean',
            'qty' => 'required|integer|min:0',
            // 'images' => 'nullable|array',
            'images' => ($request->product_id ? 'nullable' : 'required').'|mimes:jpeg,png,jpg,webp',
        ]);

        $name_slug = Str::slug($request->name, '_');

        if($request->hasFile('images') && $request->file('images')) {
            $file = $request->file('images');

            $file_name = time(). '.' .$file->getClientOriginalExtension();

            $path = public_path('uploads');

            if(!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $file_name);

            $product['images'] = $file_name;
        }

        $product['slug'] = $name_slug;

        if(!empty($product_id)){
            $productData = Product::find($product_id);
            $productData->update($product);
        }else {
            $product = Product::create($product);
        }

        return response()->json([
            'status' => 1,
            'message' => 'product added successfully.',
        ]);
    }

    public function destroy($id) {
        $product = Product::find($id);

        $product->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Product delete successfully.',
        ]);
    }

    public function edit($id) {
        $title = "Product edit modal";
        $product = Product::find($id);
        $types = Type::where('status', 1)->get();

        $html = view('products/ajax_get_add_products_modal', compact('title', 'types', 'product'))->render();

        return response()->json([
            'status' => 1,
            'message' => 'Modal open successfully.',
            'html' => $html,
        ]);
    }
}
