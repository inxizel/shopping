<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDetail;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data['product_id'] = $request->product_id ;
        $data['product_code'] = $request->product_code;
        $data['size'] = $request->size;
        $data['color'] = $request->color;
        $data['quantity'] = $request->quantity;
       
        //dd($data);
        $product = ProductDetail::create([
            'product_id' => $data['product_id'],
            'product_code' => $data['product_code'],
            'size_id' => $data['size'],
            'color_id' => $data['color'],
            'quantity' => $data['quantity']

        ]);
        echo json_encode($data);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
