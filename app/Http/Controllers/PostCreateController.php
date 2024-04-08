<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class PostCreateController extends Controller
{
    public function create($username)
    {
        if (count(User::select('username')->where('username', $username)->get()) !== 0)
        {
            if (Auth::check())
            {
                if(Auth::user()->username === $username)
                {
                    return view('post.create_post', ['username' => $username]);
                }
            }
        }

        return redirect()->route('welcome');
    }

    public function store($username, Request $request)
    {

        if (count(User::select('username')->where('username', $username)->get()) !== 0)
        {
            if (Auth::check())
            {
                if(Auth::user()->username === $username)
                {
                    $this->validateForm($request);
                    $this->createPost($request);
                    return redirect()->route('user.profile', ['username' => $username]);
                }
            }
        }

        return redirect()->route('welcome');
    }

    public function validateForm($request)
    {
        $request->validate([
            'title' => ['required', 'max:20'],
            'text' => ['required', 'max:256'],
        ]);
    }

    public function createPost($request)
    {
        Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'user_upload' => Auth::user()->username,
        ]);
    }
}
