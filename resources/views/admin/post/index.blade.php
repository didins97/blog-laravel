@extends('template_backend.master')

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
                        <th>Creator</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $no => $post)
                    <tr>
                        <td>{{ $posts->firstitem()+$no }}</td>
                        <td>{{ $post->judul }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            @foreach ($post->tags as $tag)
                            <h6><span class="badge badge-info">{{ $tag->name }}</span></h6>
                            @endforeach
                        </td>
                        <td>{{ $post->users->name }}</td>
                        <td>
                            <img src="{{ asset( $post->gambar ) }}" class="img-fluid" width="100" alt="">
                        </td>
                        <td>
                            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i></a>
                                <a type="button" class="btn btn-primary btn-sm btn-detail" data-toggle="modal"
                                    data-target=".bd-example-modal-lg" data-id="{{ $post->id }}"><i class="fas fa-eye"></i></a>
                                <button type="submit" class="btn btn-danger btn-sm" name="button"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="mdetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="myLargeModalLabel">Detail Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script>
    // Show modal edit
    $('.btn-detail').on('click', function () {
        let id = $(this).data('id');
        console.log(id);
        $.ajax({
            type: "GET",
            url: `post/detail/${id}`,
            success: function (data) {
                $('#mdetail').find('.modal-body').html(data);
                $('#mdetail').modal('show');
            }
        });
    })

</script>
@endpush
