<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class InscriptionController extends Controller
{
    
    public function index()
    {
        if (Auth::user()) {
            return view('discution');
        }else{
            return view('inscription');
        }
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->file('p_profile')) {
            $request->validate([
                'p_profile' => ['mimes:jpeg,png,jpg,svg'],
            ]);
            $p_profile = $request->file('p_profile');
            $file_name = md5(rand(1000, 10000));
            $photo_profile = $file_name . '.' . $p_profile->extension();
            $p_profile->move(public_path('profile_users'), $photo_profile);
        } else {
            $photo_profile = 'user-avatar-profile-person-people-svgrepo-com.svg';
        }

        $request->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'same:confirmation'],
            'confirmation' => ['required', 'min:8', 'same:password'],
        ]);

        // store user

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'profile' => $photo_profile,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['success'=>'creation de votre compte avec success']);
    }

 
    public function searchDiscution($data){
        return json_decode(User::where('nom','like',"%$data%")->orwhere('prenom','like',"%$data%")->get());
    }

}