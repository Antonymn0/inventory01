<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateAttribute;
use App\Events\AttributeCreated;
use App\Events\AttributeUpdated;
use App\Events\AttributeDestroyed;

class AttributeController extends Controller
{
    /**
     * Display a listing of the attribute resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::paginate(env('API_POSTS_PER_PAGE') );
        return response()->json( $attributes);
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
     * Store a newly created attribute resource in storage.
     *
     * @param  App\Http\Requests\ValidateAttribute;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateAttribute $request)
    {
        $input = $request->validated();
        try{ 
           $attribute = Attribute::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create attribute','error code' => '500'], 500); }  
        event(new AttributeCreated($attribute));
        return response()->json( [$attribute, "success"=>"Attribute created successfully"]);
    }

    /**
     * Display the specified attribute resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        try{ 
           $attribute =  Attribute::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        return response()->json( $attribute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified attribute resource in storage.
     *
     * @param  App\Http\Requests\ValidateAttribute;  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateAttribute $request, $id)
    {
        $input = $request->validated();
        try{ 
           $attribute =  Attribute::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
            $attribute->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create attribute','error code' => '500'], 500); }
        event(new AttributeUpdated($attribute));
        return response()->json( [$attribute, "success"=>"Attribute updated successfully"]);
    }

    /**
     * Remove the specified attribute resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try{ 
           $attribute =  Attribute::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
            $attribute->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create attribute','error code' => '500'], 500); }
        return response()->json( [$attribute, "success"=>"Attribute deleted successfully"]);
    }
}
