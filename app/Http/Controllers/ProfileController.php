<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\ProfileInterface;
use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    private ProfileInterface $profile;
    private ProfileService $service;
    public function __construct(ProfileInterface $profile, ProfileService $service)
    {
        $this->profile = $profile;
        $this->service = $service;
    }
    /**
     * Method index
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.profile.index');
    }
    /**
     * Method update
     *
     * @param ProfileRequest $request [explicite description]
     * @param User $user [explicite description]
     *
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request): RedirectResponse
    {
        $this->profile->update(auth()->user()->id, $this->service->update($request));
        return back()->with('success', 'Berhasil memperbarui data');
    }
    public function changePassword(changePasswordRequest $request): RedirectResponse
    {
        // dd($request->validated());
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $this->profile->update(auth()->user()->id, $data);
        return back()->with('success', 'Berhasil memperbarui password');
    }
    /**
     * Method forgotPassword
     *
     * @return View
     */
    public function forgotPassword(): View
    {
        return view('dashboard.pages.profile.forgot-password');
    }

}
