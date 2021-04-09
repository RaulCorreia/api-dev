<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
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
        $products = Product::with('type')->get();
        return response($products);
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
            'name' => ['string', 'required'],
            'type' => ['int', 'required'],
            'quantity' => ['int', 'nullable']
        ]);

        $type = Type::find($request->type);

        if ($type) {

            $product = new Product();
            $product->name = $validatedData['name'];
            $product->quantity = $validatedData['quantity'];
            $product->type()->associate($type);
            $product->save();

        } else {
            return response([
                'message' => 'Product Type not found'
            ], 404);
        }

        return response($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('type')->find($id);
        if (!$product) {
            return response([
                'message' => 'Product not found'
            ], 404);
        }

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
        $product = Product::find($id);

        if ($product) {
            $product->increment('quantity');
        } else {
            return response([
                'message' => 'Product not found'
            ], 404);
        }

        return response($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        } else {
            return response([
                'message' => 'Product not found'
            ], 404);
        }

        return response([
            'messsage' => 'Product deleted with success'
        ]);
    }
}
