<?php

namespace App\Http\Controllers\Api\Download;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateDownload;
use App\Events\DownloadCreated;
use App\Events\DownloadUpdated;
use App\Events\DownloadDestroyed;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $downloads = Download::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $downloads);
         } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch  downloads.', 'error code' => '500'], 500); } 
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
     * @param  \App\Http\Requests\ValidateDownload  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateDownload $request)
    {
         $input = $request->validated();         
        try{ 
           $download = Download::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create download','error code' => '500'], 500); }  
        event(new DownloadCreated($download));
        return response()->json( [$download, "success"=>"download created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       try{ 
           $download = Download::findOrFail($id);
           return response()->json( $download);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\ValidateDownload  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateDownload $request, $id)
    {
       $input = $request->validated();
       try{ 
            $download = Download::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $download->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update download','error code' => '500'], 500); }  
        event(new DownloadUpdated($download));
       return response()->json( [$download, "success"=>"download updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try{ 
            $download = Download::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $download->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete download','error code' => '500'], 500); }   
        event(new DownloadDestroyed($download));
        return response()->json( [$download, "success"=>"download deleted successfully"]);
    }
}

