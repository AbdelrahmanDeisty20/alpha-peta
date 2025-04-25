<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = Blog::take(4)->get();
        return view('web.blog', compact('blogs'));
    }
    public function blogDetails($id)
    {
        $blog = Blog::findOrFail($id);
        return view('web.blogdetails', compact('blog'));
    }
}
