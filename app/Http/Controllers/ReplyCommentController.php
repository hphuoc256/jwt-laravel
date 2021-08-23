<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplyComment;


class ReplyCommentController extends Controller
{
    public function listReplyComment()
    {
        $data = ReplyComment::paginate(7);
        if($data) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function addReplyComment(Request $request)
    {
        $data = new ReplyComment();
        $data->title = $request->title;
        $data->content = $request->content;
        $data->status = $request->status;
        $data->user_id = auth()->user()->id;
        $data->comment_id = $request->comment_id;
        if($data->save()) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function getReplyComment($id)
    {
        $data = ReplyComment::with('user')->where('id',$id)->with('comment')->get()->toArray();
        if($data) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function updateReplyComment(Request $request, $id)
    {
        $data = ReplyComment::find($id);
        if(! $data) {
            return $this->error();
        }
        else {
            $data->title = $request->title;
            $data->content = $request->content;
            $data->status = $request->status;
            $data->user_id = auth()->user()->id;
            $data->comment_id = $request->comment_id;
            if($data->save()) {
                return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
            }
            else {
                return $this->error();
            }
        }
    }

    public function deleteReplyComment($id)
    {
        $data = ReplyComment::find($id);
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
