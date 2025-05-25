<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'content' => 'required',
            'excerpt' => 'required|string',
            'featured_image' => 'required|image',
            'published_date' => 'required|date',
        ]);

        // Delete old post if old_post_id is provided
        if ($oldPostId = $request->input('old_post_id')) {
            $this->deletePostById($oldPostId);
        }

        // Create new post
        $post = Post::create([
            'title'          => $validated['title'],
            'slug'           => $validated['slug'],
            'content'        => $validated['content'],
            'excerpt'        => $validated['excerpt'],
            'published_date' => $validated['published_date'],
        ]);

        if ($request->hasFile('featured_image')) {
            $image      = $request->file('featured_image');
            $extension  = $image->getClientOriginalExtension();
            $imageName  = $post->id . '.' . $extension;
            $path       = $image->storeAs('images', $imageName, 'public');

            $post->featured_image = $path;
            $post->save();
        }
 
        return redirect('/');
    }


    private function deletePostById($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return;
        }   

        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();
    }

    public function destroy($id){
        $this->deletePostById($id);
        return redirect('/')->with('success', 'Post deleted successfully!');
    }

    public function create() 
    {
        return view('pages.create', ['post' => null]);
    }

    public function edit($id) 
    {
        $post = Post::findOrFail($id);
        return view('pages.create', compact('post'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            abort(404, 'Post not found');
        }

        return view('pages.show', compact('post'));
    }

}