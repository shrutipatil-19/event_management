<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Event\Event as EventEvent;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('event-management/pages/event/listEvent', compact('events'));
    }

    public function create()
    {
        $users = User::get();
        $categories = Category::get();
        return view('event-management/pages/event/AddEvent', compact('users', 'categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'publish_at'  => 'required|date',
            'status'      => 'required|in:draft,published',
            'img'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $publishUtc = \Carbon\Carbon::parse($request->publish_at_local, $request->timezone)->setTimezone('UTC');

        $event = Event::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'publish_at' => $publishUtc,
            'status' => 'published'
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                $imagePaths[] = $path;
            }
        }
        return redirect()->route('listEvent')->with('success', 'Category created successfully.');
        // return response()->json($event->load('photos', 'category'), 201);
    }
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event-management/pages/event/editEvent', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'category_name' => 'required|max:255|unique:categories,category_name,' . $event->id,
            'description' => 'nullable|string',
        ]);

        $event->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect()->route('listEvent')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('listEvent')->with('success', 'Event deleted successfully.');
    }
}
