@extends('template_backend.master')

@section('content')

@if (session('message'))
<div class="alert alert-primary">
    {{session('message')}}.
</div>
@endif

<form action="{{ route('user.store')}}" method="POST">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="name">Nama User</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama User"
                autocomplete="off">
        </div>
        <div class="form-group col-md-4">
            <label for="role">Role User</label>
            <select id="role" name="role_user_id" class="form-control">
                <option value="" holder>Pilih Role</option>
                @foreach ($role_user as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">Email User</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email User"
                autocomplete="off">
        </div>
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password User"
                autocomplete="off">
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Simpan User</button>
    </div>
</form>
@endsection
