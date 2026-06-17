<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        $users = User::latest()->get();
        $items = Item::with(['user', 'category'])->latest()->get();
        $reviews = Review::with(['author', 'receiver', 'request.item'])->latest()->get();

        return view('admin.index', compact('users', 'items', 'reviews'));
    }

    public function blockUser(User $user)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        $user->update([
            'is_blocked' => true,
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'Lietotājs bloķēts.');
    }

    public function unblockUser(User $user)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        $user->update([
            'is_blocked' => false,
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'Lietotājs atbloķēts.');
    }
}