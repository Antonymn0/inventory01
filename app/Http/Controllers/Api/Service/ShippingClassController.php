<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Models\ShippingClass;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateShippingClass;
use App\Events\ShippingClassCreated;
use App\Events\ShippingClassUpdated;
use App\Events\ShippingClassDestroyed;

class ShippingClassController extends Controller
{
    /**
     * Display a listing of the shipping_class resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $shipping_class = ShippingClass::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json($shipping_class);
         } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch shipping classrecords.', 'error code' => '500'], 500); }  
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
     * Store a newly created shipping_class  resource in storage.
     *
     * @param  App\Http\Requests\ValidateShippingClass  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateShippingClass $request)
    {
        $input = $request->validated();
         try{
            $shipping_class = ShippingClass::create($input);            
        }catch(\Exception $e) { 
            return response()->json(['error' => 'Something went wrong. Could not create Shipping class.'], 500);
         }
        event(new ShippingClassCreated($shipping_class));
        return response()->json([$shipping_class, "success" => "Shipping class Created"]);   
    }

    /**
     * Display the specified shipping_class resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{ 
            $shipping_class = ShippingClass::findOrFail($id);  
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'],404);  }
        return response()->json($shipping_class);
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
     * Update the specified shipping_class in storage.
     *
     * @param  App\Http\Requests\ValidateShippingClass  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateShippingClass $request, $id)
    {       
        $input = $request->validated();        
        try{
            $shipping_class = ShippingClass::findOrFail($id); 
        }catch(\Exception $e){  return response()->json(['error' => 'Resource not found'], 404);  }
        try{
             $shipping_class->update($input);                  
        }catch(\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update Shipping class.'], 500); } 
        event(new ShippingClassUpdated($shipping_class));
        return response()->json([$shipping_class, "success" => "Shipping class Updated"]);  
    }

    /**
     * Remove the specified shipping_class from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{ 
            $shipping_class = ShippingClass::findOrFail($id);  
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try {
            $shipping_class-> delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete tag','error code' => '404'], 500); }          
        event(new ShippingClassDestroyed($shipping_class));
        return response()->json([$shipping_class, 'success'=> 'Shipping class deleted successfuly.']);
    }
}
