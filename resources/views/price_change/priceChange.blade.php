@extends('layouts.app')

@section('title', 'Create Price Change')

@section('content')

<div class="d-flex min-vh-100">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <main class="main-content flex-grow-1 p-4">

        <!-- =====================================================
             PAGE HEADER
        ====================================================== -->

        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-start">

                <div>

                    <h3 class="mb-1 fw-semibold">
                        Create Price Change
                    </h3>

                    <p class="text-muted mb-0">
                        Create a new price change and select the products it applies to.
                    </p>

                </div>

                <a
                    href="{{ url()->previous() }}"
                    class="btn btn-light border">

                    <i class="bi bi-arrow-left me-1"></i>
                    Back

                </a>

            </div>

        </div>


        <!-- =====================================================
             IMPORT PRODUCTS
        ====================================================== -->

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-bottom py-3">

                <div class="d-flex align-items-center">

                    <div
                        class="bg-success bg-opacity-10 text-success rounded-3
                               d-flex align-items-center justify-content-center me-3"
                        style="width:42px;height:42px;">

                        <i class="bi bi-file-earmark-excel fs-5"></i>

                    </div>

                    <div>

                        <h5 class="mb-0 fw-semibold">
                            Import Products
                        </h5>

                        <small class="text-muted">
                            Import products from an Excel file.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body">

                <form id="productImportForm" action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data"> @csrf <div class="row g-3 align-items-end">
                        <div class="col-md-8"> <label for="productImportFile" class="form-label fw-medium"> Excel File </label> <input type="file" name="file" id="productImportFile" class="form-control" accept=".xlsx,.xls,.csv" required> <small class="text-muted"> Supported formats: XLSX, XLS, CSV </small> </div>
                        <div class="col-md-4"> <button type="submit" id="importProductsBtn" class="btn btn-success"> <i class="bi bi-upload me-1"></i> <span id="importButtonText">Import Products</span> </button> </div>
                    </div>
                </form>

                <div id="importMessage" class="mt-3" style="display: none;"> </div>
            </div>


        </div>


        <!-- =====================================================
             VALIDATION ERRORS
        ====================================================== -->

        @if ($errors->any())

        <div class="alert alert-danger">

            <div class="fw-semibold mb-2">

                Please fix the following errors:

            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

                @endforeach

            </ul>

        </div>

        @endif


        <!-- =====================================================
             SUCCESS MESSAGE
        ====================================================== -->

        @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

        @endif


        <!-- =====================================================
             PRICE CHANGE FORM
        ====================================================== -->

        <form
            action="{{ route('price-changes.store') }}"
            method="POST"
            id="priceChangeForm">

            @csrf


            <!-- =================================================
                 TOP SECTION
            ================================================== -->

            <div class="row g-4">


                <!-- =================================================
                     LEFT SIDE
                ================================================== -->

                <div class="col-xl-7">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-header bg-white border-bottom py-3">

                            <div class="d-flex align-items-center">

                                <div
                                    class="bg-primary bg-opacity-10 text-primary rounded-3
                                           d-flex align-items-center justify-content-center me-3"
                                    style="width:42px;height:42px;">

                                    <i class="bi bi-pencil-square fs-5"></i>

                                </div>

                                <div>

                                    <h5 class="mb-0 fw-semibold">
                                        Price Change Details
                                    </h5>

                                    <small class="text-muted">
                                        Enter the details for this price change.
                                    </small>

                                </div>

                            </div>

                        </div>


                        <div class="card-body">

                            <div class="row g-3">


                                <!-- Received Date -->

                                <div class="col-md-6">

                                    <label
                                        for="received_date"
                                        class="form-label fw-medium">

                                        Received Date

                                    </label>

                                    <input
                                        type="date"
                                        id="received_date"
                                        name="received_date"
                                        class="form-control"
                                        value="{{ old('received_date') }}"
                                        required>

                                </div>


                                <!-- Memo Date -->

                                <div class="col-md-6">

                                    <label
                                        for="memo_date"
                                        class="form-label fw-medium">

                                        Memo Date

                                    </label>

                                    <input
                                        type="date"
                                        id="memo_date"
                                        name="memo_date"
                                        class="form-control"
                                        value="{{ old('memo_date') }}"
                                        required>

                                </div>


                                <!-- Start Date -->

                                <div class="col-md-6">

                                    <label
                                        for="start_date"
                                        class="form-label fw-medium">

                                        Start Date

                                    </label>

                                    <input
                                        type="date"
                                        id="start_date"
                                        name="start_date"
                                        class="form-control"
                                        value="{{ old('start_date') }}"
                                        required>

                                </div>


                                <!-- End Date -->

                                <div class="col-md-6">

                                    <label
                                        for="end_date"
                                        class="form-label fw-medium">

                                        End Date

                                    </label>

                                    <input
                                        type="date"
                                        id="end_date"
                                        name="end_date"
                                        class="form-control"
                                        value="{{ old('end_date') }}">

                                </div>


                                <!-- Supplier -->

                                <div class="col-md-6">

                                    <label
                                        for="supplier"
                                        class="form-label fw-medium">

                                        Supplier

                                    </label>

                                    <input
                                        type="text"
                                        id="supplier"
                                        name="supplier"
                                        class="form-control"
                                        value="{{ old('supplier') }}"
                                        placeholder="Enter supplier"
                                        required>

                                </div>


                                <!-- Promo Title -->

                                <div class="col-md-6">

                                    <label
                                        for="promo_title"
                                        class="form-label fw-medium">

                                        Promo Title

                                    </label>

                                    <input
                                        type="text"
                                        id="promo_title"
                                        name="promo_title"
                                        class="form-control"
                                        value="{{ old('promo_title') }}"
                                        placeholder="Enter promotion title"
                                        required>

                                </div>


                                <!-- Promotion Type -->

                                <div class="col-12">

                                    <label
                                        for="promotion_type"
                                        class="form-label fw-medium">

                                        Promotion Type

                                    </label>

                                    <select
                                        id="promotion_type"
                                        name="promotion_type"
                                        class="form-select"
                                        required>

                                        <option value="">
                                            Select promotion type
                                        </option>

                                        <option
                                            value="permanent"
                                            {{ old('promotion_type') === 'permanent' ? 'selected' : '' }}>

                                            Permanent

                                        </option>

                                        <option
                                            value="temporary"
                                            {{ old('promotion_type') === 'temporary' ? 'selected' : '' }}>

                                            Temporary

                                        </option>

                                    </select>

                                </div>


                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     RIGHT SIDE - PRODUCTS
                ================================================== -->

                <div class="col-xl-5">

                    <div class="card border-0 shadow-sm h-100">


                        <!-- Header -->

                        <div class="card-header bg-white border-bottom py-3">

                            <div class="d-flex align-items-center">

                                <div
                                    class="bg-success bg-opacity-10 text-success rounded-3
                                           d-flex align-items-center justify-content-center me-3"
                                    style="width:42px;height:42px;">

                                    <i class="bi bi-box-seam fs-5"></i>

                                </div>

                                <div>

                                    <h5 class="mb-0 fw-semibold">
                                        Select Products
                                    </h5>

                                    <small class="text-muted">
                                        Select products for this price change.
                                    </small>

                                </div>

                            </div>

                        </div>


                        <!-- Search -->

                        <div class="card-body pb-2">

                            <div class="input-group">

                                <span class="input-group-text bg-white">

                                    <i class="bi bi-search text-muted"></i>

                                </span>

                                <input
                                    type="text"
                                    id="priceChangeSearch"
                                    class="form-control"
                                    placeholder="Search products...">

                            </div>

                        </div>


                        <!-- Product Table -->

                        <div
                            class="table-responsive"
                            style="max-height:300px;">

                            <table
                                class="table table-hover align-middle mb-0">

                                <thead class="table-light sticky-top">

                                    <tr>

                                        <th
                                            class="ps-3"
                                            style="width:45px;">

                                            <div class="form-check mb-0">

                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="selectAllPriceChanges">

                                            </div>

                                        </th>

                                        <th>
                                            Product
                                        </th>

                                        <th>
                                            Price
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                    </tr>

                                </thead>


                                <tbody id="priceChangeTable">

                                    @forelse($products as $product)

                                    <tr>
                                        <td class="ps-3">

                                            <input
                                                type="checkbox"
                                                class="form-check-input price-change-checkbox"
                                                name="products[]"
                                                value="{{ $product->id }}"
                                                data-product="{{ $product->product_name }}"
                                                data-sku="{{ $product->product_code }}"
                                                data-price="{{ $product->price ?? 0 }}">

                                        </td>

                                        <td>

                                            <div class="fw-medium">
                                                {{ $product->product_name }}
                                            </div>

                                            <small class="text-muted">

                                                {{ $product->product_code }}

                                                @if($product->product_brand)
                                                • {{ $product->product_brand }}
                                                @endif

                                            </small>

                                        </td>

                                        <td>

                                            ₱{{ number_format($product->price ?? 0, 2) }}

                                        </td>

                                        <td>

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        </td>
                                    </tr>

                                    @empty

                                    <tr>

                                        <td
                                            colspan="4"
                                            class="text-center py-5">

                                            <div class="text-muted">

                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                                <div class="fw-medium">
                                                    No products found
                                                </div>

                                                <small>
                                                    Import products from Excel first.
                                                </small>

                                            </div>

                                        </td>

                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>


                        <!-- Selected Count -->

                        <div class="card-footer bg-white border-top py-3">

                            <div
                                class="d-flex justify-content-between align-items-center">

                                <small class="text-muted">

                                    <strong id="selectedCount">
                                        0
                                    </strong>

                                    products selected

                                </small>


                                <button
                                    type="button"
                                    class="btn btn-sm btn-light border"
                                    id="clearSelection">

                                    Clear

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 SELECTED PRODUCTS
            ================================================== -->

            <div class="card border-0 shadow-sm mt-4">


                <!-- Header -->

                <div class="card-header bg-white border-bottom py-3">

                    <div
                        class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">

                            <div
                                class="bg-primary bg-opacity-10 text-primary rounded-3
                                       d-flex align-items-center justify-content-center me-3"
                                style="width:42px;height:42px;">

                                <i class="bi bi-list-check fs-5"></i>

                            </div>

                            <div>

                                <h5 class="mb-1 fw-semibold">
                                    Price Change Products
                                </h5>

                                <small class="text-muted">
                                    Enter the new price for the selected products.
                                </small>

                            </div>

                        </div>


                        <span
                            id="selectedProductsBadge"
                            class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">

                            0 Products

                        </span>

                    </div>

                </div>


                <!-- Table -->

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="ps-4">
                                    Product
                                </th>

                                <th>
                                    SKU
                                </th>

                                <th>
                                    Brand
                                </th>

                                <th>
                                    Current Price
                                </th>

                                <th>
                                    New Price
                                </th>

                                <th>
                                    Price Change
                                </th>

                                <th class="text-end pe-4">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody id="productTable">

                            <tr id="emptyProductsRow">

                                <td
                                    colspan="7"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-inbox fs-1 d-block mb-2">
                                        </i>

                                        <div class="fw-medium">
                                            No products selected
                                        </div>

                                        <small>
                                            Select products above to add them here.
                                        </small>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                <!-- Footer -->

                <div class="card-footer bg-white border-top py-3">

                    <div
                        class="d-flex justify-content-between align-items-center">

                        <div class="text-muted small">

                            <i class="bi bi-info-circle me-1"></i>

                            Review all prices before saving.

                        </div>


                        <div class="d-flex gap-2">

                            <a
                                href="{{ url()->previous() }}"
                                class="btn btn-light border px-4">

                                Cancel

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary px-4"
                                id="submitPriceChange">

                                <i class="bi bi-check-lg me-1"></i>

                                Create Price Change

                            </button>

                        </div>

                    </div>

                </div>

            </div>


        </form>

    </main>

</div>

@endsection


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const selectAll =
            document.getElementById('selectAllPriceChanges');

        const checkboxes =
            document.querySelectorAll('.price-change-checkbox');

        const searchInput =
            document.getElementById('priceChangeSearch');

        const selectedCount =
            document.getElementById('selectedCount');

        const selectedBadge =
            document.getElementById('selectedProductsBadge');

        const clearButton =
            document.getElementById('clearSelection');

        const productTable =
            document.getElementById('productTable');

        const emptyProductsRow =
            document.getElementById('emptyProductsRow');


        /*
        |--------------------------------------------------------------------------
        | Update Selected Count
        |--------------------------------------------------------------------------
        */

        function updateSelectedCount() {

            const selected =
                document.querySelectorAll(
                    '.price-change-checkbox:checked'
                ).length;

            selectedCount.textContent = selected;

            selectedBadge.textContent =
                selected +
                (selected === 1 ?
                    ' Product' :
                    ' Products');
        }


        /*
        |--------------------------------------------------------------------------
        | Empty State
        |--------------------------------------------------------------------------
        */

        function showEmptyState() {

            const rows =
                productTable.querySelectorAll(
                    'tr:not(#emptyProductsRow)'
                );

            emptyProductsRow.style.display =
                rows.length === 0 ?
                '' :
                'none';
        }


        /*
        |--------------------------------------------------------------------------
        | Select All State
        |--------------------------------------------------------------------------
        */

        function updateSelectAllState() {

            const total =
                checkboxes.length;

            const selected =
                document.querySelectorAll(
                    '.price-change-checkbox:checked'
                ).length;

            selectAll.checked =
                total > 0 &&
                selected === total;

            selectAll.indeterminate =
                selected > 0 &&
                selected < total;
        }


        /*
        |--------------------------------------------------------------------------
        | Price Difference
        |--------------------------------------------------------------------------
        */

        function updatePriceDifference(input) {

            const currentPrice =
                parseFloat(
                    input.dataset.currentPrice
                ) || 0;

            const newPrice =
                parseFloat(input.value) || 0;

            const difference =
                newPrice - currentPrice;

            const differenceElement =
                input
                .closest('tr')
                .querySelector('.price-difference');

            differenceElement.textContent =
                (difference >= 0 ? '+' : '') +
                '₱' +
                difference.toFixed(2);

            differenceElement.classList.remove(
                'text-success',
                'text-danger',
                'text-muted'
            );

            if (difference > 0) {

                differenceElement.classList.add(
                    'text-success'
                );

            } else if (difference < 0) {

                differenceElement.classList.add(
                    'text-danger'
                );

            } else {

                differenceElement.classList.add(
                    'text-muted'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Create Selected Product Row
        |--------------------------------------------------------------------------
        */

        function createProductRow(checkbox) {

            const productId =
                checkbox.value;

            const productName =
                checkbox.dataset.product;

            const sku =
                checkbox.dataset.sku;

            const currentPrice =
                parseFloat(
                    checkbox.dataset.price
                ) || 0;


            const sourceRow =
                checkbox.closest('tr');

            let brand = '';

            const brandElement =
                sourceRow?.querySelector(
                    'small.text-muted'
                );

            if (brandElement) {

                const text =
                    brandElement.textContent.trim();

                const parts =
                    text.split('•');

                if (parts.length > 1) {

                    brand =
                        parts[1].trim();

                }
            }


            const row =
                document.createElement('tr');

            row.dataset.productId =
                productId;


            row.innerHTML = `

            <td class="ps-4">

                <div class="fw-medium">
                    ${escapeHtml(productName)}
                </div>

            </td>


            <td>
                ${escapeHtml(sku)}
            </td>


            <td>
                ${escapeHtml(brand)}
            </td>


            <td>
                ₱${currentPrice.toFixed(2)}
            </td>


            <td>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="new_prices[${productId}]"
                    class="form-control form-control-sm new-price-input"
                    value="${currentPrice.toFixed(2)}"
                    data-current-price="${currentPrice}"
                    style="width:120px;">

            </td>


            <td>

                <span
                    class="price-difference text-muted fw-semibold">

                    ₱0.00

                </span>

            </td>


            <td class="text-end pe-4">

                <button
                    type="button"
                    class="btn btn-sm btn-outline-danger remove-product"
                    data-product-id="${productId}">

                    <i class="bi bi-trash"></i>

                </button>

            </td>

        `;


            productTable.appendChild(row);


            const newPriceInput =
                row.querySelector('.new-price-input');


            updatePriceDifference(
                newPriceInput
            );


            newPriceInput.addEventListener(
                'input',
                function() {

                    updatePriceDifference(
                        this
                    );

                }
            );


            row.querySelector('.remove-product')
                .addEventListener(
                    'click',
                    function() {

                        checkbox.checked = false;

                        row.remove();

                        updateSelectedCount();

                        updateSelectAllState();

                        showEmptyState();

                    }
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Escape HTML
        |--------------------------------------------------------------------------
        */

        function escapeHtml(value) {

            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }


        /*
        |--------------------------------------------------------------------------
        | Checkbox Change
        |--------------------------------------------------------------------------
        */

        checkboxes.forEach(function(checkbox) {

            checkbox.addEventListener(
                'change',
                function() {

                    const existingRow =
                        productTable.querySelector(
                            `tr[data-product-id="${this.value}"]`
                        );


                    if (this.checked) {

                        if (!existingRow) {

                            createProductRow(
                                this
                            );
                        }

                    } else {

                        if (existingRow) {

                            existingRow.remove();
                        }
                    }


                    updateSelectedCount();

                    updateSelectAllState();

                    showEmptyState();

                }
            );
        });


        /*
        |--------------------------------------------------------------------------
        | Select All
        |--------------------------------------------------------------------------
        */

        selectAll.addEventListener(
            'change',
            function() {

                checkboxes.forEach(function(checkbox) {

                    checkbox.checked =
                        selectAll.checked;


                    const existingRow =
                        productTable.querySelector(
                            `tr[data-product-id="${checkbox.value}"]`
                        );


                    if (checkbox.checked) {

                        if (!existingRow) {

                            createProductRow(
                                checkbox
                            );
                        }

                    } else {

                        if (existingRow) {

                            existingRow.remove();
                        }
                    }

                });


                updateSelectedCount();

                updateSelectAllState();

                showEmptyState();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener(
            'input',
            function() {

                const searchValue =
                    this.value
                    .toLowerCase()
                    .trim();


                const rows =
                    document.querySelectorAll(
                        '#priceChangeTable tr'
                    );


                rows.forEach(function(row) {

                    const rowText =
                        row.textContent.toLowerCase();


                    row.style.display =
                        rowText.includes(searchValue) ?
                        '' :
                        'none';

                });
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Clear Selection
        |--------------------------------------------------------------------------
        */

        clearButton.addEventListener(
            'click',
            function() {

                checkboxes.forEach(function(checkbox) {

                    checkbox.checked = false;

                });


                productTable
                    .querySelectorAll(
                        'tr:not(#emptyProductsRow)'
                    )
                    .forEach(function(row) {

                        row.remove();

                    });


                selectAll.checked = false;

                selectAll.indeterminate = false;


                updateSelectedCount();

                showEmptyState();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Form Validation
        |--------------------------------------------------------------------------
        */

        document
            .getElementById('priceChangeForm')
            .addEventListener(
                'submit',
                function(event) {

                    const selected =
                        document.querySelectorAll(
                            '.price-change-checkbox:checked'
                        );


                    if (selected.length === 0) {

                        event.preventDefault();

                        alert(
                            'Please select at least one product.'
                        );

                        return;
                    }


                    let invalidPrice = false;


                    selected.forEach(function(checkbox) {

                        const productId =
                            checkbox.value;


                        const priceInput =
                            document.querySelector(
                                `input[name="new_prices[${productId}]"]`
                            );


                        if (
                            !priceInput ||
                            priceInput.value === '' ||
                            parseFloat(priceInput.value) < 0
                        ) {

                            invalidPrice = true;

                        }

                    });


                    if (invalidPrice) {

                        event.preventDefault();

                        alert(
                            'Please enter a valid new price for every selected product.'
                        );

                    }

                }
            );


        /*
        |--------------------------------------------------------------------------
        | Initial State
        |--------------------------------------------------------------------------
        */

        updateSelectedCount();

        updateSelectAllState();

        showEmptyState();

    });
</script>

<script>
    $(document).ready(function() {
        $('#productImportForm').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            const fileInput = $('#productImportFile')[0];
            if (!fileInput.files.length) {
                showImportMessage('Please select an Excel or CSV file.', 'danger');
                return;
            }
            const file = fileInput.files[0];
            // 100 MB maximum
            const maxSize = 100 * 1024 * 1024;
            if (file.size > maxSize) {
                showImportMessage('The selected file is larger than 100 MB.', 'danger');
                return;
            }
            // Disable button while uploading
            const button = $('#importProductsBtn');
            button.prop('disabled', true);
            $('#importButtonText').text('Uploading...');
            button.find('i').removeClass('bi-upload').addClass('bi-hourglass-split');
            $('#importMessage').hide();
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    'Accept': 'application/json'
                },
                xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            const percent = Math.round((e.loaded / e.total) * 100);
                            $('#importButtonText').text('Uploading ' + percent + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    showImportMessage(response.message ?? 'Import started successfully. Products are being imported in the background.', 'success');
                    // Clear selected file 
                    $('#productImportFile').val('');
                    // Reset button 
                    button.prop('disabled', false);
                    button.find('i').removeClass('bi-hourglass-split').addClass('bi-upload');
                    $('#importButtonText').text('Import Products');
                },
                error: function(xhr) {
                    let message = 'Product import failed.';
                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        if (xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessages = [];
                            Object.keys(errors).forEach(function(key) {
                                errors[key].forEach(function(error) {
                                    errorMessages.push(error);
                                });
                            });
                            if (errorMessages.length > 0) {
                                message = errorMessages.join('<br>');
                            }

                        }
                    }
                    showImportMessage(message, 'danger'); // Reset button
                    button.prop('disabled', false);
                    button.find('i').removeClass('bi-hourglass-split').addClass('bi-upload');
                    $('#importButtonText').text('Import Products');
                }
            });
        });

        function showImportMessage(message, type) {
            $('#importMessage').removeClass('alert-success alert-danger alert-warning alert-info').addClass('alert alert-' + type).html(message).fadeIn();
        }
    });
</script>

@endpush