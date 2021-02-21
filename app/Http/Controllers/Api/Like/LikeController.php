<?php

namespace App\Http\Controllers\Api\Like;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateLike;
use App\Events\LikeCreated;
use App\Events\LikeUpdated;
use App\Events\LikeDestroyed;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $likes = Like::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $likes);
        } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch  likes.', 'error code' => '500'], 500); } 
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
     * @param  App\Http\Requests\ValidateLike;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateLike $request)
    {
         $input = $request->validated();              
        try{ 
           $like = Like::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create like','error code' => '500'], 500); }  
        event(new LikeCreated($like));
        return response()->json( [$like, "success"=>"like created successfully"]);
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
           $like = Like::findOrFail($id);
           return response()->json( $like);
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
     * @param  App\Http\Requests\ValidateLike;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateLike $request, $id)
    {
        $input = $request->validated();
       try{ 
            $like = Like::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $like->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update like','error code' => '500'], 500); }  
        event(new LikeUpdated($like));
       return response()->json( [$like, "success"=>"like updated successfully"]);
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
            $like = Like::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $like->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete like','error code' => '500'], 500); }   
        event(new LikeDestroyed($like));
        return response()->json( [$like, "success"=>"like deleted successfully"]);
    }
}
