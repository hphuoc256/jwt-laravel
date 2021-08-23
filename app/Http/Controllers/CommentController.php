<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function listComment()
    {
        // $data = Comment::with('user')->with('product')->paginate(10);
        $rep = Comment::with('reply_comment')->paginate(10);
        if($rep) {
            return response()->json(['code' => 200,'message' => 'Success', 'rep' => $rep]);
        }
        else {
            return $this->error();
        }
    }

    public function addComment(Request $request)
    {
        $data = new Comment();
        $data->title = $request->title;
        $data->content = $request->content;
        $data->status = $request->status;
        $data->user_id = auth()->user()->id;
        $data->product_id = $request->product_id;
        if($data->save()) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function getComment($id)
    {
        $data = Comment::with('user')->where('id',$id)->with('product')->get()->toArray();
        if($data) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function updateComment(Request $request, $id)
    {
        $data = Comment::find($id);
        if(! $data) {
            return $this->error();
        }
        else {
            $data->title = $request->title;
            $data->content = $request->content;
            $data->status = $request->status;
            $data->user_id = auth()->user()->id;
            $data->product_id = $request->product_id;
            if($data->save()) {
                return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
            }
            else {
                return $this->error();
            }
        }
    }
    
    public function deleteComment($id)
    {
        $data = Comment::find($id);
        if(!$data) {
            return $this->error();
        }
        $data->delete();
        return response()->json(['code' => 200,'message' => 'Success']);
    }



    protected function error(){
        return response()->json([
            'code' => 403,
            'message' => 'Error',
        ]);
    }
}
