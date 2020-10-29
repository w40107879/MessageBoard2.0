<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/posts', function (){
    return response()->json(App\Post::all(),200);
});
Route::get('/posts/{id}', function ($id){
    return response()->json(App\Post::find($id),200);
});
Route::post('/posts/', function(Request $request){
    $post = new App\Post;
    $post->title = $request->input('title', '');
    $post->body = $request->input('body', '');
    $result = $post->save();

    return response()->json(['result' => $result], 200);
});
Route::put('/posts/{id}', function(Request $request, $id) {
   $result = false;
   $msg = '';

   $post = App\Post::find($id);
   if ($post) {
       $post->title = $request->input('title', '沒有標題');
       $post->body = $request->input('body', '沒有內容');
       $result = $post->save();
       if (!$result) $msg = '更新失敗!';
   } else {
       $msg = '找不到文章';
   }

   return response()->json(['result' => $result, 'msg' => $msg], 200);
});
Route::delete('/posts/{id}', function($id) {
   $rows = App\Post::destory($id);
   $result = ($row > 0);
   return response()->json(['result' => $result], 200);
});
