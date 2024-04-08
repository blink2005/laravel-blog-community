<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class PostDestroyController extends Controller
{
    public function destroy($username,$id)
    {
        if (count(User::select('username')->where('username', $username)->get()) !== 0)
        {
            if (Auth::check())
            {
                if(Auth::user()->username === $username)
                {
                    $this->deletePost($id);
                    return redirect()->route('user.profile', ['username' => $username]);
                }
            }
        }

        return redirect()->route('welcome');
    }

    public function deletePost($id)
    {
        Post::find($id)->delete();
    }
}
