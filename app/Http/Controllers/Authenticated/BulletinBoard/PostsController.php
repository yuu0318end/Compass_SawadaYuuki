<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments')->get();
        $mainCategories = MainCategory::with('subCategories')->get();
        $subCategories = SubCategory::get();
        $like = new Like;
        $post_comment = new Post;
        $query = Post::with('user', 'postComments');

        if(!empty($request->keyword)){
            $matchedSubCategory = SubCategory::where('sub_category', $request->keyword)->first();
            if ($matchedSubCategory) {
                $query->whereHas('subCategories', function ($q) use ($matchedSubCategory){
                    $q->where('sub_categories.id', $matchedSubCategory->id);
                });
            } else {
                $query->where(function ($q) use ($request){
                    $q->where('post_title', 'like', '%' . $request->keyword . '%')
                    ->orWhere('post', 'like', '%' . $request->keyword . '%');
                });
            }
            $posts = $query->get();
        }else if($request->category_word){
            $posts = Post::with('user', 'postComments')
            ->whereHas('subCategories', function ($q) use ($request){
                $q->where('sub_categories.id', $request->category_word);
            })->get();
        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }

        return view('authenticated.bulletinboard.posts', compact('posts', 'mainCategories', 'subCategories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        $sub_categories = SubCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories', 'sub_categories'));
    }

    public function postCreate(PostFormRequest $request){
        $request->validate([
            'post_category_id' => 'required|exists:sub_categories,id',
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:2000',
        ]);
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);
        $post->subCategories()->attach($request->post_category_id);

        return redirect()->route('post.show');
    }

    public function postEdit(Request $request){
        $request->validate([
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:2000',
        ]);
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    // メインカテゴリー
    public function mainCategoryCreate(Request $request){
        $request->validate([
            'main_category_name' => 'required|max:100|string|unique:main_categories,main_category'
        ]);
        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }
    // サブカテゴリー
    public function subCategoryCreate(Request $request){
        $request->validate([
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
        ]);
        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category_name
        ]);
        return redirect()->route('post.input');
    }

    public function commentCreate(Request $request){
        $request->validate([
            'comment' => 'required|string|max:250'
            ]);
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
