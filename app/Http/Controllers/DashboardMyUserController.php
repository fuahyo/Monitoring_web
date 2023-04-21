<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Departement;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class DashboardMyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return User::all();
        return view('dashboard.myuser.index', [
            'users' => User::all(),
            // 'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.myuser.create', [
            'users' => User::all(),
            
            'title' => 'Register',
            'active' => 'register',
            'departements' => Departement::all(),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {   
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            //bisa nulis pakai tanda pipe "|" atau pakai array kaya dibawah ini
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'departement_id' => 'required',
            'role_id' => 'required',
            'photo_profil' => 'image',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        if($request->file('photo_profil')){
            $validatedData['photo_profil'] = $request->file('photo_profil')->store('user-images');
        }

        // //encripsi password, bisa pakay bcrypt atau hash
        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        //pesan allert ketika sudah daftar
        $request->session()->flash('success', 'Registrasi Berhasil!');

        //lanjut ke halaman login setelah register
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $myuser)
    {   
        // return 'hi';
        return view('dashboard.myuser.edit', [
            'users' => User::all(),
            'user' => $myuser,
            'title' => 'Register',
            'active' => 'register',
            'departements' => Departement::all(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $myuser)
    {
        $rules=[
            'name' => '',
            // 'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'departement_id' => '',
            'role_id' => '',
            'photo_profil' => '',
            // 'email' => 'required|email:dns|unique:users',
            'password' => '',
        ];
        $validatedData = $request->validate($rules);
        if($request->file('photo_profil')){
            if($request->oldPhoto_profil){
                Storage::delete($request->oldPhoto_profil);
            }
            $validatedData['photo_profil'] = $request->file('photo_profil')->store('user-images');
        }
        
        // $validatedData['password'] = Hash::make($validatedData['password']);
        // $some_same_string = decrypt($password);
        // return ($some_same_string);
        User::where('id', $myuser->id)->update($validatedData);

        //pesan allert ketika sudah daftar
        $request->session()->flash('success', 'Update data User Berhasil!');

        //lanjut ke halaman login setelah register
        return redirect('/dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->photo_profil){
            Storage::delete($user->photo_profil);
        }
        User::destroy($user->id);
        return redirect('/dashboard')->with('success', 'User berhasil dihapus!');
    }
}
