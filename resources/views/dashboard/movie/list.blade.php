@extends('layouts.baseDashboard')

@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary">+ Movie</a>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movie</h3>
                </div>

                <div class="col-4">
                    <form action="{{ route('dashboard.movies') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <button type="submit" class="btn btn-secondary btn-sm ">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($movies->total())
                <table class="table table-striped table-hover table-borderless">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Thumbnail</th>
                            <th>Description</th>
                            <th>Edited</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <th scope="row">{{ ($movies->currentPage() -1) * $movies->perPage() + $loop->iteration}}</th>
                                <td>{{$movie->title}}</td>
                                <td>{{$movie->thumbnail}}</td>
                                <td>{{$movie->description}}</td>
                                <td>{{$movie->updated_at}}</td>
                                <td>
                                    <!-- dibawah ini untuk contoh untuk routing menggunakan url() -->
                                    <!-- <a href=" url('dashboard/user/edit/'.$user->id) }}" class="btn btn-success btn-sm" title="edit" ><i class="fas fa-pen"></i></a> -->

                                    
                                    <!-- dibawah ini untuk routing menggunakan route() -->
                                    <a href="{{ route('dashboard.movies.edit', ['id' => $movie->id]) }}" class="btn btn-success btn-sm" title="edit" ><i class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$movies->appends($request)->links()}}
                <!-- kode di atas berfungsi untuk menampilkan pagination  -->
                <!-- dan jika variable request memiliki nilai maka akan di tambahkan setelah link pagination -->
            @else
                <h4 class="text-center p-3">Data movie tidak tersedia</h4>
            @endif
        </div>
    </div>

    
    
@endsection