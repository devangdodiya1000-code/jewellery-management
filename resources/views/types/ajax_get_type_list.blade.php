@if ($types->count() > 0)
    @foreach ($types as $type)
        <tr>
            <td>
                <img src="{{ asset('uploads/'. $type->image) }}" width="100px;" alt="type image">
            </td>
            <td>{{ $type->name }}</td>
            <td>
                @if ($type->status == 1)
                    <button class="btn btn-primary">Active</button>
                @else
                    <button class="btn btn-danger">Inactive</button>
                @endif
            </td>
            <td>
                <a href="#" class="btn btn-warning editBtn" data-id="{{ $type->id }}">Edit</a>
                <a href="#" class="btn btn-danger deleteBtn" data-id="{{ $type->id }}">delete</a>
            </td>
        </tr>
    @endforeach
@else
        <tr>
            <td colspan="4">No data found</td>
        </tr>
@endif
