@extends('layouts.master')

@section('content')
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <!-- Button trigger modal -->
        <a type="button" href="{{ route('post.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    @if (session('message'))
    <div class="alert alert-primary">
        {{session('message')}}.
    </div>
    @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th>Nama Post</th>
                        <th>Kategori</th>
                        <th>Daftar Tags</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $no => $p)
                    <tr>
                        <td>{{ $post->firstitem()+$no }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->category->name }}</td>
                        <td>
                            @foreach ($p->tags as $tag)
                            <h6><span class="badge badge-info">{{ $tag->name }}</span></h6>
                            @endforeach
                        </td>
                        <td>
                            <img src="{{ asset( $p->gambar ) }}" class="img-fluid" width="100" alt="">
                        </td>
                        <td>
                            <form action="{{ route('post.kill', $p->id) }}" method="post">
                                @csrf @method('delete')
                                <a href="{{ route('post.restore', $p->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-undo-alt"></i></a>
                                {{-- <a href="#" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a> --}}
                                <button type="submit" class="btn btn-danger btn-sm" name="button"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $post->links() }}
        </div>
    </div>
</div>
@endsection
