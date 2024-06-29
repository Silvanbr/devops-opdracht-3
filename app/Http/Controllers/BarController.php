<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Http\Requests\StoreBarRequest;
use App\Http\Requests\UpdateBarRequest;
use Illuminate\Http\Request;

class BarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bars = Bar::with('user')->paginate(4);
        return view("bars.index", [
            "bars" => $bars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("bars.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    Bar::create($this->validateBar($request));

    return redirect(route("bars.index"));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateBar(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'waldo' => 'required',
            'grault' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bar = Bar::findOrFail($id);
        return view("bars.show", [
            "bar" => $bar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bar = Bar::findOrFail($id);
        return view("bars.edit", [
            "bar" => $bar
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bar $bar)
    {
        $bar->update($this->validateBar($request));

        return redirect(route('bars.show', $bar));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bar $bar)
    {
        $bar->delete();
        return redirect(route("bars.index"));
    }
}
