<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    public function index() {
        $posts = Post::all()->sortByDesc('id');
        return view('posts', compact('posts'));
    }

    public function create() {
        return view('create');
    }

    public function getPost($id) {
        $post = Post::find($id);
        return view('post', compact('post'));
    }

    public function update($id) {
        $post = Post::find($id);
        if( Auth::user()->isAdmin or (Auth::user()->id == $post->user->id) ) {
            return view('create', compact('post'));
        } else {
            return redirect(route('index'));
        }
    }

    public function edit($id, Request $request) {
        Post::where('id', $id)
            ->update([
                'title' => $request->title,
                'text' => $request->text,
                'updated_at' => now()
            ]);
        return redirect(route('index'));
    }

    public function store(Request $request) {
        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;
        $post->user_id = Auth::id();
        $post->save();
        return redirect(route('index'));
    }

    public function delete($id) {
        $post = Post::find($id);
        if(Auth::user()->isAdmin or (Auth::user()->id == $post->user->id) ) {
            Post::destroy($id);
        }
        return redirect(route('index'));
    }
}
