<?php

namespace App\Http\Controllers\Api\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateUnit;
use App\Models\Unit;
use App\Events\UnitCreated;
use App\Events\UnitUpdated;
use App\Events\UnitDestroyed;

class UnitController extends Controller
{
    /**
     * Display a listing of the units resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $units = Unit::paginate(env('API_POSTS_PER_PAGE') );
        return response()->json( $units);
        }catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not fetch units','error code' => '500'], 500); }  
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
     * @param  App\Http\Requests\ValidateUnit  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateUnit $request)
    {
        $input = $request->validated();
        try{ 
           $unit = Unit::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create unit','error code' => '500'], 500); }  
        event(new UnitCreated($unit));
        return response()->json( [$unit, "success"=>"unit created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{ 
           $unit = Unit::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        return response()->json( $unit);
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
     * @param  App\Http\Requests\ValidateUnit  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateUnit $request, $id)
    {
       $input = $request->validated();
       try{ 
            $unit = Unit::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $unit->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update unit','error code' => '500'], 500); }  
        event(new UnitUpdated($unit));
       return response()->json( [$unit, "success"=>"unit updated successfully"]);
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
            $unit = Unit::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $unit->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete unit','error code' => '500'], 500); }   
        event(new UnitDestroyed($unit));
        return response()->json( [$unit, "success"=>"unit deleted successfully"]);
    }
}
