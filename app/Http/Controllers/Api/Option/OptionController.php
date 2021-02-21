<?php

namespace App\Http\Controllers\Api\Option;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateOption;
use App\Events\OptionCreated;
use App\Events\OptionUpdated;
use App\Events\OptionDestroyed;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $options = Option::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $options);
        } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch  options.', 'error code' => '500'], 500); } 
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
     * @param  \App\Http\Request\ValidateOption  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateOption $request)
    {
        $input = $request->validated();              
        try{ 
           $option = Option::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create option','error code' => '500'], 500); }  
        event(new OptionCreated($option));
        return response()->json( [$option, "success"=>"option created successfully"]);
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
           $option = Option::findOrFail($id);
           return response()->json( $option);
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
     * @param  App\Http\Requests\ValidateOption  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateOption $request, $id)
    {
        $input = $request->validated();
       try{ 
            $option = Option::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $option->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update option','error code' => '500'], 500); }  
        event(new OptionUpdated($option));
       return response()->json( [$option, "success"=>"option updated successfully"]);
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
            $option = Option::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $option->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete option','error code' => '500'], 500); }   
        event(new OptionDestroyed($option));
        return response()->json( [$option, "success"=>"option deleted successfully"]);
    }
}
