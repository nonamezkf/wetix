<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Unique;
use Symfony\Component\Console\Input\Input;
use Validator;


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

        //validasi input pada formedit user
        //$request->all() berfungsi untuk mendapatkan semua data input pada form
        $validator = VALIDATOR::make($request->all(), [
            // validasi input email 
            // required, berarti kolom input email harus wajib diisi
            // unique, data pada kolom email harus bersifat unik tidak boleh sama dengan data user lain
            // App\Models\user,email, .$id  (data dari form kolom email akan dicek pada database model user di kolom email juga apakah data sama atau berbeda dengan kolom email lain pada model user)
            // $id, berfungsi untuk pengecualian jika data yg di dikirim pada kolom email sama dengan data sebelumnya maka validasi pada kolom email akan dilewati  
            'email' =>'required|unique:App\Models\user,email,'. $id,
            'name' =>'required'
        ]);

        // kondisi ketika validator menemukan kesealahan input pada form
        if($validator->fails()){
            //user akan di redirect ke halaman edit
            return redirect('dashboard/user/edit/'.$id)
                    // membawa value error dari validator
                    ->withErrors($validator)
                    // membawa value yang di input user
                    ->withInput();

        // kondisi ketika validator berhasil di lewati atau user menginput data sesusai validasi 
        }else{
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dapatkat id user dari form delete yg dikirim dari routing
        $user = USER::find($id);
        // delete data user
        $user->delete();
        // jika delet berhasil maka admin akan di arahkan ke halaman list user
        return redirect('dashboard/users');
    }
}
