<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExchangeRequestController extends Controller
{
    public function create(Item $item)
    {
        if ($item->user_id === Auth::id()) {
            abort(403, 'Tu nevari nosūtīt pieprasījumu savai lietai.');
        }

        $myItems = Item::where('user_id', Auth::id())
            ->where('status', 'available')
            ->get();

        return view('requests.create', compact('item', 'myItems'));
    }

    public function store(Request $request, Item $item)
    {
        if ($item->user_id === Auth::id()) {
            abort(403);
        }

        $rules = [
            'message' => 'nullable|string',
        ];

        if ($item->type === 'rent') {
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
        }

        if ($item->type === 'exchange') {
            $rules['offered_item_id'] = 'required|exists:items,id';
        }

        $validated = $request->validate($rules);

        ExchangeRequest::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'offered_item_id' => $validated['offered_item_id'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('items.show', $item)
            ->with('success', 'Pieprasījums nosūtīts.');
    }

    public function incoming()
    {
        $requests = ExchangeRequest::with(['item', 'user', 'offeredItem'])
            ->whereHas('item', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('requests.incoming', compact('requests'));
    }

    public function approve(ExchangeRequest $requestModel)
    {
        if ($requestModel->item->user_id !== Auth::id()) {
            abort(403);
        }

        $requestModel->update([
            'status' => 'approved',
        ]);

        $requestModel->item->update([
            'status' => 'reserved',
        ]);

        return redirect()->route('requests.incoming')
            ->with('success', 'Pieprasījums apstiprināts.');
    }

    public function reject(ExchangeRequest $requestModel)
    {
        if ($requestModel->item->user_id !== Auth::id()) {
            abort(403);
        }

        $requestModel->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('requests.incoming')
            ->with('success', 'Pieprasījums noraidīts.');
    }
    public function myRequests()
    {
        $requests = ExchangeRequest::with(['item', 'item.user', 'offeredItem'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('requests.my', compact('requests'));
    }
}