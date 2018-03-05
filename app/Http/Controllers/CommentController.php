<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use Request;
use Validator;

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
}
