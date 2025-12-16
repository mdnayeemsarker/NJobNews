<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    protected $settingRepository;
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }
    public function adminSetting()
    {
        return view('admin.setting.index');
    }
    public function adminSettingUpdate(Request $request)
    {
        $data = $request->except(['_token', 'part']);
        $final = [];
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                continue;
            }
            if ($value === '') {
                $final[$key] = '';
                continue;
            }
            if ($request->part === 'seo') {
                if (in_array($key, ['og_image'])) {
                    if (!$request->filled($key) && $request->has("old_$key")) {
                        $value = $request->input("old_$key");
                    }
                }
                unset($final["old_og_image"]);
            }
            if ($request->part === 'special') {
                if (in_array($key, ['special_section_img'])) {
                    if (!$request->filled($key) && $request->has("old_$key")) {
                        $value = $request->input("old_$key");
                    }
                }
                unset($final["old_special_section_img"]);
            }
            $final[$key] = $value;
        }
        $this->settingRepository->storeOrUpdate($final);
        return back();
    }
    
    public function apiSetting(Request $request)
    {
        $this->addVisitEntry($request);
        $google_ads = json_decode(get_setting('google_ads'));
        $data['googleAds'] = $google_ads;
        $affiliate = json_decode(get_setting('affiliate'));
        if (isset($affiliate->image)) {
            $affiliate->image = get_file_url($affiliate->image);
        } else {
            $affiliate->image = null;
        }
        $data['affiliateDetails'] = $affiliate;
        return ApiResponse::respond($data, true, 'Get all home news and setting', 200);
    }

    private function addVisitEntry($request)
    {
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'url' => $request->url(),
            'visited_at' => now(),
            'method' => $request->method(),
            'session_id' => session()->getId(),
            'previous_url' => $request->header('Referer'),
            'query_string' => $request->getQueryString(),
            'headers' => json_encode($request->headers->all()),
            'payload' => json_encode($request->all()),
        ]);
    }
}
