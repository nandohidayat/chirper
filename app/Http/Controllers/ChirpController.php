<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChirpRequest;
use App\Models\Chirp;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Inertia\Inertia;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ChirpRequest $request
     * @return RedirectResponse
     */
    public function store(ChirpRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $request->user()->chirps()->create($validate);

        return redirect(route('chirps.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Chirp $chirp
     * @return Response
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Chirp $chirp
     * @return Response
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChirpRequest $request
     * @param Chirp $chirp
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(ChirpRequest $request, Chirp $chirp): RedirectResponse
    {
        $this->authorize('update', $chirp);

        $validate = $request->validated();

        $chirp->update($validate);

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Chirp $chirp
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
