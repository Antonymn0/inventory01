<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ValidateCategory;
use App\Events\CategoryCreated;
use App\Events\CategoryUpdated;
use App\Events\CategoryDestroyed;

class CategoryController extends Controller
{
    /**
     * Display a listing of the category  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(env('API_POSTS_PER_PAGE') );
        return response()->json( $categories);
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
     * Store a newly created category resource in storage.
     *
     * @param App\Http\Requests\ValidateCategory;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCategory $request)
    {
        $input = $request->validated();
        try{ 
            $category = Category::create($input); 
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update category','error code' => '500'], 500); }  
        event(new CategoryCreated($category));
        return response()->json( [$category, "success"=>"Category created successfully"]);
    }

    /**
     * Display the specified category resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{ 
            $category = Category::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        return response()->json( $category);
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
     * @param App\Http\Requests\ValidateCategory;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCategory $request, $id)
    {        
        $input = $request->validated();
        try{ 
            $category = Category::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try {
             $category->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update category','error code' => '500'], 500); }  
        event(new CategoryUpdated($category));
        return response()->json( [$category, "success"=>"Category updated successfully"]);
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
            $category = Category::findOrFail($id);  
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try {
            $category->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete category','error code' => '500'], 500); }          
        event(new CategoryDestroyed($category));
        return response()->json([$category, 'success'=> 'Category deleted successfuly.']);
    }
}
