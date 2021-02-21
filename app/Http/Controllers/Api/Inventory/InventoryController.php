<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateInventory;
use App\Events\InventoryCreated;
use App\Events\InventoryUpdated;
use App\Events\InventoryDestroyed;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $inventories = Inventory::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $inventories);
        } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch  inventories.', 'error code' => '500'], 500); } 
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
     * @param  \App\Http\requests\validateInventory; $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateInventory $request)
    {
        $input = $request->validated();              
        try{ 
           $inventory = Inventory::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create inventory','error code' => '500'], 500); }  
        event(new InventoryCreated($inventory));
        return response()->json( [$inventory, "success"=>"inventory created successfully"]);
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
           $inventory = Inventory::findOrFail($id);
           return response()->json( $inventory);
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
     * @param  \App\Http\Request\ValidateInventory  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateInventory $request, $id)
    {
       $input = $request->validated();
       try{ 
            $inventory = Inventory::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $inventory->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update inventory','error code' => '500'], 500); }  
        event(new InventoryUpdated($inventory));
       return response()->json( [$inventory, "success"=>"inventory updated successfully"]);
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
            $inventory = Inventory::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $inventory->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete inventory','error code' => '500'], 500); }   
        event(new InventoryDestroyed($inventory));
        return response()->json( [$inventory, "success"=>"inventory deleted successfully"]);
    }
}
