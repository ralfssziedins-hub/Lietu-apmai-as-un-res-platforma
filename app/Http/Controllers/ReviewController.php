<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(ExchangeRequest $requestModel)
    {
        if ($requestModel->status !== 'approved') {
            abort(403);
        }

        return view('reviews.create', compact('requestModel'));
    }

    public function store(Request $request, ExchangeRequest $requestModel)
    {
        if ($requestModel->status !== 'approved') {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string|max:1000',
        ]);

        $receiverId = $requestModel->item->user_id;

        if ($receiverId == Auth::id()) {
            abort(403);
        }

        $exists = Review::where('request_id', $requestModel->id)
            ->where('author_id', Auth::id())
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Atsauksme jau ir atstāta.');
        }

        Review::create([
            'request_id' => $requestModel->id,
            'author_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'rating' => $validated['rating'],
            'text' => $validated['text'],
        ]);

        return redirect()->route('requests.incoming')
            ->with('success', 'Atsauksme pievienota.');
    }
}