@extends('layouts.baseDashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                    <div class="col-8 align-self-center">
                        <h3>Movie</h3>
                    </div>
                    
                    @if(isset($movie))
                        <div class="col-4 text-right">
                            <button class="btn text-bold btn-sm btn-warning" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </div>
                    @endif
                </div>
            </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{route($url, $movie->id ?? '' )}}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($movie))
                            @method('put')
                        @endif
                        <!-- mencoba menggunakan custom method bawaan laravel untuk update data -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') {{'is-invalid'}} @enderror" name="title" value="{{ old('title') ?? $movie->title ?? '' }}">
                            <!-- kode dibawah ini untuk menampilkan pesan error dari validator -->
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label><br>
                            <input type="file" name="thumbnail" id="thumbnail" class="" value="old('thumbnail')">
                            <br>
                            @error('thumbnail')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') {{'is-invalid'}} @enderror" name="description" id="" rows="5">{{ old('description') ?? $movie->description ?? '' }}</textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="button " class="btn btn-sm btn-secondary" onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">{{$button}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($movie))
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Delete</h5>

                        <button class="close" type="button" data-dismiss="modal">x</button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus data movie {{$movie->title}}?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.movies.delete', $movie->id) }}" method="post">
                            @csrf
                            <!-- mencoba menggunakan custom method bawaan laravel untuk delete data -->
                            @method("delete")
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>  Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection