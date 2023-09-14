<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NewPostPublished;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * The index function returns the view for the posts index page.
     * 
     * @return The view 'posts.index' is being returned.
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * The create function returns a view for creating a new post.
     * 
     * @return a view called 'posts.create'.
     */
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        /* The `->validate()` method is used to validate the incoming request data. In this
        case, it is validating the 'title' and 'body' fields of the request. */
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        /* The `->post->create()` method is creating a new post record in the database. It takes
        an array of data as its argument, which includes the values for the post's title, body,
        user_id, is_published, is_draft, and published_at fields. */
        $this->post->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
            'is_published' => $request->publish_now ? true : false,
            'is_draft' => $request->draft ? true : false,
            'published_at' => $request->publish_later ? $request->published_at : null,
        ]);

        $post = $this->post->with('user')->first();

        if ($request->publish_now) {
           Notification::send(admin(), new NewPostPublished($post));
        }

        return back();

    }
    //ENDS
}
