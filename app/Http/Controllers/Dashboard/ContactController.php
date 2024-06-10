<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\ContactInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    private ContactInterface $contact;
    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }
    /**
     * Method index
     *
     * @return View
     */
    public function index(): View
    {
        $contact = $this->contact->get();
        return view('dashboard.pages.configurations.contact', compact('contact'));
    }
    /**
     * Method store
     *
     * @param ContactRequest $request [explicite description]
     *
     * @return RedirectResponse
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $this->contact->store($request->validated());
        return back()->with('success', 'Berhasil menambah data');
    }
    /**
     * Method update
     *
     * @param ContactRequest $request [explicite description]
     * @param Contact $contact [explicite description]
     *
     * @return RedirectResponse
     */
    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        $this->contact->update($contact->id, $request->validated());
        return back()->with('success', 'Berhasil mengubah data');
    }
}
