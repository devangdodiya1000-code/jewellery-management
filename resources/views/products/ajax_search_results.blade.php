@php
    /** @var \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection $products */
@endphp

@if(!isset($products))
  <div class="text-white" style="padding:12px 14px;">No results</div>
@else
  @if($products->count() > 0)
    <div class="search-results-list">
      @foreach($products as $product)
        <button
          type="button"
          class="search-result-item"
          data-product-id="{{ $product->id }}"
          data-name="{{ $product->name }}"
          data-category="{{ $product->type->name ?? 'Jewellery' }}"
          data-image="{{ asset('uploads/'. $product->images) }}"
          data-description="{{ $product->description }}"
          data-price="₹{{ number_format(max(0, $product->price - $product->discount), 2) }}"
          data-metal="{{ ucfirst($product->metal_type) }}"
          data-weight="{{ $product->weight ? $product->weight . ' g' : '-' }}"
          aria-label="View {{ $product->name }}"
        >
          <img class="search-result-thumb" src="{{ asset('uploads/'. $product->images) }}" alt="{{ $product->name }}">
          <div class="search-result-text">
            <div class="search-result-title">{{ $product->name }}</div>
            <div class="search-result-meta">
              <span>{{ $product->type->name ?? 'Aurum Edit' }}</span>
              <span>•</span>
              <span>{{ ucfirst($product->metal_type) }}</span>
            </div>
          </div>
        </button>
      @endforeach
    </div>
  @else
    <div class="text-white" style="padding:12px 14px; opacity:0.7;">No products found</div>
  @endif
@endif

<style>
  /* Scoped styling for the search dropdown */
  .search-results-list{display:flex;flex-direction:column;gap:8px;padding:10px 0;}
  .search-result-item{
    width:100%;
    display:flex;
    align-items:center;
    gap:12px;
    text-align:left;
    background:rgba(8,8,8,0.0);
    border:0;
    padding:10px 14px;
    color:#fff;
    cursor:pointer;
    border-radius:10px;
  }
  .search-result-item:hover{background:rgba(212,175,55,0.07);}
  .search-result-thumb{
    width:42px;
    height:42px;
    object-fit:contain;
    border:1px solid rgba(212,175,55,0.18);
    background:#050505;
    border-radius:8px;
    padding:6px;
    flex-shrink:0;
  }
  .search-result-text{min-width:0;}
  .search-result-title{font-family:var(--font-serif);font-size:16px;line-height:1.15;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
  .search-result-meta{margin-top:3px;display:flex;gap:8px;align-items:center;color:rgba(255,255,255,0.55);font-size:11px;letter-spacing:1px;text-transform:uppercase;}
</style>

