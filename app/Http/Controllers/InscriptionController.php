<?php

namespace App\Http\Controllers;

use App\Models\Discution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class InscriptionController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return view('discution');
        } else {
            return view('inscription');
        }
    }

    public function auth(Request $request){
        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])
        ) {
            User::find(Auth::user()->id)->update([
                'status'=>1
            ]);
            
            return response()->json(['success' => 1]);
        } else {
            return response()->json(['error' => 0]);
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
        return response()->json(['success' => 'creation de votre compte avec success']);
    }

    public function searchDiscution($data)
    {
        $searchUsers = User::where('nom', 'like', "%$data%")
            ->orwhere('prenom', 'like', "%$data%")
            ->get();

        $data = [];
        foreach ($searchUsers as $searchUser) {
            //      $table->integer('user1');
            // $table->integer('user2');
            $isOnDiscution = DB::select('select * from discutions where (user1=? AND user2=?) OR (user2=? AND user1=?)', [Auth::user()->id, $searchUser->id, Auth::user()->id, $searchUser->id]);
            array_push($data, ['user' => $searchUser, 'discution' => $isOnDiscution]);
        }

        return $data;
    }
}