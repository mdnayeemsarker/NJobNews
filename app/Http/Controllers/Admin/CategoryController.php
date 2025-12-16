<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the categories.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categoryRepository->all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->categoryRepository->create($data);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function ajax_category_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        try {
            $category = Category::create($validated);

            return response()->json([
                'success' => true,
                'category' => $category,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding category: ' . $e->getMessage(),
            ]);
        }
    }
    function updateStatus(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Update the status
        $status = $request->input('status');
        if ($request->has('type')) {
            if ($request->type === 'status') {
                $queryType = $request->input('type');
            } else {
                $queryType = 'is_' . $request->input('type');
            }
            $category->{$queryType} = $status;
        } else {
            $category->status = $status;
        }
        $category->save();

        return response()->json(['success' => true, 'message' => 'Category\'s ' . $request->input('type', 'status') . ' status updated successfully.']);
    }
    /**
     * Display the specified category.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $updated = $this->categoryRepository->update($id, $data);
        if (!$updated) {
            return redirect()->route('categories.index')->with('error', 'Failed to update category.');
        }
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $deleted = $this->categoryRepository->delete($id);

        if (!$deleted) {
            return redirect()->route('categories.index')->with('error', 'Failed to delete category.');
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
