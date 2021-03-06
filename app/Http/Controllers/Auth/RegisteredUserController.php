<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Image;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));

        // create profile for new registered user
        $profile = new Profile();
        $profile->about = "This is my profile";
        $profile->last_active = now();
        $profile->user_id = $user->id;
        $profile->save();

        // create default profile image
        $image = new Image();
        $image->storage_path = "public/images/default_profile_image.png";
        $image->imageable_id = $profile->id;
        $image->imageable_type = "App\Models\Profile";
        $image->save();

        $role_id = Role::firstWhere('name', 'User')->id;
        $profile->roles()->attach($role_id);

        return redirect(RouteServiceProvider::HOME);
    }
}
