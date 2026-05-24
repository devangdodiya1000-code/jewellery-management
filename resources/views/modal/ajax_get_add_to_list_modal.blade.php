@if ($products->count() > 0)
  @foreach ($products as $product)
    <article class="cart-item">
      @if ($product->images)
        <img class="cart-item-image" src="{{ asset('uploads/' . $product->images) }}" alt="{{ $product->name }}">
      @else
        <div class="cart-item-image d-flex align-items-center justify-content-center">No image</div>
      @endif

      <div class="cart-item-info">
        <h3 class="cart-item-name">{{ $product->name }}</h3>
        <div class="cart-item-meta">
          <span>{{ ucfirst($product->metal_type) }}</span>
          <span>{{ $product->weight ? $product->weight . ' g' : '-' }}</span>
        </div>
        <div class="cart-item-row">
          <div class="cart-qty">
            <button type="button" aria-label="Decrease quantity">-</button>
            <span>1</span>
            <button type="button" aria-label="Increase quantity">+</button>
          </div>
          <strong class="cart-item-price">₹{{ number_format(max(0, $product->price - $product->discount), 2) }}</strong>
        </div>
      </div>
    </article>
  @endforeach
@else
  <div class="text-center py-4">
    <p class="mb-0">No products added.</p>
  </div>
@endif
