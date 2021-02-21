<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateComment;
use App\Events\CommentCreated;
use App\Events\CommentUpdated;
use App\Events\CommentDestroyed;

class CommentController extends Controller
{
    /**
     * Display a listing of the comment resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
             $comments = Comment::paginate(env('API_POSTS_PER_PAGE') );
            return response()->json( $comments);
         } catch (\Exception $e) {  return response()->json(['error' => 'Something went wrong. Could not fetch comments.', 'error code' => '500'], 500); } 
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
     * Store a newly created comment resource in storage.
     *
     * @param  App\Http\Requests\ValidateComment;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateComment $request)
    {
        $input = $request->validated();
        try{ 
           $comment = Comment::create($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not create comment','error code' => '500'], 500); }  
        event(new CommentCreated($comment));
        return response()->json( [$comment, "success"=>"comment created successfully"]);
    }

    /**
     * Display the specified comment resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{ 
           $comment = Comment::findOrFail($id);
           return response()->json( $comment);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified comment resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateComment  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateComment $request,$id)
    {
        $input = $request->validated();

       try{ 
            $comment = Comment::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $comment->update($input);
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not update comment','error code' => '500'], 500); }  
        event(new CommentUpdated($comment));
       return response()->json( [$comment, "success"=>"comment updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{ 
            $comment = Comment::findOrFail($id);
        }catch(\Exception $e) { return response()->json(['error' => 'Resource not found','error code' => '404'], 404);  } 
        try{ 
           $comment->delete();
        } catch (\Exception $e) { return response()->json(['error' => 'Something went wrong. Could not delete comment','error code' => '500'], 500); }   
        event(new CommentDestroyed($comment));
        return response()->json( [$comment, "success"=>"comment deleted successfully"]);
    }
}
