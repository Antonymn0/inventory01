<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Requests\ValidateReview;
use App\Events\ReviewCreated;
use App\Events\ReviewUpdated;
use App\Events\ReviewDestroyed;

class ReviewController extends Controller
{
    /**
     * Display a listing of the review resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try {
            $reviews = Review::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $reviews);
        } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch  reviews.', 'error code' => '500'], 500); } 
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
     * @param  App\Http\Requests\ValidateReview  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateReview $request)
    {
        $input = $request->validated();              
        try{ 
           $review = Review::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create review','error code' => '500'], 500); }  
        event(new ReviewCreated($review));
        return response()->json( [$review, "success"=>"review created successfully"]);
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
           $review = Review::findOrFail($id);
           return response()->json( $review);
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
     * Update the specified review resource in storage.
     *
     * @param  App\Http\Requests\ValidateReview  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateReview $request, $id)
    {
       $input = $request->validated();
       try{ 
            $review = Review::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $review->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update review','error code' => '500'], 500); }  
        event(new ReviewUpdated($review));
       return response()->json( [$review, "success"=>"review updated successfully"]);
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
            $review = Review::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $review->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete review','error code' => '500'], 500); }   
        event(new ReviewDestroyed($review));
        return response()->json( [$review, "success"=>"review deleted successfully"]);
    }
}
