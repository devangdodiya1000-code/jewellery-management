<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModalLabel">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="addProductForm" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="product_id" value="{{ old('product_id', $product->id ?? '') }}">
            <div class="modal-body">
                <div class="row">
                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <!-- Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Type</label>
                        <select name="type_id" class="form-control">
                            <option value="">Select Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id', $product->type_id ?? '') == $type->id  ? 'selected' : ''}}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text type_id_error"></span>
                    </div>

                    <!-- Price -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control">
                        <span class="text-danger error-text price_error"></span>
                    </div>

                    <!-- Discount -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Discount</label>
                        <input type="number" step="0.01" name="discount" value="{{ old('discount', $product->discount ?? '') }}" class="form-control" value="0">
                        <span class="text-danger error-text discount_error"></span>
                    </div>

                    <!-- Add To List -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Add To List</label>
                        <select name="is_add_to_list" class="form-control">
                            <option value="1" {{ old('is_add_to_list', $product->is_add_to_list ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_add_to_list', $product->is_add_to_list ?? '0') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        <span class="text-danger error-text is_add_to_list_error"></span>
                    </div>

                    <!-- Metal Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Metal Type</label>
                        <select name="metal_type" class="form-control">
                            <option value="gold" {{ old('metal_type', $product->metal_type ?? '') == 'gold' ? 'selected' : '' }}>Gold</option>
                            <option value="silver" {{ old('metal_type', $product->metal_type ?? '') == 'silver' ? 'selected' : '' }}>Silver</option>
                            <option value="platinum" {{ old('metal_type', $product->metal_type ?? '') == 'platinum' ? 'selected' : '' }}>Platinum</option>
                        </select>
                        <span class="text-danger error-text metal_type_error"></span>
                    </div>

                    <!-- Weight -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Weight (g)</label>
                        <input type="number" step="0.001" name="weight" value="{{ old('weight', $product->weight ?? '') }}" class="form-control">
                        <span class="text-danger error-text weight_error"></span>
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="qty" value="{{ old('qty', $product->qty ?? '') }}" class="form-control" value="0">
                        <span class="text-danger error-text qty_error"></span>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $product->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $product->status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <span class="text-danger error-text status_error"></span>
                    </div>

                    <!-- Image -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="images" class="form-control">
                        @if (!@empty($product->images))
                            <img src="{{ asset('uploads/'. $product->images) }}" alt="product-image">
                        @endif
                        <span class="text-danger error-text images_error"></span>
                    </div>

                    <!-- Short Description -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="2">
                            {{ old('short_description', $product->short_description ?? '') }}
                        </textarea>
                        <span class="text-danger error-text short_description_error"></span>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">
                            {{ old('description', $product->description ?? '') }}
                        </textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>
