<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\UserInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserInterface $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    /**
     * Method index
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $users = $this->user->search($request);
        return view('dashboard.pages.users.index', compact('users'));
    }
    /**
     * Method agen
     *
     * @param Request $request [explicite description]
     *
     * @return View
     */
    public function agen(Request $request): View
    {
        $users = $this->user->searchAgen($request);
        return view('dashboard.pages.users.agen', compact('users'));
    }
    /**
     * Method store
     *
     * @param UserRequest $request [explicite description]
     *
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['role'] = 'admin';

        if ($data['password'] == null) {
            $password = bcrypt('password');
        } else {
            $password = bcrypt($data['password']);
        }
        $data['password'] = $password;

        $data['email_verified_at'] = now();
        $user = $this->user->store($data);
        $user->assignRole($data['role']);
        return back()->with('success', 'Berhasil');
    }
    public function storeAgen(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['role'] = 'agen';
        if ($data['password'] == null) {
            $password = bcrypt('password');
        } else {
            $password = bcrypt($data['password']);
        }
        $data['password'] = $password;

        $data['email_verified_at'] = now();
        $user = $this->user->store($data);
        $user->assignRole($data['role']);
        return back()->with('success', 'Berhasil');
    }
    /**
     * Method update
     *
     * @param UserRequest $request [explicite description]
     * @param User $user [explicite description]
     *
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        $this->user->update($user->id, $data);
        $user->syncRoles($data['role']);

        return back()->with('success', 'Berhasil');
    }
    /**
     * Method destroy
     *
     * @param User $user [explicite description]
     *
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->user->delete($user->id);
        return back()->with('success', 'Berhasil');
    }
}
