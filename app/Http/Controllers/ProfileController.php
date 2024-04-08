<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($username)
    {
        $statusAccountIsMain = false;

        if (count(User::select('username')->where('username', $username)->get()) !== 0)
        {
            if (Auth::check())
            {
                if(Auth::user()->username === $username)
                {
                    $statusAccountIsMain = true;
                }
            }
        }
        else
        {
            return view('profile.error_profile');
        }

        $posts = $this->selectPosts($username);

        return view('profile.profile', ['statusAccountIsMain' => $statusAccountIsMain, 'username' => $username, 'posts' => $posts]);
    }

    public function selectPosts($username)
    {
        $posts = Post::select('id','title', 'text')->where('user_upload', $username)->orderBy('id', 'DESC')->get();
        return $posts;
    }
}
