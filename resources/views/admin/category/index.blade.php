@extends('layouts.master')

@section('content')
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i>
        </button>
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
                        <th>Nama Kategory</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $no => $cate)
                    <tr>
                        <td>{{$category->firstItem()+$no}}</td>
                        <td>{{$cate->name}}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-circle btn-edit" data-id="{{$cate->id}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle confirm-swal">
                                <i class="fas fa-trash" data-id="{{$cate->id}}"></i>
                                <form action="{{ route('category.destroy', $cate->id) }}" method="POST"
                                    id="delete{{$cate->id}}">
                                    @csrf @method('delete')
                                </form>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $category->links() }}
        </div>
    </div>
</div>
@endsection



@section('modal')

<!-- Modal tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Kategory</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Masukan Nama Kategory">
                            <span @error('name') class="text-danger" @enderror>
                                @error('name'){{$message}}@enderror
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="editcate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formdata">
                @csrf
                <div class="modal-body">
                    {{-- edit.blade.php --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary btn-update">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


{{-- sweatalert library --}}
@push('page-script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@push('after-script')

<script>
    // Error show modal tambah
    @if($errors->any())
    $('#exampleModal').modal('show');
    @endif

    // Show modal edit
    $('.btn-edit').on('click', function () {
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "GET",
            url: `category/${id}/edit`,
            success: function (data) {
                $('#editcate').find('.modal-body').html(data);
                $('#editcate').modal('show');
            }
        });
    })

    // Update data
    $('.btn-update').on('click', function () {
        let id = $('#formdata').find('#id').val()
        let newData = $("#formdata").serialize();
        console.log(newData);
        $.ajax({
            type: "PATCH",
            url: `category/${id}`,
            data: newData,
            success: function (response) {
                // console.log(response);
                window.location.assign('category')
            },
            error: function (err) {
                console.log(err);
                if (err.status == 422) {
                    if (typeof(err.responseJSON.errors.name !== 'undefined')) {
                        $('#editcate').find('.cate').append().html(`<span class="text-danger">${err.responseJSON.errors.name[0]}</span>`)
                    }
                }
            }
        });
    });

    // Delete sweatalert
    $(".confirm-swal").click(function (e) {
        const id = e.target.dataset.id;
        swal({
                title: "Yakin hapus data?",
                text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(`#delete${id}`).submit();
                }
            });
    });

</script>
@endpush
