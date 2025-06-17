@extends('layouts.baseDashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                    <div class="col-8 align-self-center">
                        <h3>Theater</h3>
                    </div>
                    
                    @if(isset($theater))
                        <div class="col-4 text-right">
                            <button class="btn text-bold btn-sm btn-warning" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </div>
                    @endif
                </div>
            </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{route($url, $theater->id ?? '' )}}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($theater))
                        <!-- mencoba menggunakan custom method bawaan laravel untuk update data -->
                            {{-- @method('put') --}}
                        @endif

                        <div>
                            <input type="hidden" name="theater_id" value="{{$theater->id}}">
                        </div>

                        <div class="form-group">
                            <label for="movie">Movie</label>
                            <select name="movie_id" id="" class="form-control">
                                <option value="">Pilih Movie</option>
                                @foreach($movies AS $movie)
                                    @if($movie->id == old('movie_id'))
                                        <option value="{{$movie->id}}" selected>{{$movie->title}}</option>
                                    @else
                                        <option value="{{$movie->id}}">{{$movie->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('movie_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="theater">Studio</label>
                            <input type="text" class="form-control @error('studio') {{'is-invalid'}} @enderror" name="studio" value="{{ old('studio') ?? $theater->studio ?? '' }}">
                            <!-- kode dibawah ini untuk menampilkan pesan error dari validator -->
                            @error('studio')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="theater">Price</label>
                            <input type="number" class="form-control @error('price') {{'is-invalid'}} @enderror" name="price" value="{{ old('price') ?? $theater->price ?? '' }}">
                            <!-- kode dibawah ini untuk menampilkan pesan error dari validator -->
                            @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror                            
                        </div>

                        <div class="form-group form-row mt-4">
                            <div class="col-2">
                                <label for="seats">Seats</label>
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control @error('rows') {{'is-invalid'}} @enderror" name="rows" value="{{ old('rows') ?? $theater->rows ?? '' }}" placeholder="rows">
                                @error('rows')
                                    <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control @error('columns') {{'is-invalid'}} @enderror" name="columns" value="{{ old('columns') ?? $theater->rows ?? '' }}" placeholder="Columns">
                                @error('columns')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <label for="schedules">Schedules</label>
                                </div>
                                <schedule-component :old-schedules="{{ json_encode(old('schedules') ?? [] ) }}"></schedule-component>
                            </div>
                            @error('schedules')
                                <span class="text-danger ml-2">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <div class="form-group mb-0">
                                <label for="status" class="">Status</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="coming soon" id="coming soon" @if((old('status') ?? $theater->status ?? '') == 'coming soon') checked @endif>
                                <label for="coming soon" class="form-check-label">Coming soon</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="in theater" id="in theater" @if((old('status') ?? $theater->status ?? '') == 'in active') checked @endif>
                                <label for="in theater" class="form-check-label">In theater</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="finish" id="finish" @if((old('status') ?? $theater->status ?? '') == 'finish') checked @endif>
                                <label for="finish" class="form-check-label">Finish</label>
                            </div>
                            <div>
                                @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
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

    @if(isset($theater))
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Delete</h5>

                        <button class="close" type="button" data-dismiss="modal">x</button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus data theater {{$theater->title}}?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.theaters.delete', $theater->id) }}" method="post">
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