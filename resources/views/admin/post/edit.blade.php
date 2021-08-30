@extends('layouts.master')

@section('content')

@if (session('message'))
<div class="alert alert-primary">
    {{session('message')}}.
</div>
@endif

<form action="{{ route('post.update', $posts->id)}}" method="POST" enctype="multipart/form-data">
    @csrf @method('patch')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{$posts->judul}}" placeholder="Masukan Judul Post" autocomplete="off">
        </div>
        <div class="form-group col-md-6">
            <label for="category">Kategori</label>
            <select id="category" name="category_id" class="form-control">
                <option value="" holder>Pilih Kategori</option>
                @foreach ($category as $cate)
                <option value="{{ $cate->id }}" @if ($posts->category_id == $cate->id)
                    selected
                @endif>{{ $cate->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="category">Tags</label>
        <select class="form-control js-example-basic-multiple" name="tags[]" multiple="multiple">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}"
                @foreach ($posts->tags as $t)
                    @if ($tag->id == $t->id)
                        selected
                    @endif
                @endforeach
            >{{ $tag->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" class="form-control" name="gambar" id="gambar">
    </div>
    <div class="form-group mb-4">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ $posts->content }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Simpan Post</button>
    </div>
</form>
@endsection

@push('after-script')
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });

</script>
@endpush
