<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Zan;
use Request;
use Validator;
use Auth;

class CommentController extends Controller
{
    //用户评论
    public function doComment(){

        //表单验证规则
        $validator = Validator::make(request()->all(),[
            'user_id' => 'required|integer|exists:users,id',
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        if ($validator->fails()){
            //表单验证失败
            return $validator->errors();
        }

        $data = request(['user_id','post_id']);
        $data['content'] = request('my-editormd-html-code');

        $status = Comment::create($data);
        if ($status){
            //添加评论成功
            return [
                'error' => '1',
                'msg' => '评论成功'
            ];
        }else{
            //添加评论失败
            return [
                'error' => '0',
                'msg' => '评论失败，请稍后重试'
            ];
        }
    }
    //点赞评论
    public function zan($comment_id){
        $zan = new Zan();
        $zan->user_id = Auth::id();
        $zan->comment_id = $comment_id;
        $status = $zan->save();
        if ($status){
            return [
                'error'=>'1',
                'msg'=>''
            ];
        }else{
            return [
                'error'=>'0',
                'msg'=>'点赞失败，请稍后重试'
            ];
        }

    }
    //取消赞评论
    public function unzan($comment_id){

        $status = Zan::where('user_id',Auth::id())->where('comment_id',$comment_id)->delete();

        if ($status){
            return [
                'error'=>'1',
                'msg'=>''
            ];
        }else{
            return [
                'error'=>'0',
                'msg'=>'取消赞失败，请稍后重试'
            ];
        }

    }
}
