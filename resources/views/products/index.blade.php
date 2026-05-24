<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="text-right mb-2">
                <a href="#" class="btn btn-success" id="addProductModel">Add Product</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Add To List</th>
                                <th scope="col">Metal</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="productData">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="modalContainer"></div>
</x-app-layout>

<script>
    $(document).ready(function() {
        getProducts();
    });

    function getProducts() {
        $.ajax({
            url: "{{ route('products.get') }}",
            type: "GET",
            success: function(response) {
                if(response.status) {
                    $('#productData').html(response.html);
                }
            }
        });
    }

    $(document).on('click', '#addProductModel', function() {
        $.ajax({
            url: "{{ route('products.create') }}",
            type: "GET",
            success: function(response) {
                if(response.status) {
                    $('#modalContainer').html(response.html);

                    let ModalEl = document.getElementById('addProductModal');
                    let modal = new bootstrap.Modal(ModalEl);

                    modal.show();
                }
            }
        });
    });

    $(document).on('submit', '#addProductModal', function(e) {
        e.preventDefault();

        let formData = new FormData($('#addProductForm')[0]);

        $.ajax({
            url: "{{ route('products.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status) {
                    getProducts();

                    $('#addProductModal').modal('hide');
                }
            },
            error: function(error) {
                if(error.status == 422) {
                    let errors = error..errors;

                    $.each(errorsresponseJSON, function(key, value) {
                        $('.' + key + '_error').text(value[0]);
                    });6


                }
            }
        });
    });

    $(document).on('input change', '#addProductForm input, #addProductForm select', function() {
        let fields = $(this).attr('name');

        $('.' + fields + '_error').text('');
        $(this).removeClass('is_invalid');
    });

    $(document).on('click', '.deleteBtn', function() {
        let product_id = $(this).data('id');

        let url = "{{ route('products.destroy', ':id') }}";
        url = url.replace(':id', product_id);

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                if(response.status) {
                    alert(response.message);
                    getProducts();
                }
            }
        });
    });

    $(document).on('click', '.editBtn', function() {
        let product_id = $(this).data('id');

        let url = "{{ route('products.edit', ':id') }}";
        url = url.replace(':id', product_id);

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                if(response.status) {
                    $('#modalContainer').html(response.html);

                    let ModalEl = document.getElementById('addProductModal');
                    let modal = new bootstrap.Modal(ModalEl);

                    modal.show();
                }
            }
        });
    });
</script>
