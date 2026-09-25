<?php

namespace App\Http\Controllers;

use App\Models\PriceChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Product;

class PriceChangeController extends Controller
{
    /**
     * Display the price change page.
     */
    public function index()
    {
        return view('price_change.priceChange');
    }


    /**
     * Get price changes for DataTables.
     */
    public function getPriceChanges(Request $request)
    {
        $data = PriceChange::select([
            'id',
            'document_id',
            'document_status',
            'created_by',
            'created_at',
            'approved_by',
            'approved_at',
            'memo_title',
            'supplier_name',
            'start_date',
            'end_date',
            'promotion_type',
            'product_code',
            'product_name',
            'product_brand',
            'is_active',
            'last_modified_by',
            'last_modified_at',
        ]);


        // Date filter
        if ($request->filled('start_date')) {

            $data->whereDate(
                'start_date',
                '>=',
                $request->start_date
            );
        }


        if ($request->filled('end_date')) {

            $data->whereDate(
                'end_date',
                '<=',
                $request->end_date
            );
        }


        return DataTables::of($data)

            ->addIndexColumn()


            /*
             * Action buttons
             */
            ->addColumn('action', function ($row) {

                return '

                    <button
                        type="button"
                        class="btn btn-primary btn-sm edit-btn"
                        data-id="' . $row->id . '">

                        <i class="bi bi-pencil"></i>
                        Edit

                    </button>


                    <button
                        type="button"
                        class="btn btn-danger btn-sm delete-btn"
                        data-id="' . $row->id . '">

                        <i class="bi bi-trash"></i>
                        Delete

                    </button>

                ';
            })


            /*
             * Created date
             */
            ->editColumn('created_at', function ($row) {

                return $row->created_at
                    ? date(
                        'Y-m-d H:i',
                        strtotime($row->created_at)
                    )
                    : '';
            })


            /*
             * Approved date
             */
            ->editColumn('approved_at', function ($row) {

                return $row->approved_at
                    ? date(
                        'Y-m-d H:i',
                        strtotime($row->approved_at)
                    )
                    : '';
            })


            /*
             * Last modified date
             */
            ->editColumn('last_modified_at', function ($row) {

                return $row->last_modified_at
                    ? date(
                        'Y-m-d H:i',
                        strtotime($row->last_modified_at)
                    )
                    : '';
            })


            /*
             * Active status
             */
            ->editColumn('is_active', function ($row) {

                if ($row->is_active) {

                    return '
                        <span class="badge bg-success">
                            Active
                        </span>
                    ';
                }


                return '
                    <span class="badge bg-secondary">
                        Inactive
                    </span>
                ';
            })


            /*
             * Document status
             */
            ->editColumn('document_status', function ($row) {

                $status = strtolower(
                    $row->document_status ?? ''
                );


                if ($status === 'approved') {

                    return '
                        <span class="badge bg-success">
                            Approved
                        </span>
                    ';
                }


                if ($status === 'pending') {

                    return '
                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>
                    ';
                }


                if ($status === 'rejected') {

                    return '
                        <span class="badge bg-danger">
                            Rejected
                        </span>
                    ';
                }


                return '
                    <span class="badge bg-secondary">
                        ' . e($row->document_status) . '
                    </span>
                ';
            })


            ->rawColumns([
                'action',
                'is_active',
                'document_status',
            ])


            ->make(true);
    }


    /**
     * Show the create price change page.
     */
    public function create()
    {
        $products = Product::orderBy('product_name', 'asc')
            ->get();

        return view('price_change.priceChange', [
            'products' => $products
        ]);
    }


    /**
     * Store a newly created price change.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Form
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'received_date' => [
                'required',
                'date',
            ],

            'memo_date' => [
                'required',
                'date',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'supplier' => [
                'required',
                'string',
                'max:255',
            ],

            'promo_title' => [
                'required',
                'string',
                'max:255',
            ],

            'promotion_type' => [
                'required',
                'in:permanent,temporary',
            ],

            'products' => [
                'required',
                'array',
                'min:1',
            ],

            'products.*' => [
                'required',
                'integer',
            ],

            'new_prices' => [
                'required',
                'array',
            ],

            'new_prices.*' => [
                'required',
                'numeric',
                'min:0',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Make Sure Every Selected Product Has A New Price
        |--------------------------------------------------------------------------
        */

        foreach ($validated['products'] as $productId) {

            if (
                !isset(
                    $validated['new_prices'][$productId]
                )
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'products' =>
                        'Every selected product must have a new price.'
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Generate Document ID
        |--------------------------------------------------------------------------
        |
        | All products submitted in this form will have the same
        | document ID.
        |
        */

        $documentId =
            'PC-' .
            now()->format('YmdHis');


        /*
        |--------------------------------------------------------------------------
        | Save Price Changes
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $documentId
        ) {


            foreach (
                $validated['products']
                as $productId
            ) {


                /*
                |--------------------------------------------------------------------------
                | New Price
                |--------------------------------------------------------------------------
                */

                $newPrice =
                    $validated['new_prices'][$productId];


                /*
                |--------------------------------------------------------------------------
                | Create Price Change
                |--------------------------------------------------------------------------
                |
                | Replace the temporary product information below
                | with your actual Product model/query.
                |
                */

                PriceChange::create([

                    /*
                    | Document
                    */
                    'document_id' =>
                    $documentId,

                    'document_status' =>
                    'Pending',


                    /*
                    | User
                    */
                    'created_by' =>
                    auth()->id(),


                    /*
                    | Price Change Details
                    */
                    'memo_title' =>
                    $validated['promo_title'],

                    'supplier_name' =>
                    $validated['supplier'],

                    'start_date' =>
                    $validated['start_date'],

                    'end_date' =>
                    $validated['end_date'] ?? null,

                    'promotion_type' =>
                    $validated['promotion_type'],


                    /*
                    | Product Information
                    |
                    | IMPORTANT:
                    | Replace these with values from your
                    | products table.
                    */
                    'product_code' =>
                    'PRODUCT-' . $productId,

                    'product_name' =>
                    'Product ' . $productId,

                    'product_brand' =>
                    null,


                    /*
                    | Status
                    */
                    'is_active' =>
                    true,


                    /*
                    | Modification Information
                    */
                    'last_modified_by' =>
                    auth()->id(),

                    'last_modified_at' =>
                    now(),

                ]);
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('price-changes.index')
            ->with(
                'success',
                'Price change created successfully.'
            );
    }


    /**
     * Display the specified price change.
     */
    public function show(PriceChange $priceChange)
    {
        return response()->json([
            'success' => true,
            'data' => $priceChange,
        ]);
    }


    /**
     * Show the edit form.
     */
    public function edit(PriceChange $priceChange)
    {
        return view(
            'price_change.edit',
            compact('priceChange')
        );
    }


    /**
     * Update the price change.
     */
    public function update(
        Request $request,
        PriceChange $priceChange
    ) {

        $validated = $request->validate([

            'memo_title' => [
                'required',
                'string',
                'max:255',
            ],

            'supplier_name' => [
                'required',
                'string',
                'max:255',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'promotion_type' => [
                'required',
                'in:permanent,temporary',
            ],

        ]);


        $priceChange->update([

            'memo_title' =>
            $validated['memo_title'],

            'supplier_name' =>
            $validated['supplier_name'],

            'start_date' =>
            $validated['start_date'],

            'end_date' =>
            $validated['end_date'] ?? null,

            'promotion_type' =>
            $validated['promotion_type'],

            'last_modified_by' =>
            auth()->id(),

            'last_modified_at' =>
            now(),

        ]);


        return redirect()
            ->route('price-changes.index')
            ->with(
                'success',
                'Price change updated successfully.'
            );
    }


    /**
     * Delete the price change.
     */
    public function destroy(PriceChange $priceChange)
    {
        $priceChange->delete();


        return response()->json([
            'success' => true,
            'message' =>
            'Price change deleted successfully.',
        ]);
    }
}
