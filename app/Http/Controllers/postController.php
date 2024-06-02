<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class postController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->get(); // Adjust the number as needed
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable | string | max:255',
            'body' => 'required',
            'image' => 'nullable |max:2048',
        ]);



        if ($request->hasFile('image')) {

            $postsImage = $validatedData['image'];
            $postsImagePath = $postsImage->store('posts', 'public');

        }

        try {
            POST::create([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'image' => $postsImagePath,
                'user_id' => auth()->user()->id
            ]);
        } catch (Exception $e) {
            redirect()->route('posts.index')->with('danger', 'Something went wrong.' . $e->getMessage());
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        $comments = $post->comments;
        return view('post.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if(!empty($post->image) && Storage::exists($post->image)) {
            Storage::delete($post->image);
        }

        // Check if a file is present in the request
        if ($request->hasFile('image')) {
            // Store the new image and update the post
            $post->update([
                'title' => $request->title,
                'body' => $request->body,
                'image' => $request->file('image')->store('posts', 'public'),
            ]);
        } else {
            // Update the post without changing the image
            $post->update([
                'title' => $request->title,
                'body' => $request->body,
            ]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
