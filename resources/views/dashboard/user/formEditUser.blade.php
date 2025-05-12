@extends('layouts.baseDashboard')

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Users</h3>
                </div>

                <div class="col-4 text-right">
                    <button class="btn text-bold btn-sm btn-warning" data-toggle="modal" data-target="#deleteModal">Delete</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ url('dashboard/user/update/'.$user->id) }}">
                        @csrf
                        <!-- mencoba menggunakan custom method bawaan laravel untuk update data -->
                        @method("put")
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            <!-- kode dibawah ini untuk menampilkan pesan error dari validator -->
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{{old('email') ?? $user->email}}">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="button " class="btn btn-sm btn-secondary" onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>delete</h5>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data user {{$user->name}}?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ url('dashboard/user/delete/'.$user->id) }}" method="post">
                        @csrf
                        <!-- mencoba menggunakan custom method bawaan laravel untuk delete data -->
                        @method("delete")
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection