<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Category;
use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Posts::paginate(10);
    return view('admin.post.index', compact('posts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $category = Category::all();
    $tags = Tags::all();
    return view('admin.post.add', compact('category', 'tags'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->_validation($request);

    $gambar = $request->gambar;
    $new_gambar = date('siHdmY') . $gambar->getClientOriginalName();

    $post = Posts::create([
      'judul' => $request->judul,
      'category_id' => $request->category_id,
      'content' => $request->content,
      'gambar' => 'uploads/posts/' . $new_gambar,
      'slug' => Str::slug($request->judul),
      'user_id' => Auth::id()
    ]);

    $post->tags()->attach($request->tags);

    $gambar->move('uploads/posts/', $new_gambar);

    return redirect()->back()->with('message', 'Postingan Anda Berhasil Disimpan');
  }

  public function _validation(Request $request)
    {
      $request->validate([
        'judul' => 'required',
        'category_id' => 'required',
        'content' => 'required',
        'gambar' => 'required'
      ]);
    }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $posts = Posts::find($id);
    $category = Category::all();
    $tags = Tags::all();
    return view('admin.post.edit', compact('posts', 'category', 'tags'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->_validation($request);

    $post = Posts::find($id);

    if ($request->has('gambar')) {
      $gambar = $request->gambar;
      $new_gambar = date('siHdmY') . $gambar->getClientOriginalName();
      $gambar->move('uploads/posts/', $new_gambar);
      $post_data = [
        'judul' => $request->judul,
        'category_id' => $request->category_id,
        'content' => $request->content,
        'gambar' => 'uploads/posts/' . $new_gambar,
        'slug' => Str::slug($request->judul),
        'user_id' => Auth::id()
      ];
    } else {
      $post_data = [
        'judul' => $request->judul,
        'category_id' => $request->category_id,
        'content' => $request->content,
        'slug' => Str::slug($request->judul),
        'user_id' => Auth::id()
      ];
    }

    $post->tags()->sync($request->tags);
    $post->update($post_data);

    return redirect()->route('post.index')->with('message', 'Postingan Anda Berhasil Diupdate');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Posts::destroy($id);
    return redirect()->back()->with('message', 'Postingan Anda Berhasil Dihapus (Silahkan cek trashed post)');
  }

  public function show_delete()
  {
    $post = Posts::onlyTrashed()->paginate(10);
    return view('admin.post.delete', compact('post'));
  }

  public function restore($id)
  {
    $post = Posts::withTrashed()->where('id', $id)->first();
    $post->restore();

    return redirect()->back()->with('message', 'Postingan Anda Berhasil Direstore (Silahkan cek list post)');
  }

  public function kill($id)
  {
    $post = Posts::withTrashed()->where('id', $id)->first();
    $post->forceDelete();

    return redirect()->back()->with('message', 'Postingan Anda Berhasil Dihapus Secara Permanent');
  }

  public function detail($id)
  {
    $posts = Posts::find($id);
    return view('admin.post.detail', compact('posts'));
  }

}