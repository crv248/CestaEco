<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    public function index(User $user) {
        return view('profiles.index', compact('user'));

    }
    public function edit(User $user)
    {

        $this->authorize('update', $user->profile);
       // dd($user->profile->location);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'name'=> '',
            'location'=> '',
            'description'=> '',
            'url'=> 'url',
            'logo' => '',
        ]);


        if (request('logo')) {
            $imagePath = request('logo')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['logo' => $imagePath];
        }
        auth()->user()->name = $data['name'];
        auth()->user()->save();

        unset($data['name']);

        // Con el array merge overrideamos el parámetro image
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
