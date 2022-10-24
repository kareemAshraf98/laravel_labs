<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        // $allposts = Post::all();
        // dd($allposts);
        $allposts= Post::all();

        // $allposts = [
        //    // ['id' => 1 , 'title' => 'laravel is cool', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
        //   //  ['id' => 2 , 'title' => 'PHP deep dive', 'posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
        // ];
        // dd($allposts);
        return view('posts.index', [
          'posts' => $allposts,
            Post::paginate(25)
        ]);
    }
    public function create()
    {
        $allUsers = User::all();
        return view('posts.create', [

            'allUsers' => $allUsers
        ]);
    }

    public function show($postId)
    {
        // $arr = [
        //     ['id' => 1 , 'title' => 'laravel is cool', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22','email'=>'ahmed@gmail.com'],
        //     ['id' => 2 , 'title' => 'PHP deep dive', 'posted_by' => 'Mohamed', 'creation_date' => '2022-10-15','email'=>'mohammed@gmail.com'],
        // ];
        // dd($arr);
        // $post = Post::find($postId)
            $arr=POST::find($postId);
            // dd($arr);
            // dd($arr[$postId]);
        return  view('posts.show',[
            'post' => $arr
        ]);
    }

    public function store()
    {
        $data = request()->all();
        // dd($data);
        Post::create([
            'title' => request()->title,
            'description' => $data['description'],
            'user_id' => $data['post_creator']
        ]);


       return redirect()->route('posts.index');
    }
    public function edit($view){
        $singlePost = Post::find($view);
        // dd($view);
        return view('posts.edit',[
            'post'=>$singlePost
        ]);
    }

    public function update($update){
        $upTodate=request()->all();
        $singlePost = Post::find($update);
        $singlePost->update([
            'title' => request()->title,
            'description' => $upTodate['description']
        ]);
        return redirect()->route('posts.index');
    }
    public function destroy($post){
        $singlePost = Post::find($post);
        $singlePost->delete();
        return redirect()->route('posts.index');
    }
}
