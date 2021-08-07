<?php

namespace App\Http\Controllers;

use App\LectureComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LectureCommentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lecture_id' => 'required',
            'comment' => "required",
        ]);

        if ($validator->fails()) {
            $data['errors'] = $validator->errors()->toArray();
        } else {
            $comment = new LectureComment();
            $comment->user_id = Auth::user()->id;
            $comment->lecture_id = $request->lecture_id;
            $comment->comment = $request->comment;
            if ($comment->save()) {
                $data['success'] = "Comment posted.";
            } 
        }
        echo json_encode($data);
    }

    public function user_get_comments(Request $request) {
        $comments = LectureComment::with('user:id,name')->where(['lecture_id' => $request->lecture_id])->orderBy('id', 'DESC')->get()->toArray();
        foreach($comments as $comment) {
            if(Auth::user()->id == $comment['user']['id']){
                $current_user="current-user";
            }
            else{
                $current_user="";
            }
            echo '<div class="card-comment '.$current_user.'">
            <img class="img-circle img-sm" src="'.asset("img/user.png").'" alt="">
            <div class="comment-text">
                <span class="username">
                    '.$comment['user']['name'].'
                    <span class="text-muted float-right">'.date("d-m-Y h:i:s A l", strtotime($comment['created_at'])).'</span>
                </span>
                '.$comment['comment'].'
            </div>
        </div>';
        } 
    } 
}
