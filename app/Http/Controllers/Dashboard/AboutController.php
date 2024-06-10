<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\AboutInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Services\Dashboard\AboutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    private AboutInterface $about;
    private AboutService $service;
    public function __construct(AboutInterface $about, AboutService $service)
    {
        $this->about = $about;
        $this->service = $service;
    }
    /**
     * Method index
     *
     * @return View
     */
    public function index(): View
    {
        $about = $this->about->get();
        return view('dashboard.pages.configurations.about',compact('about'));
    }
    /**
     * Method store
     *
     * @param AboutRequest $request [explicite description]
     *
     * @return RedirectResponse
     */
    public function store(AboutRequest $request): RedirectResponse
    {
        $this->about->store($this->service->store($request));
        return back()->with('success', 'Berhasil menambah data');
    }
    /**
     * Method update
     *
     * @param AboutRequest $request [explicite description]
     * @param About $about [explicite description]
     *
     * @return RedirectResponse
     */
    public function update(AboutRequest $request, About $about): RedirectResponse
    {
        $this->about->update($about->id, $this->service->update($about, $request));
        return back()->with('success', 'Berhasil mengubah data');
    }
}
