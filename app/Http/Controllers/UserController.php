<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Title;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personals = User::all()->where('email', '!=', Auth::user()->email);
        $roles = Role::all();
        $titles = Title::all();

        return view('admin.personal', ['personals' => $personals, 'roles' => $roles, 'titles' => $titles]);
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
        if (User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make('total'),
            'phone' => $request->phone,
            'title_id' => $request->title,
            'role_id' => $request->role,
        ])) {
            return redirect()->back()->with('success', 'Agent enregistré avec succès');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enrégistrement');
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
    public function edit(Request $request, User $user)
    {
        $user = User::find($request->id);
        $roles = Role::all();
        $titles = Title::all();
        return view('admin.personal_editor', ['user' => $user, 'roles' => $roles, 'titles' => $titles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        if($request->modify_pwd){
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $user->password = Hash::make($request->password);
        }
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = $request->role;
        $user->title_id = $request->title;
        if($user->save()){
            return redirect()->route('personal')->with('success', 'informations modifiées');
        }
        return redirect()->route('personal')->with('fail', 'Une erreur est survenue lors de l\'enrégistrement');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $personal = User::find($request->id);
        if ($personal->delete()) {
            return redirect()->route('personal')->with('success', 'agent supprimé...');
        }
        return redirect()->route('personal')->with('fail', 'Une erreur est survenue lors de la modification');
    }
}
