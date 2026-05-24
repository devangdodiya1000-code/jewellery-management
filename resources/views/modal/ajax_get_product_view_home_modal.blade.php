<div class="modal fade quick-view-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $product->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4 align-items-center">
          <div class="col-md-5">
            @if ($product->images)
              <img
                src="{{ asset('uploads/' . $product->images) }}"
                alt="{{ $product->name }}"
                class="quick-view-image"
              >
            @else
              <div class="quick-view-image d-flex align-items-center justify-content-center">
                No image
              </div>
            @endif
          </div>
          <div class="col-md-7">
            <div class="product-meta mb-2">
              <span>{{ $product->type->name ?? 'Jewellery' }}</span>
              <span>{{ $product->qty > 0 ? 'In Stock' : 'Out of Stock' }}</span>
            </div>

            <h3 class="quick-view-title mb-3">{{ $product->short_description ?: $product->name }}</h3>

            @if ($product->description)
              <p class="quick-view-text mb-4">{{ $product->description }}</p>
            @endif

            <div class="product-details mb-4">
              <div class="product-detail">
                <span>Metal</span>
                <strong>{{ ucfirst($product->metal_type) }}</strong>
              </div>
              <div class="product-detail">
                <span>Weight</span>
                <strong>{{ $product->weight ? $product->weight . ' g' : '-' }}</strong>
              </div>
            </div>

            <div class="product-price">
              <span class="current">₹{{ number_format($product->price - $product->discount, 2) }}</span>
              @if ($product->discount > 0)
                <span class="original">₹{{ number_format($product->price, 2) }}</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-to-cart-btn" data-id="{{ $product->id }}">Add Bag</button>
      </div>
    </div>
  </div>
</div>
