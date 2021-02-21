<?php

namespace App\Http\Controllers\Api\Coupon;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateCoupon;
use App\Events\CouponCreated;
use App\Events\CouponUpdated;
use App\Events\CouponDestroyed;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
             $coupons = Coupon::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $coupons);
         } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch coupons.', 'error code' => '500'], 500); } 
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
     * @param  App\Http\Requests\ValidateCoupon;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCoupon $request)
    {
        $input = $request->validated();
        try{ 
           $coupon = Coupon::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create coupon','error code' => '500'], 500); }  
        event(new CouponCreated($coupon));
        return response()->json( [$coupon, "success"=>"Coupon created successfully"]);
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
           $coupon = Coupon::findOrFail($id);
           return response()->json( $coupon);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ValidateCoupon;  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCoupon $request,  $id)
    {
        $input = $request->validated();
       try{ 
            $coupon = Coupon::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $coupon->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update coupon','error code' => '500'], 500); }  
        event(new CouponUpdated($coupon));
       return response()->json( [$coupon, "success"=>"coupon updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {  
         try{ 
           $coupon->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete coupon','error code' => '500'], 500); }   
        event(new CouponDestroyed($coupon));
        return response()->json( [$coupon, "success"=>"coupon deleted successfully"]);
    }
}
