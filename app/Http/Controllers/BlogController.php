<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Session;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BlogController extends Controller
{

    //Blog in Client Start
    public function index()
    {
        $posts = Blog::orderBy('updated_at', 'DESC')->get();
        return view('blog.post', compact('posts'));
    }

    public function showPostDetail($slug){
        $post = Blog::where('slugblog', $slug)->first();
        return view('blog.post-details',compact('post'));
    }
    //Blog in Client End




    //Posts in ADMIN Start
    public function posts()
    {
        Session::put('page','posts');
        $posts = Blog::orderBy('updated_at', 'DESC')->get();
        return view('admin.posts', compact('posts'));
    }

    //Add, Edit Post
    public function addEditPost(Request $request, $id = null)
    {
        if ($id == '') {
            $post = new Blog;
            $title = 'Add Post';
            $message = 'Your post has been added successfully';
        } else {
            $post = Blog::find($id);
            $title = 'Edit Post';
            $message = 'Your post has been updated successfully';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'title' => 'required|min:6',
                'description' => 'required',
                'image_path' => 'required|mimes:jpg,jpeg,png|max:5048',
            ];
            $customMessage = [
                'title.required' => 'Enter Title',
                'description.required' => 'Enter Description',
                'image_path.required' => 'Select Image',
            ];
            $this->validate($request, $rules, $customMessage);
            $newImageName = uniqid() . '-' . $data['title'] . '.' . $data['image_path']->extension();

            $data['image_path']->move(public_path('images'), $newImageName);

            $slug = SlugService::createSlug(Blog::class, 'slugblog', $data['title']);

            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->slugblog = $slug;
            $post->image_path = $newImageName;
            $post->idUser = Auth::id();
            $post->save();
            session::flash('success_message', $message);
            return redirect('admin/posts');
        }
        return view('admin.add_edit_post', compact('post', 'title'));
    }

    //Delete Post
    public function deletePost(Request $request){
        $idPost = $request->input('idPost');
        if (Blog::where('_id', $idPost)->exists()) {
            $post = Blog::where('_id', $idPost)->first();
            $post->delete();
            $posts = Blog::all();
            return response()->json(['status' => "Post Deleted Successfully",'view' => (string)View::make('includes.admin.posts-items')->with(compact('posts'))]);
        }
    }
}
