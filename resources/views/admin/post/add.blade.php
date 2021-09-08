@extends('template_backend.master')

@section('content')

@if (session('message'))
<div class="alert alert-primary">
    {{session('message')}}.
</div>
@endif

<form action="{{ route('post.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Judul Post" value="{{ old('judul') }}" autocomplete="off">
        </div>
        <div class="form-group col-md-6">
            <label for="category">Kategori</label>
            <select id="category" name="category_id" class="form-control">
                <option value="" holder>Pilih Kategori</option>
                @foreach ($category as $cate)
                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="tags">Pilih Tags</label>
        <select class="form-control js-example-basic-multiple" name="tags[]" multiple="">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" class="form-control" name="gambar" id="gambar">
    </div>
    <div class="form-group mb-4">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="editor1" cols="30" rows="10"></textarea>
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

    CKEDITOR.replace( 'editor1' );

</script>
@endpush

@push('page-script')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
