<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Dashboard\ProviderInterface;
use App\Http\Requests\ProviderRequest;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    private ProviderInterface $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $providers = $this->provider->customPaginate($request);
        return view('dashboard.pages.provider.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProviderRequest $request)
    {
        $this->provider->store($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        $this->provider->update($provider->id, $request->validated());
        return redirect()->back()->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        $this->provider->delete($provider->id);
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
