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
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'publish_at'  => 'required|date',
            'status'      => 'required|in:draft,published,archived',
            'img'         => 'nullable|array',
            'img.*'       => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::create([
            'user_id'     => Auth::id(),
            'category_id' => $validated['category_id'],
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'publish_at'  => $validated['publish_at'],
            'status'      => $validated['status'],
        ]);

        $imagePaths = [];

        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $file) {
                $path = $file->store('events', 'public'); 
                $imagePaths[] = $path;
            }

            $event->update(['img' => json_encode($imagePaths)]);
        }

        return redirect()->route('listEvent')
            ->with('success', 'Event created successfully!');
    }
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event-management/pages/event/editEvent', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'publish_at'  => 'required|date',
            'status'      => 'required|in:draft,published,archived',
            'img'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $publishUtc = \Carbon\Carbon::parse($request->publish_at_local, $request->timezone)->setTimezone('UTC');

        $event->update([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'publish_at' => $publishUtc,
            'status' => 'published'
        ]);

        return redirect()->route('listEvent')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('listEvent')->with('success', 'Event deleted successfully.');
    }
}
