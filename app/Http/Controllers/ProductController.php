<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::orderBy('product_name', 'asc')
        ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'unit_price' => 'required',
            'description' => 'required'
        ]);

        try {

            Product::create($request->post());

            return response()->json([
                'status' => 200, 
                'message' => 'Product has been added succesfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'status' => 202,
                'message' => 'Oops! something went wrong'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'unit_price' => 'required',
            'description' => 'required'
        ]);

        try {
            
            $product->fill($request->post())->update();
            
            return response()->json([
                'status' => 200,
                'message' => 'Product has been updated successfully!'
            ]);

        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'status' => 203,
                'message' => 'Oops! something went wrong went updating the product'
            ]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            
            $product->delete();
            
            return response()->json([
                'status' => 200,
                'message' => 'Product has been deleted successfully!'
            ]);

        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'status' => 205,
                'message' => 'Oops! something went wrong went deleting the product'
            ]);
        }
    }
}
