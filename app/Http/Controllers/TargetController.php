<?php

namespace App\Http\Controllers;

use App\Http\Requests\Target\TargetRequest;
use App\Models\Target;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targets = Target::orderBy('id', 'desc')->paginate(request('per_page', 20));

        return view('targets.index', compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $target = new Target();

        return view('targets.create', compact('target'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TargetRequest $request)
    {
        $target = Target::create($request->validated() + ['created_by' => request()->user()->id]);

        return redirect()->route('targets.index')->with('success', 'Target  created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Target $target)
    {
        return view('targets.create', compact('target'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Target $target)
    {
        return view('targets.create', compact('target'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TargetRequest $request, Target $target)
    {
        $target->update($request->validated());

        return redirect()->route('targets.index')->with('success', 'Target updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Target $target)
    {
        //
    }
}
