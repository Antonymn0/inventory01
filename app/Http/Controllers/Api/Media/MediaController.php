<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Requests\ValidateMedia;
use App\Events\MediaCreated;
use App\Events\MediaUpdated;
use App\Events\MediaDestroyed;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $media = Media::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $media);
        } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch  media.', 'error code' => '500'], 500); } 
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
     * @param  App\Http\Requests\ValidateMedia;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateMedia $request)
    {
        $input = $request->validated();              
        try{ 
           $media = Media::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create media','error code' => '500'], 500); }  
        event(new MediaCreated($media));
        return response()->json( [$media, "success"=>"media created successfully"]);
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
           $media = Media::findOrFail($id);
           return response()->json( $media);
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
     * @param  \App\Http\Requests\ValidateMedia  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateMedia $request, $id)
    {
       $input = $request->validated();
       try{ 
            $media = Media::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $media->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update media','error code' => '500'], 500); }  
        event(new MediaUpdated($media));
       return response()->json( [$media, "success"=>"media updated successfully"]);
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
            $media = Media::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $media->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete media','error code' => '500'], 500); }   
        event(new MediaDestroyed($media));
        return response()->json( [$media, "success"=>"media deleted successfully"]);
    }
}
