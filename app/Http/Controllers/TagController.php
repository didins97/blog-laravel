<?php

namespace App\Http\Controllers;

use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tags::paginate(10);
        return view('admin.tag.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        Tags::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->back()->with('message', 'Data berhasi ditambahkan');
    }

    public function _validation(Request $request)
    {
        $request->validate(
            ['name' => 'required|min:3'],
            [
                'name.required' => 'Nama tag wajib diisi',
                'name.min' => 'Nama tag minimal 2 digit'
            ]
        );
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
    public function edit(Tags $tag)
    {
        return view('admin.tag.edit', ['tags' => $tag]);
        // echo $tag;
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
        $data_tag = ['name' => $request->name, 'slug' => Str::slug($request->name)];
        Tags::where('id', $id)->update($data_tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tags::destroy($id);
        return redirect()->back()->with('message', 'Data berhasi dihapus');
    }
}
