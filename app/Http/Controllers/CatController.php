<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CatController extends Controller
{
    /**
     * Display a listing of the unadopted cats.
     */
    public function index(Request $request)
    {
        $pagination = 16;

        if ($request->user()?->is_admin) {
            $cats = Cat::orderBy('created_at', 'desc')->paginate($pagination);
        } else {
            $cats = Cat::where('is_adopted', false)->latest()->paginate($pagination);
        }

        return view('cats.index', compact('cats'));
    }

    /**
     * Display the form for creating a new resource.
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
        $path = $request->file('photo')->store('cats', 'public');

        return response()->json(compact('path'));
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
        return view('cats.show', compact('cat'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cat $cat)
    {
        $data = $request
            ->merge(['vaccinated' => (bool) $request?->vaccinated])
            ->validate(
                [
                    'name' => 'required|string|max:255',
                    'breed' => 'required|string|max:255',
                    'age' => 'required|numeric|min:0',
                    'vaccinated' => 'required',
                    'photo' => 'required',
                ],
                [
                    'photo.required' => 'The cat photo is required',
                ]
            );

        $cat->update($data);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cat $cat)
    {
        $cat->delete();

        $photo = public_path(Storage::url($cat->photo));

        if (File::exists($photo)) {
            unlink($photo);
        }

        return redirect()->route('home');
    }
}
