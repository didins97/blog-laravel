@extends('template_backend.master')

@section('content')
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <!-- Button trigger modal -->
        <a type="button" href="{{ route('user.create') }}" class="btn btn-primary">
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $no => $user)
                    <tr>
                        <td>{{ $users->firstitem()+$no }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-primary">{{ $user->role_user->name }}</span>
                        </td>
                        <td>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <a href="{{ route('user.edit', $user->id) }}"
                                    class="btn btn-warning btn-circle btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-danger btn-circle confirm-swal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
