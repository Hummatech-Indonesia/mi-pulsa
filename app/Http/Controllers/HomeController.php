<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Dashboard\AboutInterface;
use App\Contracts\Interfaces\Dashboard\ContactInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{

    private AboutInterface $about;
    private ContactInterface $contact;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AboutInterface $about, ContactInterface $contact)
    {
        $this->about = $about;
        $this->contact = $contact;
        // $this->middleware('auth');
    }

    /**
     * Method index
     *
     * @return View
     */
    public function index(): View
    {
        $contact = $this->contact->get();
        $about = $this->about->get();
        return view('pages.index', compact('contact', 'about'));
    }
    /**
     * Method product
     *
     * @return View
     */
    public function product(): View
    {
        $contact = $this->contact->get();
        $about = $this->about->get();
        return view('pages.product', compact('contact', 'about'));
    }
    /**
     * Method about
     *
     * @return View
     */
    public function about(): View
    {
        $about = $this->about->get();
        $contact = $this->contact->get();
        return view('pages.about', compact('about', 'contact'));
    }
    public function contact(): View
    {
        $contact = $this->contact->get();
        return view('pages.contact', compact('contact'));
    }
}
