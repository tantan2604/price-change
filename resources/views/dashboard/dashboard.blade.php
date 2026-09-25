@extends('layouts.app')

@section('title', 'Price Changes')

@section('content')

<div class="d-flex min-vh-100">

    @include('components.sidebar')

    <!-- Main Content -->
    <main class="main-content flex-grow-1 p-4">

        <!-- Page Header -->
        <div class="mb-4">
            <h3 class="mb-1 fw-semibold">
                Price Changes
            </h3>

            <p class="text-muted mb-0">
                Manage and review promotion price changes.
            </p>
        </div>


        <!-- Filter -->
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <div class="row g-3 align-items-end">

                    <!-- Start Date -->
                    <div class="col-auto">

                        <label
                            for="start_date"
                            class="form-label fw-semibold">

                            Start Date

                        </label>

                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            class="form-control date-width">

                    </div>


                    <!-- End Date -->
                    <div class="col-auto">

                        <label
                            for="end_date"
                            class="form-label fw-semibold">

                            End Date

                        </label>

                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            class="form-control date-width">

                    </div>


                    <!-- Clear Filter -->
                    <div class="col-auto">

                        <button
                            type="button"
                            id="clear-filter"
                            class="btn btn-outline-secondary">

                            <i class="bi bi-x-circle me-1"></i>

                            Clear Filter

                        </button>

                    </div>

                </div>

            </div>

        </div>


        <!-- DataTable Card -->
        <div class="card border-0 shadow-sm w-100">

            <!-- Card Header -->
            <div class="card-header bg-white border-0">

                <h5 class="mb-0 fw-semibold">
                    Promotion Price Changes
                </h5>

                <small class="text-muted">
                    List of price change documents
                </small>

            </div>


            <!-- Card Body -->
            <div class="card-body">

                <div class="table-responsive">

                    <table
                        id="price-change-table"
                        class="table table-hover align-middle w-100">

                        <thead class="table-light">

                            <tr>

                                <th>Document ID</th>

                                <th>Promotion Title</th>

                                <th>Supplier</th>

                                <th>Product Code</th>

                                <th>Product Name</th>

                                <th>Start Date</th>

                                <th>End Date</th>

                                <th>Status</th>

                                <th class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>

        </div>

    </main>

</div>


<style>
    html,
    body {
        width: 100%;
        min-height: 100%;
        margin: 0;
    }


    .main-content {
        flex: 1 1 0 !important;
        width: auto !important;
        max-width: none !important;
        min-width: 0 !important;
    }


    .date-width {
        width: 200px;
    }


    .card {
        width: 100%;
        border-radius: 10px;
    }


    #price-change-table {
        width: 100% !important;
    }


    #price-change-table th {
        white-space: nowrap;
    }


    #price-change-table td {
        white-space: nowrap;
    }


    .badge-status {
        font-size: 0.8rem;
        padding: 0.45rem 0.65rem;
    }
</style>

@endsection


@push('scripts')

<script>
    $(document).ready(function() {

        /*
        |--------------------------------------------------------------------------
        | Price Change DataTable
        |--------------------------------------------------------------------------
        */

        let table = $('#price-change-table').DataTable({

            processing: true,

            serverSide: true,


            ajax: {

                url: "{{ url('price-change-data') }}",

                type: "GET",

                data: function(d) {

                    d.start_date = $('#start_date').val();

                    d.end_date = $('#end_date').val();

                },

                error: function(xhr, error, thrown) {

                    console.error(
                        'DataTables AJAX Error:',
                        xhr.responseText
                    );

                }

            },


            columns: [{
                    data: 'document_id',
                    name: 'document_id'
                },
                {
                    data: 'memo_title',
                    name: 'memo_title'
                },
                {
                    data: 'supplier_name',
                    name: 'supplier_name'
                },
                {
                    data: 'product_code',
                    name: 'product_code'
                },
                {
                    data: 'product_name',
                    name: 'product_name'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'document_status',
                    name: 'document_status'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    className: 'text-center'
                }
            ],

            /*
            |--------------------------------------------------------------------------
            | Default Order
            |--------------------------------------------------------------------------
            */

            order: [

                [5, 'desc']

            ],


            /*
            |--------------------------------------------------------------------------
            | Page Length
            |--------------------------------------------------------------------------
            */

            pageLength: 10,


            /*
            |--------------------------------------------------------------------------
            | Language
            |--------------------------------------------------------------------------
            */

            language: {

                processing: `
                <div class="spinner-border spinner-border-sm text-dark me-2"
                     role="status">
                </div>
                Loading...
            `,

                emptyTable: "No price change records found.",

                zeroRecords: "No matching records found."

            }

        });


        /*
        |--------------------------------------------------------------------------
        | Date Filter
        |--------------------------------------------------------------------------
        */

        $('#start_date, #end_date').on(
            'change',
            function() {

                table.ajax.reload();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Clear Filter
        |--------------------------------------------------------------------------
        */

        $('#clear-filter').on(
            'click',
            function() {

                $('#start_date').val('');

                $('#end_date').val('');

                table.ajax.reload();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Edit Button
        |--------------------------------------------------------------------------
        */

        $('#price-change-table').on(
            'click',
            '.edit-btn',
            function() {

                let id = $(this).data('id');

                console.log(
                    'Edit Price Change ID:',
                    id
                );

                // Add edit modal here later

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Delete Button
        |--------------------------------------------------------------------------
        */

        $('#price-change-table').on(
            'click',
            '.delete-btn',
            function() {

                let id = $(this).data('id');

                console.log(
                    'Delete Price Change ID:',
                    id
                );

                // Add delete confirmation here later

            }
        );

    });
</script>

@endpush