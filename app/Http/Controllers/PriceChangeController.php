<?php

namespace App\Http\Controllers;

use App\Models\PriceChange;
use Illuminate\Http\Request;

class PriceChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('price_change.priceChange');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PriceChange $priceChange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PriceChange $priceChange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PriceChange $priceChange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PriceChange $priceChange)
    {
        //
    }
}
