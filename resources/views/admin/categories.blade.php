@extends('layouts.velzon')
@section('title', 'Admin Dashboard')

@section('main-content')


    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- Card Header -->
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">
                            <i class="ri-list-unordered align-middle me-2"></i>
                            All Categories
                        </h5>

                        <div>
                            <button type="button" class="btn btn-md btn-primary add-btn" data-bs-toggle="modal"
                                data-bs-target="#showModal">
                                <i class="ri-add-line align-bottom me-1"></i>
                                Add Category
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Info Alert -->
                <div class="card-body pt-0 mb-4">




                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="ri-information-line me-2"></i>
                        <strong>Information!</strong> Below is the list of all categories in the system.
                        Click on the description to view full details.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>



                    <!-- Table -->
                    <div class="table-responsive mt-2 table-card">
                        <table id="add-rows" class="table table-bordered table-nowrap align-middle mb-0"
                            style="width:100%">


                            <thead class="table-light">
                                <tr>
                                    <th># SR No.</th>
                                    <th><i class="las la-photo-video align-middle me-2 fw-bold "></i>Icon</th>
                                    <th><i class="as la-address-book align-middle me-2 fw-bold "></i>Category Name</th>
                                    <th><i class=" las la-pager align-middle me-2 fw-bold "></i>Description</th>
                                    <th><i class="las la-photo-video align-middle me-2 fw-bold "></i>Order</th>
                                    <th><i data-feather="toggle-left align-middle me-2 fw-bold"></i>Status</th>
                                    <th><i class="ri-home-line icon-md align-middle me-2 fw-bold"></i>Action</th>
                                </tr>
                            </thead>

                            <tbody>


                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h5 class="modal-title text-primary fw-bold" id="exampleModalLabel">
                        <i class="ri-list-unordered align-middle me-2"></i>
                        <span class="modal-text">Add New Category</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="alert alert-primary my-2 mx-4" role="alert">
                    <i class="ri-error-warning-line label-icon align-bottom me-1"></i>
                    <strong>Note:</strong> Please fill in all required fields marked with <span
                        class="text-danger">*</span>.
                </div>

                <form id="category-form" autocomplete="off">
                    <input type="hidden" id="category-id" name="id">
                    <input type="hidden" id="form-method" name="form_method" value="POST">

                    <div class="modal-body">
                        <div class="mb-3" id="modal-id" style="display: none;">
                            <label for="id-field" class="form-label">ID</label>
                            <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                        </div>

                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Category Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name" id="categoryname-field" class="form-control"
                                placeholder="Enter Name" required />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="icon-field" class="form-label">Choose Icon <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="icon" id="icon-field" class="form-control"
                                placeholder="Enter icon" accept="image/*" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="description-field" class="form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="description-field" rows="3" placeholder="Enter Description"></textarea>

                            <div class="invalid-feedback"></div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                            {{-- <button type="button" class="btn btn-success btn-load"  id="add-btn">
                            <span class="d-flex align-items-center">
                                <i class="ri-save-line align-middle me-2"></i>
                                <span class="flex-grow-1 me-2 btn-text">
                                    Add Category
                                </span>
                                <span class="spinner-border flex-shrink-0" role="status">
                                    <span class="visually-hidden">  Add Category</span>
                                </span>
                            </span>
                            </button> --}}
                            <button type="submit" class="btn btn-primary" id="add-btn">
                                <i class="ri-save-line align-middle me-2"></i>
                                <span class="btn-text">Add Category</span>
                            </button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
                <div id="errors"></div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function() {
            // to show table
            let table = $('#add-rows').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: "{{ route('admin.categories') }}",

                dom: "<'row align-items-center mb-3'<'col-md-4'l><'col-md-4'><'col-md-4 text-end'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center mt-3'<'col-md-5'i><'col-md-7 text-end'p>>",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'icon',
                        name: 'icon',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'order',
                        name: 'order'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],

                pageLength: 10,
                lengthMenu: [10, 25, 50, 100]
            });

            //add edit form
            $('#category-form').on('submit', function(e) {
                e.preventDefault();

                let id = $('#category-id').val();
                let method = $('#form-method').val();

                let url = method === 'PUT' ?
                    "{{ route('admin.category.update', ':id') }}".replace(':id', id) :
                    "{{ route('admin.category.store') }}";

                let formData = new FormData(this);
                if (method === 'PUT') {
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        showToast('success', response.message);

                        $('#showModal').modal('hide');
                        $('#category-form')[0].reset();
                        $('#form-method').val('POST');
                        $('#add-btn').text('Add Category');
                        $('#category-id').val('');

                        $('#add-rows').DataTable().ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        alert('Validation error');
                    }
                });
            });

            //prefilled form
            $('#add-rows').on('click', '.edit-item-btn', function(e) {
                e.preventDefault();

                let id = $(this).data('id');

                $.get("{{ route('admin.category.show', ':id') }}".replace(':id', id), function(res) {

                    $('#category-id').val(res.id);
                    $('#categoryname-field').val(res.name);
                    $('#description-field').val(res.description);

                    $('#form-method').val('PUT');
                    $('#add-btn .btn-text').text('Update Category');

                    $('.modal-text').text('Edit Category');


                    $('#showModal').modal('show');
                });
            });

            //toggle status
            $('#add-rows').on('change', '.toggle-status', function() {
                let checkbox = $(this);
                let categoryId = checkbox.data('id');
                let wrapper = checkbox.closest('td');
                let statusText = wrapper.find('.status-text');

                $.ajax({
                    url: "{{ route('admin.category.toggle-status', ':id') }}".replace(':id',
                        categoryId),
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {

                        statusText
                            .text(res.text)
                            .removeClass('bg-success bg-danger')
                            .addClass('bg-' + res.badge);
                    },
                    error: function() {

                        checkbox.prop('checked', !checkbox.prop('checked'));
                        alert('Something went wrong');
                    }
                });
            });




            let deleteId = null;

            //show delete modal
            $('#add-rows').on('click', '.remove-item-btn', function() {
                deleteId = $(this).data('id');
                $('#deleteRecordModal').modal('show');
            });

            // When click "Yes, Delete It!"
            $('#delete-record').on('click', function() {

                if (!deleteId) return;

                $.ajax({
                    url: "{{ route('admin.category.destroy', ':id') }}"
                        .replace(':id', deleteId),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        showToast('success', response.message);

                        $('#deleteRecordModal').modal('hide');

                        // Reload DataTable
                        $('#add-rows').DataTable().ajax.reload(null, false);

                        deleteId = null;
                    },
                    error: function() {
                        alert("Delete failed!");
                    }
                });

            });



            $('#showModal').on('hidden.bs.modal', function() {
                $('#category-form')[0].reset();
                $('#category-id').val('');
                $('#form-method').val('POST');
                $('.btn-text').text('Add Category');
                $('.modal-text').text('Add New Category');
            });

        });
    </script>




@endsection
