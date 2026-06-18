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

        if ($item->status !== 'available') {
            abort(403, 'Šī lieta pašlaik nav pieejama.');
        }

        $myItems = Item::where('user_id', Auth::id())
            ->where('status', 'available')
            ->get();

        return view('requests.create', compact('item', 'myItems'));
    }

    public function store(Request $request, Item $item)
    {
        if ($item->user_id === Auth::id()) {
            abort(403, 'Tu nevari nosūtīt pieprasījumu savai lietai.');
        }

        if ($item->status !== 'available') {
            abort(403, 'Šī lieta pašlaik nav pieejama.');
        }

        $rules = [
            'message' => 'nullable|string',
        ];

        if ($item->type === 'rent') {
            $rules['start_date'] = 'required|date|after_or_equal:today';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
        }

        if ($item->type === 'exchange') {
            $rules['offered_item_id'] = [
                'required',
                'exists:items,id',

                function ($attribute, $value, $fail) {
                    $offeredItem = Item::find($value);

                    if (! $offeredItem || $offeredItem->user_id !== Auth::id()) {
                        $fail('Tu vari piedāvāt tikai savu lietu.');
                    }

                    if ($offeredItem && $offeredItem->status !== 'available') {
                        $fail('Piedāvātajai lietai jābūt pieejamai.');
                    }
                },
            ];
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

    public function myRequests()
    {
        $requests = ExchangeRequest::with(['item', 'item.user', 'offeredItem'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('requests.my', compact('requests'));
    }

    public function approve(ExchangeRequest $requestModel)
    {
        if ($requestModel->item->user_id !== Auth::id()) {
            abort(403);
        }

        if ($requestModel->status !== 'pending') {
            abort(403, 'Šis pieprasījums jau ir apstrādāts.');
        }

        $requestModel->update([
            'status' => 'approved',
        ]);

        if ($requestModel->item->type === 'rent') {
            $requestModel->item->update([
                'status' => 'reserved',
            ]);
        }

        if ($requestModel->item->type === 'exchange') {
            $requestModel->item->update([
                'status' => 'exchanged',
            ]);

            if ($requestModel->offeredItem) {
                $requestModel->offeredItem->update([
                    'status' => 'exchanged',
                ]);
            }
        }

        return redirect()->route('requests.incoming')
            ->with('success', 'Pieprasījums apstiprināts.');
    }

    public function reject(ExchangeRequest $requestModel)
    {
        if ($requestModel->item->user_id !== Auth::id()) {
            abort(403);
        }

        if ($requestModel->status !== 'pending') {
            abort(403, 'Šis pieprasījums jau ir apstrādāts.');
        }

        $requestModel->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('requests.incoming')
            ->with('success', 'Pieprasījums noraidīts.');
    }
}