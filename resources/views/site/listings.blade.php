@extends('layouts.velzon')
@section('title', 'Dashboard')

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



                    <!-- Tab le -->
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
                        <i class="ri-home-4-line align-middle me-2"></i>
                        <span>Add New Listing</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="listing-form" method="POST">
                    @csrf

                    <div class="modal-body">

                        <!-- ================= BASIC INFO ================= -->
                        <h6 class="fw-bold text-primary mb-3">Basic Information</h6>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Category</option>
                                    {{-- @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <input type="text" name="state" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <input type="text" name="country" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Street</label>
                                <input type="text" name="street" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Max Guests <span class="text-danger">*</span></label>
                                <input type="number" name="max_guests" class="form-control" min="1" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- ================= PRICING ================= -->
                        <h6 class="fw-bold text-primary mb-3">Pricing</h6>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Base Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="base_price" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Weekend Price</label>
                                <input type="number" step="0.01" name="weekend_price" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Currency</label>
                                <input type="text" name="currency" class="form-control" value="USD">
                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- ================= AVAILABILITY ================= -->
                        <h6 class="fw-bold text-primary mb-3">Availability & Rules</h6>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Check In Time</label>
                                <input type="time" name="check_in_time" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Check Out Time</label>
                                <input type="time" name="check_out_time" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Minimum Stay</label>
                                <input type="number" name="minimum_stay" class="form-control" value="1">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Maximum Stay</label>
                                <input type="number" name="maximum_stay" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Cancellation Policy</label>
                                <select name="cancellation_policy" class="form-select">
                                    <option value="flexible">Flexible</option>
                                    <option value="moderate" selected>Moderate</option>
                                    <option value="strict">Strict</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">House Rules</label>
                                <textarea name="house_rules" class="form-control" rows="2"></textarea>
                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- ================= APARTMENT DETAILS ================= -->
                        <h6 class="fw-bold text-primary mb-3">Apartment Details</h6>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Bedrooms</label>
                                <input type="number" name="bedrooms" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Bathrooms</label>
                                <input type="number" name="bathrooms" class="form-control">
                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- ================= EXCURSION DETAILS ================= -->
                        <h6 class="fw-bold text-primary mb-3">Excursion Details</h6>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Duration</label>
                                <input type="text" name="duration" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Difficulty Level</label>
                                <input type="text" name="difficulty_level" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Group Size Min</label>
                                <input type="number" name="group_size_min" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Group Size Max</label>
                                <input type="number" name="group_size_max" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">What's Included</label>
                                <textarea name="whats_included" class="form-control" rows="2"></textarea>
                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- ================= CAR DETAILS ================= -->
                        <h6 class="fw-bold text-primary mb-3">Car Rental Details</h6>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Vehicle Make</label>
                                <input type="text" name="vehicle_make" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Vehicle Model</label>
                                <input type="text" name="vehicle_model" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Vehicle Year</label>
                                <input type="number" name="vehicle_year" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Transmission Type</label>
                                <input type="text" name="transmission_type" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fuel Type</label>
                                <input type="text" name="fuel_type" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mileage Limit Per Day</label>
                                <input type="number" name="mileage_limit_per_day" class="form-control">
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-save-line align-middle me-2"></i>
                            Save Listing
                        </button>
                    </div>

                </form>
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

@endsection
