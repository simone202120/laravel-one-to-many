<?php

namespace App\Http\Controllers\Admin;

use App\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Auth\Events\Validated;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required|max:65535',
            'category_id'=>'nullable|exists:categories,id'


        ]);

        $post=new Post();
        $data= $request->all();
        $post->fill($data);

        $slug = $this->calculateSlug($post->title);

        $post->slug = $slug;

        $post->save();

        return redirect()->route('admin.posts.index')->with('status', 'Post creato con successo!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories=category::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required|max:65535',
            'category_id'=>'nullable|exists:categories,id'

        ]);

        $data=$request->all();

        if ($post->title !== $data['title']) {
            $data['slug'] = $this->calculateSlug($data['title']);
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('status', 'Post aggiornato con successo!');
    }

    protected function calculateSlug($title) {

       
        $slug = Str::slug($title, '-');

        $checkPost = Post::where('slug', $slug)->first();

        $counter = 1;

        while($checkPost) {
            $slug = Str::slug($title . '-' . $counter, '-');
            $counter++;
            $checkPost = Post::where('slug', $slug)->first();
        }
        

        return $slug;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Cancellazione avvenuta con successo!');
    }
    
}
