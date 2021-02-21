<?php

namespace App\Http\Controllers\Api\Upsell;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateUpsell;
use App\Models\Upsell;
use App\Events\UpsellCreated;
use App\Events\UpsellUpdated;
use App\Events\UpsellDestroyed;

class UpsellController extends Controller
{
    /**
     * Display a listing of the upsell resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $upsell = Upsell::paginate(env('API_POSTS_PER_PAGE') );
        return response()->json( $upsell);
        }catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not fetch upsell','error code' => '500'], 500); }  
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
     * @param  \App\Http\Requests\ValidateUpsell  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateUpsell $request)
    {
        $input = $request->validated();
        try{ 
           $upsell = Upsell::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create upsell','error code' => '500'], 500); }  
        event(new UpsellCreated($upsell));
        return response()->json( [$upsell, "success"=>"upsell created successfully"]);
    }

    /**
     * Display the specified upsell resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{ 
           $upsell = Upsell::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        return response()->json( $upsell);
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
     * @param  App\Http\Requests\Upsell  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateUpsell $request, $id)
    {
        $input = $request->validated();
       try{ 
            $upsell = Upsell::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $upsell->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update upsell','error code' => '500'], 500); }  
        event(new UpsellUpdated($upsell));
       return response()->json( [$upsell, "success"=>"upsell updated successfully"]);
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
            $upsell = Upsell::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $upsell->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete upsell','error code' => '500'], 500); }   
        event(new UpsellDestroyed($upsell));
        return response()->json( [$upsell, "success"=>"upsell deleted successfully"]);
    }
}
