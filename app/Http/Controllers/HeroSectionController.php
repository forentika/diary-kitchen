<?php

namespace App\Http\Controllers;

use App\Models\Hero_Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero_section = Hero_Section::all();
        return view('dashboard.herosection.index', compact('hero_section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.herosection.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'header' => 'required|string|max:255',
            'paragraph' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('herosection.create')
                ->withErrors($validator)
                ->withInput();
        }

        Hero_Section::create($request->all());

        return redirect()->route('herosection.index')
            ->with('success', 'Data hero section berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero_Section $hero_section)
    {
        return view('dashboard.herosection.show', compact('hero_section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero_Section $hero_section)
    {
        return view('dashboard.herosection.edit', compact('hero_section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero_Section $hero_section)
    {
        $validator = Validator::make($request->all(), [
            'header' => 'required|string|max:255,' . $hero_section->id, 
            'paragraph' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('herosection.edit', $hero_section->id)
                ->withErrors($validator)
                ->withInput();
        }

        $hero_section->update($request->all());

        return redirect()->route('herosection.index')
            ->with('success', 'Data hero section berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero_Section $hero_section)
    {
        $hero_section->delete();

        return redirect()->route('herosection.index')
            ->with('success', 'Data hero section berhasil dihapus.');
    }
}