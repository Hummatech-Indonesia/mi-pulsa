<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Dashboard\ContactUsInterface;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    private ContactUsInterface $contactUs;
    public function __construct(ContactUsInterface $contactUs)
    {
        $this->contactUs = $contactUs;
    }

    public function index()
    {
        $contactUses = $this->contactUs->get();
        return view('dashboard.pages.configurations.message', compact('contactUses'));
    }
    /**
     * store
     *
     * @return RedirectResponse
     */
    public function store(ContactUsRequest $request): RedirectResponse
    {
        $this->contactUs->store($request->validated());
        return redirect()->back()->with('success');
    }
}
