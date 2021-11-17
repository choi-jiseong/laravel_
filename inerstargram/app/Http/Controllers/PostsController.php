<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function create() {
        return Inertia::render('Instagram/CreatePostForm');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        // auth()->user()->posts()->create($data);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' =>$data['caption'],
            'image' => $imagePath
        ]);

        return Inertia::render('Dashboard', ['user' => auth()->user(), 'posts'=>Auth::user()->posts]);
    }
}
