<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addTypeForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="type_id" value="{{ old('type_id', $type->id ?? '') }}">
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $type->name ?? '') }}" aria-describedby="emailHelp">
                <span class="text-danger error-text name_error"></span>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Select Image</label>
                <input class="form-control mb-2" type="file" name="image" id="image">
                @if (!@empty($type->image))
                    <img src="{{ asset('uploads/'. $type->image )}}" alt="Type image" width="80px;">
                @endif
                <span class="text-danger error-text image_error"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
