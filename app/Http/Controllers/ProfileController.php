<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $items = $user->items()->latest()->get();

        $receivedReviews = $user->receivedReviews()
            ->with(['author', 'request.item'])
            ->latest()
            ->get();

        return view('profile.show', compact(
            'user',
            'items',
            'receivedReviews'
        ));
    }
}