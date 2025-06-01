<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movie $movies)
    {
        // variable $q menerima data dari form search pada halaman list movies
        // dengan parameter name q pada tag input yang ada pada form search
        $q = $request->input('q');

        $active = 'Movies';
        
        // kode dibawah ini akan menampilkan data list movie dengan jumah default 10 sesuan nilai pada pagination
        // dan ketika variable $q memiliki nilai yang diterima dari request maka data yang ditampilkan akan sesuan dengan yang di input 
        $movies = $movies->when($q, function($query) use ($q){
            return $query->where('title', 'like', '%'.$q.'%');
                         // data yang di tampilkan akan dicari pada database dibagian title jika memiliki kesamaan 
            })->paginate(10);
        
        $request = $request->all();  //menyimpan nilai dari input pada form search

        return view('dashboard/movie/list', [
            'movies' =>$movies,
            'request' =>$request,
            'active' => $active],);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
