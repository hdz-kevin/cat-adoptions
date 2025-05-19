<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the unadopted cats.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('cats.create');
    }

    /**
     * Uploads a cat photo and returns its public URL.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function photoUpload(Request $request)
    {
        $request->validate(['photo' => 'required|image']);
        $path = $request->file('photo')->store('/cats/photos', 'public');

        return response()->json([
            'photo_url' => \Illuminate\Support\Facades\Storage::url($path),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request
            ->merge(['vaccinated' => (bool) $request?->vaccinated])
            ->validate(
                [
                    'name' => 'required|string|max:255',
                    'breed' => 'required|string|max:255',
                    'age' => 'required|numeric|min:0',
                    'vaccinated' => 'required',
                    'photo' => 'required'
                ],
                [
                    'photo.required' => 'The cat photo is required',
                ],
            );

        Cat::create($data);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param Cat $cat
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Cat $cat)
    {
        return view('cats.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request 
     * @param Cat $cat 
     * @return mixed
     */
    public function update(Request $request, Cat $cat)
    {
        return response()->json($cat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cat $cat)
    {
        //
    }
}
