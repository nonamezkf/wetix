<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
    public function create(Request $request)
    {
        $active = 'Movies';

        return view('dashboard/movie/form', [
            'active' => $active,
            'button' => 'Create',
            'url'   => 'dashboard.movies.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        // melakukan validasi input form movie
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:App\Models\Movie,title',
            'thumbnail' => 'required|image',
            'description' => 'required'
        ]);

        // kirim data error jika terdapat kesalahan pada form input
        if($validator->fails()){

            return redirect()
                   ->route('dashboard.movies.create')
                   ->withErrors($validator)
                   ->withInput();
        }else{

            // menerima file image dari form input 
            $image = $request->file('thumbnail');
            // merubah penamaann file image yang sudah di upload dengan mempertahankan original extention (.png / .jpeg)
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // menyimpan pada local storage 
            Storage::disk('local')->putFileAs('public/movies', $image, $filename);
            
            // menangkap data title dari form input create movie
            $movie->title = $request->input('title');
            // menangkap data description dari form input create movie
            $movie->description = $request->input('description');
            // menangkap data nama file thumbnail dari hasil olah data yang di definisikan di variable $filename
            $movie->thumbnail = $filename;
            // mengirim data movie ke database
            $movie->save();

            return redirect()
                   ->route('dashboard.movies')
                   ->with('message', __('messages.store', ['title' => $request->input('title')]));

        }
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
        $active = 'Movies';

        return view('dashboard/movie/form', [
            'movie' => $movie,
            'button' => 'Update',
            'url'   => 'dashboard.movies.update',
            'active' => $active
        ]);
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
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:App\Models\Movie,title,' .$movie->id,
            'thumbnail' => 'image',
            'description' => 'required'
        ]);

        // kirim data error jika terdapat kesalahan pada form input
        if($validator->fails()){

            return redirect()
                   ->route('dashboard.movies.update', $movie->id)
                   ->withErrors($validator)
                   ->withInput();
        }else{
            // melakukan validasi pengecekan pada request jika terdapat file image pada akan ditambahkan ke variabel $movie untuk di save(). jika tidak ada makan akan dilewati
            if($request->hasFile('thumbnail')){
                // menerima file image dari form input 
                $image = $request->file('thumbnail');
                // merubah penamaann file image yang sudah di upload dengan mempertahankan original extention (.png / .jpeg)
                $filename = time() . '.' . $image->getClientOriginalExtension();
                // menyimpan pada local storage 
                Storage::disk('local')->putFileAs('public/movies', $image, $filename);
                // menangkap data nama file thumbnail dari hasil olah data yang di definisikan di variable $filename
                $movie->thumbnail = $filename;
            }

            // menangkap data title lama 
            $title = $movie->title;

            // menangkap data title baru dari form input create movie
            $movie->title = $request->input('title');
            // menangkap data description baru dari form input create movie
            $movie->description = $request->input('description');
            // mengirim data movie ke database
            $movie->save();

            return redirect()
                   ->route('dashboard.movies')
                   ->with('message', __('messages.update', ['title' => $title]));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $title = $movie->title;

        $movie->delete();
        return redirect()
               ->route('dashboard.movies')
               ->with('message', __('messages.delete', ['title' => $title]));
    }
}
