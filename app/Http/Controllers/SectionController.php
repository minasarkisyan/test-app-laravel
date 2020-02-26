<?php

namespace App\Http\Controllers;

use App\Section;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $sections = Section::latest()->paginate(10);



        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $users = User::all();

        return view('sections.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'description' => 'required'
        ]);

        $imageName = time().'.'.$request->logo->extension();

        $request->logo->move(public_path('images'), $imageName);

        $section = Section::create($request->all());

        $users = User::all();
        $users = $users->only($request->input('user_id'));
        $section->users()->saveMany($users);

        return redirect()->route('sections.index')->with('success','Section created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return Factory|View
     */
    public function edit(Section $section)
    {

        return view('sections.edit', ['section' => $section]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'description' => 'required'
        ]);
        $imageName = time().'.'.$request->logo->extension();

        $request->logo->move(public_path('images'), $imageName);


        $section->update($request->all());

        $users = User::all();
        $users = $users->only($request->input('user_id'));
        $section->users()->saveMany($users);

        return redirect()->route('users.index')->with('success','Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return \Illuminate\Http\Response
     */

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Отдел удален');
    }
}
