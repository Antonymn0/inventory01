<?php

namespace App\Http\Controllers\Api\SoldWith;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoldWith;
use App\Http\Requests\ValidateSoldWith;
use App\Events\SoldWithCreated;
use App\Events\SoldWithUpdated;
use App\Events\SoldWithDestroyed;


class SoldWithController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $sold_with = SoldWith::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $sold_with);
        } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch  sold_with.', 'error code' => '500'], 500); } 
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
     * @param  App\Http\Requests\ValidateSoldWith  $request
     * @return \Illuminate\Http\Response
     */
    public function store(validateSoldWith $request)
    {
        $input = $request->validated();              
        try{ 
           $sold_with = SoldWith::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create sold_with','error code' => '500'], 500); }  
        event(new SoldWithCreated($sold_with));
        return response()->json( [$sold_with, "success"=>"sold_with created successfully"]);
    }

    /**
     * Display the specified sold_with resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         try{ 
           $sold_with = SoldWith::findOrFail($id);
           return response()->json( $sold_with);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  }
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
     * @param  \App\Http\Requests\ValidateSoldWith  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateSoldWith $request, $id)
    {
        $input = $request->validated();
       try{ 
            $sold_with = SoldWith::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $sold_with->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update sold_with','error code' => '500'], 500); }  
        event(new SoldWithUpdated($sold_with));
       return response()->json( [$sold_with, "success"=>"sold_with updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{ 
            $sold_with = SoldWith::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $sold_with->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete sold_with','error code' => '500'], 500); }   
        event(new SoldWithDestroyed($sold_with));
        return response()->json( [$sold_with, "success"=>"sold_with deleted successfully"]);
    }
    
}
