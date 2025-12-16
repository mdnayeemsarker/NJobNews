<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Repositories\Interfaces\AdsRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdController extends Controller
{
    protected $repo;

    /**
     * AdsController constructor.
     *
     * @param AdsRepositoryInterface $repo
     */
    public function __construct(AdsRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the ads.
     *
     * @return View
     */
    public function index(): View
    {
        $ads = $this->repo->all();
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new ad.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created ad in storage.
     *
     * @param AdRequest $request
     * @return RedirectResponse
     */
    public function store(AdRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->repo->create($data);
        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    function updateStatus(Request $request, $id) {
        $ad = Ad::findOrFail($id);

        // Update the status
        $ad->status = $request->input('status');
        $ad->save();

        return response()->json(['success' => true]);
    }
    /**
     * Display the specified ad.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function show(int $id)
    {
        $ad = $this->repo->find($id);
        if (!$ad) {
            return redirect()->route('ads.index')->with('error', 'Ad not found.');
        }
        return view('admin.ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified ad.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function edit(int $id)
    {
        $ad = $this->repo->find($id);

        if (!$ad) {
            return redirect()->route('ads.index')->with('error', 'Ad not found.');
        }

        return view('admin.ads.edit', compact('ad'));
    }

    /**
     * Update the specified ad in storage.
     *
     * @param AdRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(AdRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();
        $updated = $this->repo->update($id, $data);
        if (!$updated) {
            return redirect()->route('ads.index')->with('error', 'Failed to update ad.');
        }
        return redirect()->route('ads.index')->with('success', 'Ad updated successfully.');
    }

    /**
     * Remove the specified ad from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $deleted = $this->repo->delete($id);

        if (!$deleted) {
            return redirect()->route('ads.index')->with('error', 'Failed to delete ad.');
        }

        return redirect()->route('ads.index')->with('success', 'Ad deleted successfully.');
    }
}
