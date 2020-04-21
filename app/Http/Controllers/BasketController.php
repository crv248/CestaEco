<?php

namespace App\Http\Controllers;

use App\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class BasketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtenemos lo usuarios a los que seguimos
        $users = auth()->user()->following()->pluck('profiles.user_id');

        // Obtenemos los posts de estos y con latest ordenamos de manera descendiente
        // después con paginate creamos el paginador
        // con el with evitamos que la query sea con el limit 1
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('baskets.create'); // you can use / also
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();
        $imageArray = ['image' => $imagePath];


        auth()->user()->baskets()->create(array_merge(
            $data,
            $imageArray
        ));

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(Basket $basket)
    {
        return view('baskets.show', compact('post'));
    }
}
