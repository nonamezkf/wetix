@extends('layouts.baseDashboard')

@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.theaters.create') }}" class="btn btn-primary">+ Theater</a>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">
            <strong>{{session()->get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Theater</h3>
                </div>

                <div class="col-4">
                    <form action="{{ route('dashboard.theaters') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <button type="submit" class="btn btn-secondary btn-sm ">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($theaters->total())
                <table class="table table-striped table-hover table-borderless">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Theater</th>
                            <th>Address</th>
                            <th>Edited</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($theaters as $theater)
                            <tr>
                                <th scope="row">{{ ($theaters->currentPage() -1) * $theaters->perPage() + $loop->iteration}}</th>
                                <td>{{$theater->theater}}</td>
                                <td>{{$theater->address}}</td>
                                <td>{{$theater->updated_at}}</td>
                                <td>                                    
                                    <!-- dibawah ini untuk routing menggunakan route() -->
                                    <a href="{{ route('dashboard.theaters.edit', $theater->id) }}" class="btn btn-success btn-sm" title="edit" ><i class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$theaters->appends($request)->links()}}
                <!-- kode di atas berfungsi untuk menampilkan pagination  -->
                <!-- dan jika variable request memiliki nilai maka akan di tambahkan setelah link pagination -->
            @else
                <h4 class="text-center p-3">Data theater tidak tersedia</h4>
            @endif
        </div>
    </div>

    
    
@endsection