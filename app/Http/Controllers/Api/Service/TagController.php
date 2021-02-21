<?php

namespace App\Http\Controllers\Api\Service;

use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateNewTag;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Events\TagCreated;
use App\Events\TagUpdated;
use App\Events\TagDestroyed;

class TagController extends Controller
{
    /**
     * Display a listing of the tags.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tags = Tag::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json($tags);
         } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Could not fetch tags.', 'error code' => '500'], 500);
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
     * @param  App\Http\Requests\ValidateNewTag;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateNewTag $request)
    {          
        $input = $request->validated();
        try{
            $tag = Tag::create($input); 
                     
        }catch(\Exception $e) { 
            return response()->json(['error' => 'Something went wrong. Could not create tag.'], 500);
         }
       event(new TagCreated($tag));
       return response()->json([ "success" => "Tag Created"], $tag);       
    }

    /**
     * Display the specified tag resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
          $tag = Tag::findOrFail($id);  
          return response()->json(['success'=> 'success', $tag]);
        }catch(\Exception $e){
            return response()->json(['error' => 'Resource not found'], 404);
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
     * @param  App\Http\Requests\ValidateNewTag;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateNewTag $request, $id)
    {
        $input = $request->validated();
        try{
          $tag = Tag::findOrFail($id); 
        }catch(\Exception $e){ 
             return response()->json(['error' => 'Resource not found'], 404); 
             }       
        try{
            $tag->update($input);                    
        }catch(\Exception $e) { 
            return response()->json(['error' => 'Something went wrong. Could not update tag.'], 500); 
         }
        event(new TagUpdated($tag));
        return response()->json([$tag, "success" => "Tag updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{  $tag = Tag::findOrFail($id);  
        }catch(\Exception $e){
            return response()->json(['error' => 'Resource not found'], 404);
        } 
        try {
            $tag->delete();
        } catch (\Exception $e) { 
            return response()->json(['error' => 'Something went werong. Could not delete tag'], 500); 
         } 
        event(new TagDestroyed($tag));
        return response()->json([$tag, "success" => "Tag deleted"]);
    }
}
