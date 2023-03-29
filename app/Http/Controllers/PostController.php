<?php

namespace App\Http\Controllers;

use App\Contracts\Likeable;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Dotenv\Repository\Adapter\ReplacingWriter;
use http\Env\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return view('dashboard.posts.index', ['posts' => $post]);
    }
    public function show()
    {
        $posts = Post::orderBy('id','DESC')->get();
        return view('dashboard.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function search(Request $request){

        if($request->tagVal !== "") {
            $data = DB::table('tags')->where('name', 'LIKE', '%' . $request->tagVal . "%")->get();
            // $data['search']=$tags;
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->name . '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'موردی پیدا نشد' . '</li>';
            }
            return $output;
        }
       // return view('posts.search');
    }
    public function showPost(Post $post){

        return view('dashboard.posts.show', ['post' => $post]);
    }

    public function create(Request $request)
    {
        $categories =Category::all();
        $tags =Tag::all();
        return view('dashboard.posts.create',[
            'categories'=>$categories,
            'tags'=>$tags
        ]);

    }

    public function edit(Post $post)
    {
            $categories = Category::all();
        return view('dashboard.posts.edit',[
            'post'=>$post,
            'categories'=>$categories
        ]);

    }
public function ckeditor(Request $request){
    $path_url = '/storage/' . Auth::id();

    if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = Str::slug($fileName) . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path($path_url), $fileName);
        $url = asset($path_url . '/' . $fileName);
    }

    return response()->json(['url' => $url]);
}
    public function store(PostRequest $request)
    {

        $request->validated();

            if ($request->has('img')) {
                $request->validated();
                $file = $request->file('img')->getClientOriginalName();
                $fileName = time() . "_" . $file;
                $directory = 'public/images';
                Storage::makeDirectory($directory);
                $path = $request->file('img')->storeAs('public/images',$fileName);
                $id = Auth::id();

              $post=  Post::create([
                    "user_id" => $id,
                    "cat_id" =>  $request->category,
                    "title" => $request->title,
                    "subtitle" => $request->subtitle,
                    "banner_image" => $fileName,
                    "content" => $request->ckeditor,
                ]);
                $post = DB::table('posts')->orderBy('id','DESC')->first();
                $tagItems =$request->tag;
                foreach ($tagItems as $tagItem){
                    $name = Str::lower($tagItem);
                    Tag::firstOrCreate([
                        'name'=>$tagItem,
                        'slug'=>preg_replace('/\s+/', '-', trim($name))
                    ]);
                    $tag = DB::table('tags')->where('name',$tagItem)->orderBy('id','DESC')->first();
                    $posts=Post::find($post->id);
                    $posts->tags()->attach($tag->id,['taggable_id'=>$post->id]);
                }




            } else {
                $request->validated();
                $id = Auth::id();

                Post::create([
                    "user_id" => $id,
                    "cat_id" => $request->category,
                    "title" => $request->title,
                    "subtitle" => $request->subtitle,
                    "content" => $request->ckeditor,
                ]);
                $post = DB::table('posts')->orderBy('id','DESC')->first();

                $tagIems =$request->tag;
                if($tagIems != null) {
                    foreach ($tagIems as $tagItem) {
                        $name = Str::lower($tagItem);
                        Tag::firstOrCreate([
                            'name' => $tagItem,
                            'slug' => preg_replace('/\s+/', '-', trim($name))
                        ]);
                        $tag = DB::table('tags')->where('name', $tagItem)->orderBy('id', 'DESC')->first();
                        $posts = Post::find($post->id);
                        $posts->tags()->attach($tag->id, ['taggable_id' => $post->id]);
                    }
                }

            }

        return redirect()->route('posts.show');


    }
    public function update(Post $post,PostRequest $request){


         $request->validated();

        if ($request->has('img')) {
            $file = $request->file('img')->getClientOriginalName();
            $fileName = time() . "_" . $file;
            $directory = 'public/images';
            Storage::makeDirectory($directory);
            $path = $request->file('img')->storeAs('public/images',$fileName);
            $id = Auth::id();

            $post = Post::find($post->id);
            if( $request->category != null){
                $post->cat_id = $request->category;
            }
            $post->title = $request->title;
            $post->subtitle = $request->subtitle;
            $post->content = $request->ckeditor;
            $post->banner_image = $fileName;
            $post->save();
            $tagItems =$request->tag;
            $removeTagItems =$request->removetag;
            if ($tagItems !== null) {
                foreach ($tagItems as $tagItem) {
                    $name = Str::lower($tagItem);
                    Tag::firstOrCreate([
                        'name' => $tagItem,
                        'slug' => preg_replace('/\s+/', '-', trim($name))
                    ]);

                    $tag = DB::table('tags')->where('name', $tagItem)->orderBy('id', 'DESC')->first();
                        $post->tags()->attach($tag->id, ['taggable_id' => $post->id]);
                }
            }
            if ($removeTagItems !== null) {
                foreach ($removeTagItems as $removeTagItem) {

                    $tag = DB::table('tags')->where('name', $removeTagItem)->orderBy('id', 'DESC')->first();
                    $post->tags()->detach([$tag->id]);
                }
            }
        } else {
            $post = Post::find($post->id);
            if ($request->category !== null) {
                $post->cat_id = $request->category;
            }
            $post->title = $request->title;
            $post->subtitle = $request->subtitle;
            $post->content = $request->ckeditor;
            $post->save();
            $tagItems = $request->tag;
            $removeTagItems = $request->removetag;

            if ($tagItems !== null) {
                foreach ($tagItems as $tagItem) {
                    $name = Str::lower($tagItem);
                    Tag::firstOrCreate([
                        'name' => $tagItem,
                        'slug' => preg_replace('/\s+/', '-', trim($name))
                    ]);
                    $tag = DB::table('tags')->where('name', $tagItem)->orderBy('id', 'DESC')->first();
                        $post->tags()->attach($tag->id, ['taggable_id' => $post->id]);
                }
            }
            if ($removeTagItems !== null) {
                foreach ($removeTagItems as $removeTagItem) {

                    $tag = DB::table('tags')->where('name', $removeTagItem)->orderBy('id', 'DESC')->first();
                    $post->tags()->detach([$tag->id]);
                }
            }
        }
        return redirect()->route('posts.show');

    }

    public function destroy(Request $request){
        $post = Post::find($request->id);
       $data = $post->delete();
       $post->tags()->detach();
       $post->likes()->where('likeable_id',$request->id)->delete();

        return response()->json(['success' => 'آیتم با موفقیت اضافه شد', 'data' => $data]);

    }
}
