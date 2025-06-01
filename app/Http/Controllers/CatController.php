<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatRequest;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CatController extends Controller
{
    /**
     * Display cat list
     * Guest: Only unadopted cats
     * Auth User: Adopted cat by him and all unadopted cats
     * Admin: All cats
     */
    public function index(Request $request)
    {
        $pagination = 16;
        $query = Cat::query();

        if (! auth()->check()) {
            $query->where('is_adopted', false)->orderBy('created_at', 'desc');    
        } else if ($request->user()->is_admin) {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->where('adopter_id', $request->user()->id)
                    ->orWhere('is_adopted', 'false')
                    ->orderByDesc('is_adopted')
                    ->orderByDesc('created_at');
        }

        $cats = $query->paginate($pagination);

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
    public function store(StoreCatRequest $request)
    {
        $data = $request->validated();

        $cat = Cat::create($data);

        return redirect()
                ->route('cats.index')
                ->with('alert', [
                    'type' => 'success',
                    'message' =>  "Cat {$cat->name} added successfully",
                ]);
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
    public function update(StoreCatRequest $request, Cat $cat)
    {
        $data = $request->validated();

        $cat->update($data);

        return redirect()
                ->route('cats.index')
                ->with('alert', [
                    'type' => 'success',
                    'message' =>  "Cat {$cat->name} edited successfully",
                ]);
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

        return redirect()
                ->route('cats.index')
                ->with('alert', [
                    'type' => 'success',
                    'message' =>  "Cat {$cat->name} deleted successfully",
                ]);
    }
}
