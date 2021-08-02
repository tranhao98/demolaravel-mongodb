<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\PostComment;
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

    public function showPostDetail($slug)
    {
        $post = Blog::where('slugblog', $slug)->first();
        $count_comment = PostComment::where('idPost', $post['_id'])->count();
        return view('blog.post-details', compact('post', 'count_comment'));
    }
    public function loadMoreComment(Request $request)
    {
        $idPost = $request->input('idPost');
        $idComment = $request->input('idComment');

        if ($idComment > 0) {
            $comments = PostComment::where('idPost', $idPost)->where('_id', '<', $idComment)->orderby('created_at', 'DESC')->take(5)->get();
        } else {
            $comments = PostComment::where('idPost', $idPost)->orderby('created_at', 'DESC')->take(5)->get();
        }
        $count_comment = PostComment::where('idPost', $idPost)->count();
        $output = '';
        if ($count_comment > 0) {
            if (!$comments->isEmpty()) {
                foreach ($comments as $cmt) {
                    $last_id = $cmt['_id'];
                    if ($cmt['idUser'] == Auth::id()) {
                        $output .= '
                        <li>
                            <div class="feature-item w-100" style="margin-bottom:15px;">
                                <div class="row">
                                    <div class="left-icon col-2">
                                        <img src="../images/features-first-icon.png" alt="First One">
                                    </div>
                                    <div class="right-content col-10">
                                        <input type="hidden" name="idCmt" id="idCmt" value="' . $cmt['_id'] . '">
                                            <h4>' . $cmt->users->name . '
                                                <small>' . date('d/m/Y H:i A', strtotime($cmt['created_at'])) . '</small>
                                                <span class="float-right btn_delete_cmt mr-2"><a style="cursor: pointer"><i class="pe-7s-trash"
                                            style="font-size: 28px"></i></a></span>
                                                <span class="float-right btn_edit_cmt"><a style="cursor: pointer;"><i class="pe-7s-note"
                                                style="font-size: 28px"></i></a></span>
                                                
                                            </h4>
                                                <p><em>' . $cmt['comment'] . '</em></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        ';
                    } else {
                        $output .= '
                    <li>
                        <div class="feature-item w-100" style="margin-bottom:15px;">
                            <div class="row">
                                <div class="left-icon col-2">
                                    <img src="../images/features-first-icon.png" alt="First One">
                                </div>
                                <div class="right-content col-10">
                                <input type="hidden" name="idCmt" id="idCmt" value="' . $cmt['_id'] . '">
                                    <h4>' . $cmt->users->name . '
                                        <small>' . date('d/m/Y H:i A', strtotime($cmt['created_at'])) . '</small>
                                    </h4>
                                        <p><em>' . $cmt['comment'] . '</em></p>
                                </div>
                            </div>
                        </div>
                     </li>';
                    }
                }
                if ($count_comment > 5) {
                    $output .= '
                    <div id="tabs">
                        <div id="load_more_btn" data-id = ' . $last_id . ' class="main-rounded-button"><a style="cursor: pointer;">Load More</a></div>
                    </div>';
                }
            } else {
                $output .= '';
            }
        } else {
            echo "<h4 class='text-danger'>Don't have any comment</h4>";
        }
        echo $output;
    }
    public function saveComment(Request $request)
    {
        $comment = $request->input('comment');
        $idPost = $request->input('idPost');
        if (Auth::check()) {
            if ($comment == '') {
                return response()->json(['status' => "Required"]);
            } else {
                $saveComment = new PostComment();
                $saveComment['idUser'] = Auth::id();
                $saveComment['idPost'] = $idPost;
                $saveComment['comment'] = $comment;
                $saveComment->save();
                $comments = PostComment::where('idPost', $idPost)->orderby('created_at', 'DESC')->take(5)->get();
                $count_comment = PostComment::where('idPost', $idPost)->count();
                return response()->json(['numberComment' => $count_comment, 'view' => (string)View::make('includes.post-comment')->with(compact('comments', 'count_comment'))]);
            }
        } else {
            return response()->json(['status' => "plsLogin"]);
        }
    }
    public function formEditComment(Request $request)
    {
        $idCmt = $request->input('idCmt');
        $idPost = $request->input('idPost');
        Session::flash('edit', $idCmt);
        $comments = PostComment::where('idPost', $idPost)->orderby('created_at', 'DESC')->get();
        $count_comment = PostComment::where('idPost', $idPost)->count();
        return response()->json(['view' => (string)View::make('includes.post-comment')->with(compact('comments', 'count_comment'))]);
    }
    public function editComment(Request $request)
    {
        $request->session()->forget('edit');
        $editCmt = $request->input('editCmt');
        $idCmt = $request->input('idCmt');
        $idPost = $request->input('idPost');
        if ($editCmt == '') {
            return response()->json(['status' => "Required"]);
        } else {
            PostComment::where('_id', $idCmt)->update(['comment' => $editCmt]);
            $comments = PostComment::where('idPost', $idPost)->orderby('created_at', 'DESC')->get();
            $count_comment = PostComment::where('idPost', $idPost)->count();
            return response()->json(['view' => (string)View::make('includes.post-comment')->with(compact('comments', 'count_comment'))]);
        }
    }
    public function deleteComment(Request $request)
    {
        $idCmt = $request->input('idCmt');
        $idPost = $request->input('idPost');
        if (PostComment::where('_id', $idCmt)->exists()) {
            $deleteComment = PostComment::where('_id', $idCmt)->first();
            $deleteComment->delete();
            $comments = PostComment::where('idPost', $idPost)->orderby('created_at', 'DESC')->get();
            $count_comment = PostComment::where('idPost', $idPost)->count();
            return response()->json(['numberComment' => $count_comment, 'view' => (string)View::make('includes.post-comment')->with(compact('comments', 'count_comment'))]);
        }
    }
    //Blog in Client End




    //Posts in ADMIN Start
    public function posts()
    {
        Session::put('page', 'posts');
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
                'image_path' => 'required|mimes:jpg,jpeg,png|max:5048'
            ];
            $customMessage = [
                'title.required' => 'Enter Title',
                'description.required' => 'Enter Description',
                'image_path.required' => 'Select Image'
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
    public function deletePost(Request $request)
    {
        $idPost = $request->input('idPost');
        if (Blog::where('_id', $idPost)->exists()) {
            $post = Blog::where('_id', $idPost)->first();
            $post->delete();
            $posts = Blog::all();
            return response()->json(['status' => "Post Deleted Successfully", 'view' => (string)View::make('includes.admin.posts-items')->with(compact('posts'))]);
        }
    }
}
