<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Job;
use App\Models\JobVisit;
use App\Models\Thana;
use App\Repositories\Interfaces\JobRepositoryInterface;
use App\Services\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    protected $jobRepository;

    /**
     * JobController constructor.
     *
     * @param JobRepositoryInterface $jobRepository
     */
    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = $this->jobRepository->all();
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', true)->get();
        $divisions = Division::get();
        return view('admin.jobs.create', compact('categories', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        // dd($data);

        $this->jobRepository->create($data);
        return redirect()->route('jobs.index')->with('success', 'job created successfully.');
    }

    function updateStatus(Request $request, $id) {
        $job = Job::findOrFail($id);
        $status = $request->input('status');
        $job->status = $status;
        $job->save();
        return response()->json(['success' => true, 'message' => 'Job\'s status updated successfully.']);
    }

    public function getDistricts($divisionId)
    {
        $districts = District::where('division_id', $divisionId)->get();
        return response()->json([
            'districts' => $districts
        ]);
    }
    public function getThanas($districtId)
    {
        $thanas = Thana::where('district_id', $districtId)->get();
    
        return response()->json([
            'thanas' => $thanas
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, StatisticsService $statisticsService)
    {
        $job = $this->jobRepository->find($id);
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'job not found.');
        }
        $statistics = $statisticsService->getSingleStatistics(JobVisit::class, 'job_id', $id);
        return view('admin.jobs.show', array_merge(['job' => $job], $statistics));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = $this->jobRepository->find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'job not found.');
        }
        $categories = Category::where('status', true)->get();
        $divisions = Division::get();
        return view('admin.jobs.edit', compact('job', 'categories', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJobRequest $request, $id)
    {
        $data = $request->validated();
        $updated = $this->jobRepository->update($id, $data);
        if (!$updated) {
            return redirect()->route('jobs.index')->with('error', 'Failed to update job.');
        }
        return redirect()->route('jobs.index')->with('success', 'job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->jobRepository->delete($id); 

        if (!$deleted) {
            return redirect()->route('jobs.index')->with('error', 'Failed to delete job.');
        }

        return redirect()->route('jobs.index')->with('success', 'job deleted successfully.');
    }
}
