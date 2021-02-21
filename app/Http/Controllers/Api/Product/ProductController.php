<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateNewProduct;
use App\Events\ProductCreated;
use App\Events\ProductUpdated;
use App\Events\ProductDestroyed;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
             $products = Product::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $products);
         } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch products.', 'error code' => '500'], 500); } 
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created product in products table.
     *
     * @param  \Illuminate\Http\Requests\ValidateNewProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateNewProduct $request)
    {
        $input = $request->validated();       
        try{
            $product = Product::create($input);           
        }catch(\Exception $e) { 
            return response()->json(['error' => 'Something went wrong. Could not create product.'], 500);
         } 
        event(new ProductCreated($product));
        return response()->json( [$product, "success"=>"Product created successfully"]);    
    }

    /**
     * Display a single product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrfail($id);
            return response()->json( $product);
         } catch (\Exception $e) { return response()->json(['error' => 'Resource not found.', 'error code' => '404'], 404); } 
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
     * Update product resource in storage.
     *
     * @param  App\Http\Requests\ValidateNewProduct;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateNewProduct $request, $id)
    {
        $input = $request->validated();
        try{ 
              $product = Product::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try {
            $product->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update product','error code' => '500'], 500); }          
        event(new ProductUpdated($product));
        return response()->json( [$product, "success"=>"Product updated successfully"]);    
    }
    /**
     * Delete product from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {  
         try{ 
              $product = Product::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try {
            $product->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete product','error code' => '500'], 500); }          
          event(new ProductDestroyed($product));
        return response()->json( [$product, "success"=>"Product deleted successfully"]);  
    }
}
