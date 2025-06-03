@extends('layouts.baseDashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                    <div class="col-8 align-self-center">
                        <h3>Movie</h3>
                    </div>
                </div>
            </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{route('dashboard.movies.store')}}" enctype="multipart/form-data">
                        @csrf
                        <!-- mencoba menggunakan custom method bawaan laravel untuk update data -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title">
                            <!-- kode dibawah ini untuk menampilkan pesan error dari validator -->
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label><br>
                            <input type="file" name="thumbnail" id="thumbnail" class="">
                            <br>
                            @error('thumbnail')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="" rows="5"></textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="button " class="btn btn-sm btn-secondary" onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection