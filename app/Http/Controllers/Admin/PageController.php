<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Repositories\Interfaces\PageRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    protected $repo;

    /**
     * PageController constructor.
     *
     * @param PageRepositoryInterface $repo
     */
    public function __construct(PageRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the pages.
     *
     * @return View
     */
    public function index(): View
    {
        $pages = $this->repo->all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created page in storage.
     *
     * @param PageRequest $request
     * @return RedirectResponse
     */
    public function store(PageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $this->repo->create($data);
        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    function updateStatus(Request $request, $id) {
        $page = Page::findOrFail($id);

        // Update the status
        $page->status = $request->input('status');
        $page->save();

        return response()->json(['success' => true]);
    }
    /**
     * Display the specified page.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function show(int $id)
    {
        $page = $this->repo->find($id);
        if (!$page) {
            return redirect()->route('pages.index')->with('error', 'Page not found.');
        }
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function edit(int $id)
    {
        $page = $this->repo->find($id);

        if (!$page) {
            return redirect()->route('pages.index')->with('error', 'Page not found.');
        }

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified page in storage.
     *
     * @param PageRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PageRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();
        $updated = $this->repo->update($id, $data);
        if (!$updated) {
            return redirect()->route('pages.index')->with('error', 'Failed to update page.');
        }
        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified page from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $deleted = $this->repo->delete($id);

        if (!$deleted) {
            return redirect()->route('pages.index')->with('error', 'Failed to delete page.');
        }

        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
