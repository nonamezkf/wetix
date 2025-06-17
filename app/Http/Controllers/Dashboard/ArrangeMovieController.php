<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\ArrangeMovie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class ArrangeMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theater)
    {
        // variable $q menerima data dari form search pada halaman list theaters
        // dengan parameter name q pada tag input yang ada pada form search
        $q = $request->input('q');

        $active = 'Theaters';
        
        

        return view('dashboard/arrange_movie/list', [
            'theater' =>$theater,
            'request' =>$request,
            'active' => $active],);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Theater $theater, Movie $movie)
    {
        $active = 'Theater';

        $movie = Movie::get();

        return view('dashboard/arrange_movie/form', [
            'active' => $active,
            'movies' => $movie,
            'theater' => $theater,
            'button' => 'Create',
            'url'   => 'dashboard.arrange.movie.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ArrangeMovie $arrangeMovie)
    {
        $validator = Validator::make($request->all(),[
            'studio'     => 'required',
            'movie_id'   => 'required',
            'price'      => 'required',
            'rows'       => 'required',
            'columns'    => 'required',
            'schedules'  => 'required',
            'status'     => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                    ->route('dashboard.arrange.movie.create', $request->input('theater_id'))
                    ->withErrors($validator)
                    ->withInput();
        }else{
            $seats = [
                'rows' => $request->input('rows'),
                'columns' => $request->input('columns')
            ];

            $arrangeMovie->theater_id = $request->input('theater_id');
            $arrangeMovie->movie_id = $request->input('movie_id');
            $arrangeMovie->studio = $request->input('studio');
            $arrangeMovie->price = $request->input('price');
            $arrangeMovie->status = $request->input('status');
            $arrangeMovie->schedules = json_encode($request->input('schedules'));
            $arrangeMovie->seats = json_encode($seats);
            $arrangeMovie->save();

            return redirect()
                    ->route('dashboard.arrange.movie', $request->input('theater_id'))
                    ->with('message', __('messages.store', ['title' => $request->input('studio')]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function show(ArrangeMovie $arrangeMovie)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function edit(ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArrangeMovie $arrangeMovie)
    {
        //
    }
}
