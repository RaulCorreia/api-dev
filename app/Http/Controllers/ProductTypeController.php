<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::with('products')->get();
        return response($types);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['string', 'required', 'unique:types'],
        ]);

        $product = Type::create($validatedData);

        return response($product);
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
        $validatedData = $request->validate([
            'name' => ['string', 'required', 'unique:types'],
        ]);

        $product = Type::find($id);

        if ($product) {
            $product->update($validatedData);
        } else {
            return response([
                'message' => 'Product Type not found'
            ], 404);
        }

        return response($product);
    }

}
