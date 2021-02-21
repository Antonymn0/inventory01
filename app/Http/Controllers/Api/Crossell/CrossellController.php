<?php

namespace App\Http\Controllers\Api\Crossell;

use App\Http\Controllers\Controller;
use App\Models\Crossell;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateCrossell;
use App\Events\CrossellCreated;
use App\Events\CrossellUpdated;
use App\Events\CrossellDestroyed;

class CrossellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $crossell = Crossell::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $crossell);
         } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch crossell crossell.', 'error code' => '500'], 500); } 
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
     * @param  App\Http\Requests\ValidateCrossell;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCrossell $request)
    {
        $input = $request->validated();
        try{ 
           $crossell = Crossell::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create crossell','error code' => '500'], 500); }  
        event(new CrossellCreated($crossell));
        return response()->json( [$crossell, "success"=>"crossell created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id  $crossell
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{ 
           $crossell = Crossell::findOrFail($id);
           return response()->json( $crossell);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crossell  $crossell
     * @return \Illuminate\Http\Response
     */
    public function edit(Crossell $crossell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ValidateCrossell;   $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCrossell $request, $id)
    {
       $input = $request->validated();
       try{ 
            $crossell = Crossell::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $crossell->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update crossell','error code' => '500'], 500); }  
        event(new CrossellUpdated($crossell));
       return response()->json( [$crossell, "success"=>"crossell updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try{ 
            $crossell = Crossell::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $crossell->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete crossell','error code' => '500'], 500); }   
        event(new CrossellDestroyed($crossell));
        return response()->json( [$crossell, "success"=>"crossell deleted successfully"]);
    }
}
