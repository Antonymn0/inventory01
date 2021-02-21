<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateBrand;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Events\BrandCreated;
use App\Events\BrandUpdated;
use App\Events\BrandDestroyed;

class BrandController extends Controller
{
    /**
     * Display a listing of the brand resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        $brands = Brand::paginate(env('API_POSTS_PER_PAGE') );
        return response()->json( $brands);
        }catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not fetch units','error code' => '500'], 500); }  
    }

    /**
     * Store a newly created brand resource in storage.
     *
     * @param  App\Http\Requests\ValidateBrand;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateBrand $request)
    {
        $input = $request->validated();
        try{ 
           $brand = Brand::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create brand','error code' => '500'], 500); }  
        event(new BrandCreated($brand));
        return response()->json( [$brand, "success"=>"Brand created successfully"]);  
        
    }

    /**
     * Display the specified brand resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{ 
           $brand = Brand::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        return response()->json( $brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ValidateBrand;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateBrand $request, $id)
    {
        $input = $request->validated();
       try{ 
            $brand = Brand::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $brand->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update brand','error code' => '500'], 500); }  
        event(new BrandUpdated($brand));
       return response()->json( [$brand, "success"=>"Brand updated successfully"]);
    }

    /**
     * Remove the specified brand resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        try{ 
            $brand = Brand::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $brand->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete brand','error code' => '500'], 500); }   
        event(new BrandDestroyed($brand));
        return response()->json( [$brand, "success"=>"Brand deleted successfully"]);

    }
}
