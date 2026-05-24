<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-right mb-2">
                <a href="#" class="btn btn-success" id="addTypeModel">Add Type</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="typeData">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="modalContainer"></div>
</x-app-layout>
<script>
    $(document).ready(function(){
        getType();
    });

    function getType() {
        $.ajax({
            url: "{{ route('types.get') }}",
            type: "GET",
            success: function(response) {
                if(response.status) {
                    $('#typeData').html(response.html);
                }
            }
        })
    }

    $(document).on('click', '#addTypeModel', function() {
        $.ajax({
            url: "{{ route('types.create') }}",
            type: "GET",
            success: function(response) {
                if(response.status){
                    $('#modalContainer').html(response.html);

                    let modalEl = document.getElementById('exampleModal');
                    let modal = new bootstrap.Modal(modalEl);

                    modal.show();
                }
            }
        });
    });

    $(document).on('click', '.editBtn', function() {
        let type_id = $(this).data('id');

        let url = "{{ route('type.edit', ':id') }}";
        url = url.replace(':id', type_id);

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                if(response.status){
                    $('#modalContainer').html(response.html);

                    let modalEl = document.getElementById('exampleModal');
                    let modal = new bootstrap.Modal(modalEl);

                    modal.show();
                }
            }
        });
    })

    $(document).on('submit', '#addTypeForm', function(e) {
        e.preventDefault();

        let formData = new FormData($('#addTypeForm')[0]);

        $.ajax({
            url: "{{ route('type.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status) {
                    getType();

                    $('#exampleModal').modal('hide');
                }
            },
            error: function(error) {
                let errors = error.responseJSON.errors;

                $.each(errors, function(key, value) {
                    $('.'+ key +'_error').text(value[0]);
                });
            }
        });
    });

    $(document).on('input change', '#addTypeForm input, #addTypeForm select', function() {
        let fields = $(this).attr('name');

        $('.'+ fields +'_error').text('');
        $(this).removeClass('is_invalid');
    });

    $(document).on('click', '.deleteBtn', function() {
        let type_id = $(this).data('id');

        let url = "{{ route('types.destroy', ':id') }}";
        url = url.replace(':id', type_id);

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                if(response.status) {
                    alert(response.message);
                    getType();
                }
            }
        });
    });
</script>
