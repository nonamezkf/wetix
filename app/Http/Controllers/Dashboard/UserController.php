<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // definisikan variable request di function index untuk menerima permintaandari website seperti pada form untuk fitur search
     //  definisikan model User ke function index untuk dapat mengakses databases user
    public function index(Request $request, User $users)
    {
        // variable $q menerima data dari form search pada halaman list user
        // dengan parameter name q pada tag input yang ada pada form search
        $q = $request->input('q');

        $active = 'Users';
        
        // kode dibawah ini akan menampilkan data list user dengan jumah default 10 sesuan nilai pada pagination
        // dan ketika variable $q memiliki nilai yang diterima dari request maka data yang ditampilkan akan sesuan dengan yang di input 
        $users = $users->when($q, function($query) use ($q){
            return $query->where('name', 'like', '%'.$q.'%')
                         ->orwhere('email', 'like', '%'.$q.'%' );
                         // data yang di tampilkan akan dicari pada database dibagian nama atau email jika memiliki kesamaan 
            })->paginate(10);
        
        $request = $request->all();  //menyimpan input dari 

        return view('dashboard/user/list', [
            'users' =>$users,
            'request' =>$request,
            'active' => $active],);
        // dd($users);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $active = 'Users';

        $user = USER::find($id);
        
        return view('dashboard/user/formEditUser', [
            'user' =>$user,
            'active' => $active]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);

        //mencari user berdasarkan id yang terima dari route update
        $user = USER::find($id);
        // mendefinisikan variable model user dengan atribut/kolom name untuk menerima input dari form edit user berdasarkan tag input dengan atribute name="name"
        $user->name = $request->input('name');
        // mendefinisikan variable model user dengan atribut/kolom email untuk menerima input dari form edit user berdasarkan tag input dengan atribute name="name"
        $user->email = $request->input('email');
        // data dari form input akan di diperbarui di database berdasarkan id tertentu yang telah diterima
        $user->save();

        // kode routing dibawah ini mengarahkah user ke halaman list user dengan menggunakan penamaan pada route 
        // return redirect()->route('users');

        // sedangkang kode dibawah ini tidak menggunakan penamaan route alias langsung ke ke pengalamatan halaman 
        return redirect('/dashboard/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
