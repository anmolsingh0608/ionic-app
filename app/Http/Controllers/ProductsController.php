<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Validator;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = Product::all();
            return $this->response->createResponse('Products fetched', $products);
        }
        catch(Exception $e) {
            $errMsg = $e->getMessage();
            return $this->response->createErrorResponse($errMsg);
        }
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
        $rules = [
            'title' => 'required',
            'price' => 'required',
            'image' => 'required',
            'desc' => 'required',
        ];
        $validated = Validator::make($request->all(), $rules);
        if($validated->fails()) {
            $this->response->createErrorResponse($validated->errors()->first());
        }

        try {
             // dd($request->all());
            $product = Product::create([
                'title' => $request->title,
                'price' => $request->price,
                'image' => $request->image,
                'desc' => $request->desc
            ]);
            if(!$product) {
                throw new Exception('Product not created');
            }

            return $this->response->createResponse('product created', $product);
        }
        catch(Exception $e){
            $errMsg = $e->getMessage();
            return $this->response->createErrorResponse($errMsg);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);
            if(isset($product)){
                return $this->response->createResponse('Product Fetched', $product);
            } else {
                return $this->response->createErrorResponse('Product Not Found');
            }
        }
        catch(Exception $e)
        {
            $errMsg = $e->getMessage();
            return $this->response->createErrorResponse($errMsg);
        }
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
