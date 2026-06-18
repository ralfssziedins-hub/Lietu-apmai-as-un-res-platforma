<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    public function index(Request $request)
{
        $query = Item::with(['category', 'user']);
        $query->where('status', 'available');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('title','like','%'.$request->search.'%')
                ->orWhere('description','like','%'.$request->search.'%');

            });
        }

        if ($request->filled('category')) {

            $query->where('category_id', $request->category);
        }

        $items = $query->latest()
        ->paginate(6)
        ->withQueryString();
        $categories = Category::all();

        return view('items.index', compact(
            'items',
            'categories'
        ));
}

    public function create()
    {
        if (Auth::user()->isBlocked()) {
            abort(403, 'Bloķēts lietotājs nevar pievienot lietas.');
        }

        $categories = Category::all();

        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if ($request->user()->isBlocked()) {
            abort(403, 'Bloķēts lietotājs nevar pievienot lietas.');
        }

        $validated = $request->validate([
            'title' => 'required|max:150',
            'description' => 'required',
            'type' => 'required|in:rent,exchange',
            'status' => 'required|in:available,reserved,rented,exchanged',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $validated['user_id'] = Auth::id();

        Item::create($validated);

        return redirect()->route('items.index')
            ->with('success', 'Lieta veiksmīgi pievienota.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        if (! Auth::user()->isAdmin() && Auth::id() !== $item->user_id) {
            abort(403);
        }

        $categories = Category::all();

        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        if (! $request->user()->isAdmin() && Auth::id() !== $item->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:150',
            'description' => 'required',
            'type' => 'required|in:rent,exchange',
            'status' => 'required|in:available,reserved,rented,exchanged',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if ($request->has('delete_image') && $item->image) {
            Storage::disk('public')->delete($item->image);
            $validated['image'] = null;
        }
        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }

            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return redirect()->route('items.show', $item)
            ->with('success', 'Lieta veiksmīgi atjaunota.');
    }

    public function destroy(Item $item)
    {
        if (! Auth::user()->isAdmin() && Auth::id() !== $item->user_id) {
            abort(403);
        }

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Lieta veiksmīgi dzēsta.');
    }
}