<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    /**
     * 文章首頁
     *
     * @return void
     */
    public function index()
    {
        return view('post');
    }

    //API

    /**
     * 取得所有文章
     *
     * @return void
     */
    public function getAllPost()
    {
        return response()->json(Post::all());
    }

    /**
     * 取得單一文章
     *
     * @param [type] $id
     * @return void
     */
    public function findPostById($id)
    {
        return response()->json(Post::find($id));
    }

    /**
     * 建立文章
     *
     * @param Request $request
     * @return void
     */
    public function createPost(Request $request)
    {
        $post = new Post();
        $post->title = $request->input('title','');
        $post->body = $request->input('body','');
        $result = $post->save();

        return response()->json(['result',$result],200);
    }

    /**
     * 修改文章
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function editPost(Request $request, $id)
    {
        $msg = '';
        $post = Post::find($id);
        if ($post) {
            $post->title = $request->input('title','');
            $post->body = $request->input('body','');
            $result = $post->save();
            if (!$result) $msg = '更新失敗!';
        }
        else {
            $msg = '找不到文章!';
        }
        return response()->json(['result'=> $result,'msg'=> $msg], 200);
    }

    /**
     * 刪除文章
     *
     * @param [type] $id
     * @return void
     */
    public function deletePost($id)
    {
        $row = Post::destory($id);
        $result = ($row > 0);
        return response()->json(['result'=> $result],200);
    }

}
