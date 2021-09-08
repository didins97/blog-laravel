<?php

namespace App\Http\Controllers;

use App\Category;
use App\Posts;
use App\Tags;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Posts $posts)
    {
        $tags = Tags::all();
        $category_widget = Category::all();
        $data = $posts->orderby('created_at', 'desc')->take(8)->get();
        return view('user.blog', compact('data','category_widget','tags'));
    }

    public function isi_post($slug)
    {
        $tags = Tags::all();
        $category_widget = Category::all();
        $data = Posts::where('slug', $slug)->first();
        return view('user.isi_post', compact('data','category_widget','tags'));
    }

    public function list_post()
    {
        $tags = Tags::all();
        $category_widget = Category::all();
        $data = Posts::latest()->paginate(8);
        return view('user.list_post', compact('data','category_widget','tags'));
    }

    public function list_category(Category $category)
    {
        $tags = Tags::all();
        $category_widget = Category::all();
        $data = $category->posts()->paginate();
        return view('user.list_post', compact('data','category_widget','tags'));  
    }

    public function search(Request $request)
    {
        $tags = Tags::all();
        $category_widget = Category::all();
        $data = Posts::where('judul', 'like', '%' . $request->search . '%')->paginate();
        return view('user.list_post', compact('data','category_widget','tags'));  
    }
}
