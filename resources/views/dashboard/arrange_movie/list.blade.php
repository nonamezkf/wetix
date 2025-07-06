@extends('layouts.baseDashboard')

@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.arrange.movie.create', $theater->id  ) }}" class="btn btn-primary">+ Theater</a>
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
                    <h3>Theater - <span>{{$theater->theater}}</span></h3>
                </div>

                <div class="col-4">
                    <form action="{{ route('dashboard.arrange.movie', $theater->id) }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <button type="submit" class="btn btn-secondary btn-sm ">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="card-body p-0">
                @if($theater > '1')
                    <table class="table table-striped table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Movie</th>
                                <th>Studio</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                           @foreach($arrangeMovies as $arrangeMovie)
                            <tr>
                                <td>{{ $arrangeMovie->movies->first()->title }}</td>
                                <td>{{$arrangeMovie->studio}}</td>
                                <td>{{$arrangeMovie->price}}</td>
                                <td>{{$arrangeMovie->status}}</td>
                                <td>
                                    <a href="{{ route('dashboard.arrange.movie.edit', [$theater->id, $arrangeMovie->id]) }}" class="btn btn-success btn-sm" title="edit" ><i class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 class="text-center p-3">{{ __('messages.no_data', ['module' => 'theater']) }}</h4>
                @endif
            </div>
        </div>
    </div>

    
    
@endsection