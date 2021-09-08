@extends('template_frontend.content')
@section('isi')

@foreach ($data as $post)
<div class="post post-row">
    <a class="post-img" href="{{ route('blog.isi_post',$post->slug) }}"><img src="{{ asset($post->gambar) }}" alt=""></a>
    <div class="post-body">
        <div class="post-category">
            <a href="#">{{$post->category->name}}</a>
        </div>
        <h3 class="post-title"><a href="{{ route('blog.isi_post',$post->slug) }}">{{$post->judul}}</a></h3>
        <ul class="post-meta">
            <li><a href="author.html">{{$post->users->name}}</a></li>
            <li>{{$post->created_at->format('d M Y')}}</li>
        </ul>
        <p>{!! (str_word_count($post->content) > 60 ? substr($post->content, 0, 200). "..." : $post->content) !!}</p>
    </div>
</div>
@endforeach
<center>{{ $data->links() }}</center>
@endsection