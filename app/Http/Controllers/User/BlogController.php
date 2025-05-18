<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs()
    {
        return view('User.Blogs.cards');
    }
    public function blogs_flowers()
    {
        return view('User.Blogs.details.blog1');
    }
    public function blogs_makeup()
    {
        return view('User.Blogs.details.blog2');
    }
    public function blogs_bags()
    {
        return view('User.Blogs.details.blog3');
    }
    public function blogs_gifts()
    {
        return view('User.Blogs.details.blog4');
    }
    public function blogs_care()
    {
        return view('User.Blogs.details.blog5');
    }
}
