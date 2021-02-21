<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateNewService;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Events\ServiceCreated;
use App\Events\ServiceUpdated;
use App\Events\ServiceDestroyed;

class ServiceController extends Controller
{
    /**
     * Display a listing of all services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $services = Service::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $services);
         } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch services.', 'error code' => '500'], 500); } 
    }

    /**
     * Show the form for creating a new service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created service resource in storage.
     *
     * @param   \Illuminate\Http\Requests\ValidateNewProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateNewService $request)
    {
        $input = $request->validated();
        try{
            $service = Service::create($input);           
        }catch(\Exception $e) { 
            return response()->json(['error' => 'Something went wrong. Could not create service.'], 500);
         }        
        event(new ServiceCreated($service));
        return response()->json( [$service, "success"=>"Service created successfully"]);
    }

    /**
     * Display the specified service resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        try {
            $service = Service::findOrFail($id);
            return response()->json( $service);
         } catch (\Exception $e) { return response()->json(['error' => 'Resource not found.', 'error code' => '404'], 404); } 
    }

    /**
     * Show the form for editing the specified service resource.
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
     * @param  \Illuminate\Http\Requests\ValidateNewService  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateNewService $request, $id)
    {
        $input = $request->validated();
        try{ 
            $service = Service::findOrFail($id);  
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try {
             $service->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update service','error code' => '500'], 500); }          
        event(new ServiceUpdated($service));
        return response()->json( [$service, "success"=>"Service updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try{ 
            $service = Service::findOrFail($id);  
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try {
            $service-> delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete service','error code' => '500'], 500); }          
        event(new ServiceDestroyed($service));
        return response()->json([$service, 'success'=> 'Service deleted successfuly.']);
    }
}
