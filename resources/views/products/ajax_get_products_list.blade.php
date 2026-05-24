@if ($products->count() > 0)
    @foreach ($products as $product)
        <tr>
            <td>
                <img src="{{ asset('uploads/'. $product->images) }}" alt="product image" width="80">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->type->name ?? '' }}</td>
            <td>₹{{ number_format($product->price, 2) }}</td>
            <td>₹{{ number_format($product->discount, 2) }}</td>
            <td>
                @if($product->is_add_to_list)
                    <span class="badge bg-success">Yes</span>
                @else
                    <span class="badge bg-secondary">No</span>
                @endif
            </td>
            <td>{{ ucfirst($product->metal_type) }}</td>
            <td>{{ $product->weight }} g</td>
            <td>{{ $product->qty }}</td>
            <td>
                @if($product->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                <a href="#" class="btn btn-warning editBtn" data-id="{{ $product->id }}">Edit</a>
                <a href="#" class="btn btn-danger deleteBtn" data-id="{{ $product->id }}">Delete</a>
            </td>
        </tr>
    @endforeach
@else
        <tr>
            <td colspan="11" class="text-center">No Data Found</td>
        </tr>
@endif
