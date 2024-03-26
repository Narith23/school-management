<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login()
    {
        return view("layout.template.user.login");
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'The Email or Phone field is required.',
        ]);
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->username,
                'password' => $request->password,
            ];
        } else {
            $credentials = [
                'phone' => $request->username,
                'password' => $request->password,
            ];
        }

        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard.index')->with('success', 'Login successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials.');
        }
    }

    public function register()
    {
        return view("layout.template.user.register");
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
        ],[
            "first_name.required" => "The First Name field is required.",
            "last_name.required" => "The Last Name field is required.",
            "username.required" => "The Email or Phone field is required.",
            "password.required" => "The Password field is required.",
            "password.confirmed" => "The Password confirmation does not match.",
        ]);
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->username)->first();
            if ($user) {
                return redirect()->back()->with('error', 'User already exists.');
            } else {
                $request['email'] = $request->username;
            }
        } else {
            $user = User::where('phone', $request->username)->first();
            if ($user) {
                return redirect()->back()->with('error', 'User already exists.');
            } else {
                $request['phone'] = $request->username;
            }
        }
        $add_user = User::create($request->all());
        if ($add_user) {
            auth()->login($add_user);
            return redirect()->route('dashboard.index')->with('success', 'Register successfully.');
        } else {
            return redirect()->back()->with('error', 'User created failed.');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('dashboard.index')->with('success', 'Logout successfully.');
    }

    public function profile()
    {
        dd(auth()->user());
    }
}
