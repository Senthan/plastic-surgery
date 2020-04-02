<?php

namespace App\Http\Controllers\Admin;

use App\EventType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventTypeStoreRequest;
use App\Http\Requests\EventTypeUpdateRequest;

class EventTypeController extends Controller
{
    protected $classes = [
        'red' => 'Red',
        'orange' => 'Orange',
        'yellow' => 'Yellow',
        'olive' => 'Olive',
        'green' => 'Green',
        'teal' => 'Teal',
        'blue' => 'Blue',
        'violet' => 'Violet',
        'purple' => 'Purple',
        'pink' => 'Pink',
        'brown' => 'Brown',
        'grey' => 'Grey',
        'black' => 'Black',
    ];

    public function create()
    {
        $classes = $this->classes;
        return view('admin.event.type.create', compact('classes'));
    }

    public function store(EventTypeStoreRequest $request)
    {
        EventType::create($request->only(['name', 'class']));
        return redirect()->route('event.index');
    }

    public function edit(EventType $eventType)
    {
        $classes = $this->classes;
        return view('admin.event.type.edit', compact('classes', 'eventType'));
    }

    public function update(EventTypeUpdateRequest $request, EventType $eventType)
    {
        $inputs = $request->only(['name', 'class']);
        if($eventType->readonly == 'Yes') {
            array_forget($inputs, 'name');
        }
        $eventType->update($inputs);
        return redirect()->route('event.index');
    }
    public function delete(EventType $eventType)
    {
        return view('admin.event.type.delete', compact('eventType'));
    }

    public function destroy(Request $request, EventType $eventType)
    {
        $eventType->delete();
        return redirect()->route('event.index');
    }
}
