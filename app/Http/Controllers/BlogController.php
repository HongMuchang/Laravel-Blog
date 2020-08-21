<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    //---------------------------------
    ///*----ブログ一覧表示画面----*/
    //---------------------------------
    public function showList()
    {
        
        $blogs=Blog::all();//モデルにあるDBの情報を受け取る
        
        //第二引数に指定することで受け取ったDB情報($blogs[model]->blogs[contoroller]->$blog[view])をViewに渡す
        return view("blog.list",["blogs"=>$blogs]);
    }
    
    //---------------------------------
    ///*----ブログ詳細画面----*/
    //---------------------------------
    public function showDetail($id)
    {
        $blog=Blog::find($id);//一件取得
        
        //もしデータが無ければ
        if(is_null($blog)){
        
            \Session::flash('err_msg','データがありません');//セッションでエラ〜メッセージ記憶
            return redirect(route('blogs'));//一覧画面に戻す
        
        }

        return view("blog.detail",["blog"=>$blog]);
    }

    //---------------------------------
    ///*----ブログ登録画面表示----*/
    //---------------------------------
    public function showCreate()
    {
    return view("blog.form");
    }

    //---------------------------------
    ///*----ブログ登録機能----*/
    //---------------------------------
    public function exeStore(BlogRequest $request)
    {
        $inputs=$request->all();
        
        //トランザクション開始
        \DB::beginTransaction();
        try {
            Blog::create($inputs);//DBに追加
            \DB::commit();
        } catch (\Throwable $e) {
            abort(500);//500エラーページが表示される
            \DB::rolleback();
        }
        \Session::flash('err_msg','ブログを登録しました');//セッションに保存

        //一覧画面に戻す
        return redirect(route('blogs'));    
    }

    //---------------------------------
    //ブログ編集画面表示
    //---------------------------------
    public function showEdit($id)
    {
        $blog=Blog::find($id);//一件取得
        
        //もしデータが無ければ
        if(is_null($blog)){
        
            \Session::flash('err_msg','データがありません');//セッションでエラ〜メッセージ記憶
            return redirect(route('blogs'));//一覧画面に戻す
        }

        return view("blog.edit",["blog"=>$blog]);
    }

    //---------------------------------
    //更新実行
    //---------------------------------
    public function exeUpdate(BlogRequest $request)
    {
        $inputs=$request->all();

        //トランザクション開始
        \DB::beginTransaction();
        try {
            $blog=Blog::find($inputs["id"]);//DBに追加
            
            //更新実行
            $blog->fill([
                'title'=>$inputs['title'],
                'content'=>$inputs['content'],
            ]);
            $blog->save();
            \DB::commit();
        } catch (\Throwable $e) {
            abort(500);//500エラーページが表示される
            \DB::rolleback();
        }
        \Session::flash('err_msg','ブログを更新しました');//セッションに保存

        //一覧画面に戻す
        return redirect(route('blogs'));    
    }

    //---------------------------------
    //ブログ削除
    //---------------------------------
    public function showDelete($id)
    {
        $blog=Blog::find($id);//一件取得
        //もしデータが無ければ
        if(is_null($blog)){
        
            \Session::flash('err_msg','データがありません');//セッションでエラ〜メッセージ記憶
            return redirect(route('blogs'));//一覧画面に戻す
        }
        $blog->delete();
        \Session::flash('err_msg','データを削除しました');
        $blogs=Blog::all();
        return view("blog.list",["blogs"=>$blogs]);
    }
}