<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class PostUpdateController extends Controller
{
    public function edit($username,$id)
    {
        if (count(User::select('username')->where('username', $username)->get()) !== 0)
        {
            if (Auth::check())
            {
                if(Auth::user()->username === $username)
                {
                    #return redirect()->route('user.profile', ['username' => $username]);
                    return view('post.edit_post', ['username' => $username, 'id' => $id]);
                }
            }
        }

        return redirect()->route('welcome');
    }

    public function update($username,$id, Request $request)
    {
        if (count(User::select('username')->where('username', $username)->get()) !== 0)
        {
            if (Auth::check())
            {
                if(Auth::user()->username === $username)
                {
                    $this->validateForm($request);
                    $this->updatePost($id, $request);
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

    public function updatePost($id, $request)
    {
        Post::where('id', $id)->update(['title' => $request->title, 'text' => $request->text]);
    }
}
