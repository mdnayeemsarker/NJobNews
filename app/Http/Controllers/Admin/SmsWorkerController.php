<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSmsWorkerRequest;
use App\Models\SmsWorker;
use App\Repositories\Interfaces\SmsWorkerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SmsWorkerController extends Controller
{
    protected $repo;

    /**
     * SmsWorkerController constructor.
     *
     * @param SmsWorkerRepositoryInterface $repo
     */
    public function __construct(SmsWorkerRepositoryInterface $repo)
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
        $smsWorkers = $this->repo->all();
        return view('admin.sms_workers.index', compact('smsWorkers'));
    }

    /**
     * Show the form for creating a new sms.
     *
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.sms_workers.create');
    }

    /**
     * Store a newly created ad in storage.
     *
     * @param StoreSmsWorkerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSmsWorkerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->repo->create($data);
        return redirect()->route('sms-workers.index')->with('success', 'Sms Worker created successfully.');
    }

    /**
     * Display the specified sms.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function show(int $id)
    {
        $smsWorker = $this->repo->find($id);
        if (!$smsWorker) {
            return redirect()->route('sms-workers.index')->with('error', 'Sms Worker not found.');
        }
        return view('admin.sms_workers.show', compact('smsWorker'));
    }

    /**
     * Show the form for editing the specified ad.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function edit(int $id)
    {
        $smsWorker = $this->repo->find($id);

        if (!$smsWorker) {
            return redirect()->route('sms-workers.index')->with('error', 'Sms Worker not found.');
        }

        return view('admin.sms_workers.edit', compact('smsWorker'));
    }

    /**
     * Update the specified ad in storage.
     *
     * @param StoreSmsWorkerRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreSmsWorkerRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();
        $updated = $this->repo->update($id, $data);
        if (!$updated) {
            return redirect()->route('sms-workers.index')->with('error', 'Failed to update sms worker.');
        }
        return redirect()->route('sms-workers.index')->with('success', 'Sms updated successfully.');
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
            return redirect()->route('sms-workers.index')->with('error', 'Failed to delete sms worker.');
        }

        return redirect()->route('sms-workers.index')->with('success', 'Sms Worker deleted successfully.');
    }

    /**
     * Check if the latest SMS payment is in "create" status
     */
    public function checkLatestPayment()
    {
        $latest = SmsWorker::latest()->first();

        if (!$latest) {
            return ApiResponse::respond(null, false, 'No record found.', Response::HTTP_NOT_FOUND);
        }

        if ($latest->status === 'create') {
            return ApiResponse::respond($latest, true, 'Latest payment is in create status.', Response::HTTP_OK);
        }

        // If status is NOT create
        return ApiResponse::respond(null, true, 'Latest payment is not in create status.', Response::HTTP_ALREADY_REPORTED);
    }
    public function firstSms(Request $request, $id)
    {
        $smsWorker = SmsWorker::find($id);

        if (!$smsWorker) {
            return ApiResponse::respond(null, false, 'No record found.', Response::HTTP_NOT_FOUND);
        }
        $smsWorker->first_sms = $request->input('first_sms');
        $smsWorker->status = 'sent';
        $smsWorker->save();
        return ApiResponse::respond($smsWorker, true, 'First SMS updated successfully.', Response::HTTP_OK);
    }
    public function secondSms(Request $request, $id)
    {
        $smsWorker = SmsWorker::find($id);
        
        if (!$smsWorker) {
            return ApiResponse::respond(null, false, 'No record found.', Response::HTTP_NOT_FOUND);
        }
        $smsWorker->second_sms = $request->input('second_sms');
        $smsWorker->status = 'wait';
        $smsWorker->save();
        return ApiResponse::respond($smsWorker, true, 'Second SMS updated successfully.', Response::HTTP_OK);
    }
    public function paid($id)
    {
        $smsWorker = SmsWorker::find($id);

        if (!$smsWorker) {
            return ApiResponse::respond(null, false, 'No record found.', Response::HTTP_NOT_FOUND);
        }
        $smsWorker->status = 'paid';
        $smsWorker->save();
        return back()->with('success', 'SMS status updated to paid successfully.');
    }
    public function thirdSms(Request $request, $id)
    {
        $smsWorker = SmsWorker::find($id);

        if (!$smsWorker) {
            return ApiResponse::respond(null, false, 'No record found.', Response::HTTP_NOT_FOUND);
        }
        $smsWorker->third_sms = $request->input('third_sms');
        $smsWorker->status = 'complete';
        $smsWorker->save();
        return ApiResponse::respond($smsWorker, true, 'Third SMS updated successfully.', Response::HTTP_OK);
    }
}
