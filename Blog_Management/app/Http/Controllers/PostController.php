<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\post;
class PostController extends Controller
{
    public function index(){
        $posts = post::simplePaginate(3);
        
        return view('welcome',compact('posts'));
    }
    
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $post = new Post;

        $post->title = $request->title;
        $post->content = $request->content;
        
        if($request->hasFile('img')){
            $imgPath=$request->File('img')->store('uploads','public');    
            $post->img =$imgPath;
        }
        $post->user_id=session('LoggedUser');
        $post->save();
        return redirect()->route('user.dashboard')->with('success', 'Post created Successfully');
    }

    public function destroy($id){
        $post=Post::find($id);
        if(!$post){
            return redirect()->route('user.dashboard')->with('error', 'Post not found'); 
        }
        if(session('LoggedUser')!==$post->user_id){
            return redirect()->route('user.dashboard')->with('error', 'Your are not authorize');
        }
        $post->delete();
        return redirect()->route('user.dashboard')->with('success', 'Post Deleted Successfully');
    }


    public function edit($id){
        $post=Post::find($id);
        if(!$post){
            return redirect()->route('user.dashboard')->with('error', 'Post not found'); 
        }
        if(!session('LoggedUser')){
            return redirect()->route('user.dashboard')->with('error', 'Your must be login to edit');
        }
        
        if(session('LoggedUser')!==$post->user_id){
            return redirect()->route('user.dashboard')->with('error', 'Your are not authorize');
        }
        return view('user.edit',['post'=>$post]);
    }



    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $post=Post::find($id);

        if(!$post){
            return redirect()->route('user.dashboard')->with('error', 'Post not found'); 
        }
        if(!session('LoggedUser')){
            return redirect()->route('user.dashboard')->with('error', 'Your must be login to edit');
        }
        
        if(session('LoggedUser')!==$post->user_id){
            return redirect()->route('user.dashboard')->with('error', 'Your are not authorize');
        }
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        
        if($request->hasFile('img')){
            Storage::delete('public/'.$post->img);
            $imgPath=$request->File('img')->store('uploads','public');    
            $post->img =$imgPath;
        }
        $post->save();
        return redirect()->route('user.dashboard')->with('success', 'Your are updated post');
    }
}
