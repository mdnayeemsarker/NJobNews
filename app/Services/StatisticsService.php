<?php

namespace App\Services;

use App\Models\Ad;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\User;
use App\Models\Visit;
use App\Models\Category;
use App\Models\JobVisit;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SmsWorker;
use App\Models\Upload;
use Illuminate\Support\Facades\Request;

class StatisticsService
{
    public function getStatistics()
    {
        $category = Category::count();
        $page = Page::count();
        $role = Role::count();
        $permission = Permission::count();
        $ad = Ad::count();
        $upload = Upload::count();
        $smsWorker = SmsWorker::count();
        $jobStatistics = $this->getJobStatistics();
        $visitorStatistics = $this->getVisitorStatistics();
        return compact('jobStatistics', 'category', 'page', 'role', 'permission', 'ad', 'upload', 'smsWorker', 'visitorStatistics');
    }
    public function getSingleStatistics($model, $column, $jobId)
    {
        $totalView = $model::where($column, $jobId)->count();
        $todayView = $model::where($column, $jobId)->whereDate('created_at', Carbon::today())->count();
        $last7DaysView = $model::where($column, $jobId)
            ->whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])
            ->count();
        $last15DaysView = $model::where($column, $jobId)
            ->whereBetween('created_at', [Carbon::now()->subDays(15)->startOfDay(), Carbon::now()->endOfDay()])
            ->count();
        $todayPercent = $totalView > 0 ? number_format(($todayView / $totalView) * 100, 1) : 0;
        $last7DaysPercent = $totalView > 0 ? number_format(($last7DaysView / $totalView) * 100, 1) : 0;
        $last15DaysPercent = $totalView > 0 ? number_format(($last15DaysView / $totalView) * 100, 1) : 0;
        return compact('totalView', 'todayView', 'last7DaysView', 'last15DaysView', 'todayPercent', 'last7DaysPercent', 'last15DaysPercent');
    }

    public function getUniqueVisitorsPerDay()
    {
        $perPage = 10;
        $uniqueVisitors = Visit::query()
            ->select('visited_at', 'ip_address')
            ->orderBy('visited_at', 'desc')
            ->paginate($perPage);

        $groupedVisitors = $uniqueVisitors
            ->getCollection()
            ->groupBy(function ($visit) {
                return Carbon::parse($visit->visited_at)->toDateString();
            })
            ->map(function ($group) {
                return [
                    'unique_ips' => $group->unique('ip_address')->count(),
                ];
            });

        $visitors = new \Illuminate\Pagination\LengthAwarePaginator(
            $groupedVisitors->toArray(),
            $uniqueVisitors->total(),
            $perPage,
            $uniqueVisitors->currentPage(),
            ['path' => Request::url(), 'query' => Request::query()],
        );
        return compact('visitors');
    }

    private static function getJobStatistics()
    {
        $totalJobs = Job::count();
        $totalView = JobVisit::count();
        $uniqueTotalView = JobVisit::distinct('ip_address')->count('ip_address');
        $todayView = JobVisit::whereDate('created_at', Carbon::today())->count();
        $uniqueTodayView = JobVisit::whereDate('created_at', Carbon::today())
            ->distinct('ip_address')
            ->count('ip_address');
        $last7DaysView = JobVisit::whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])
            ->count();
        $uniqueLast7DaysView = JobVisit::whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])
            ->distinct('ip_address')
            ->count('ip_address');
        $last15DaysView = JobVisit::whereBetween('created_at', [Carbon::now()->subDays(15)->startOfDay(), Carbon::now()->endOfDay()])
            ->count();
        $uniqueLast15DaysView = JobVisit::whereBetween('created_at', [Carbon::now()->subDays(15)->startOfDay(), Carbon::now()->endOfDay()])
            ->distinct('ip_address')
            ->count('ip_address');
        $todayPercent = $totalView > 0 ? number_format(($todayView / $totalView) * 100, 1) : 0;
        $last7DaysPercent = $totalView > 0 ? number_format(($last7DaysView / $totalView) * 100, 1) : 0;
        $last15DaysPercent = $totalView > 0 ? number_format(($last15DaysView / $totalView) * 100, 1) : 0;
        $uniqueTodayPercent = $uniqueTotalView > 0 ? number_format(($uniqueTodayView / $uniqueTotalView) * 100, 1) : 0;
        $uniqueLast7DaysPercent = $uniqueTotalView > 0 ? number_format(($uniqueLast7DaysView / $uniqueTotalView) * 100, 1) : 0;
        $uniqueLast15DaysPercent = $uniqueTotalView > 0 ? number_format(($uniqueLast15DaysView / $uniqueTotalView) * 100, 1) : 0;
        return [
            'totalJobs' => $totalJobs,
            'totalView' => $totalView,
            'uniqueTotalView' => $uniqueTotalView,
            'todayView' => $todayView,
            'uniqueTodayView' => $uniqueTodayView,
            'last7DaysView' => $last7DaysView,
            'uniqueLast7DaysView' => $uniqueLast7DaysView,
            'last15DaysView' => $last15DaysView,
            'uniqueLast15DaysView' => $uniqueLast15DaysView,
            'todayPercent' => $todayPercent,
            'last7DaysPercent' => $last7DaysPercent,
            'last15DaysPercent' => $last15DaysPercent,
            'uniqueTodayPercent' => $uniqueTodayPercent,
            'uniqueLast7DaysPercent' => $uniqueLast7DaysPercent,
            'uniqueLast15DaysPercent' => $uniqueLast15DaysPercent,
        ];
    }

    private static function getVisitorStatistics()
    {
        $totalView = Visit::count();
        $uniqueTotalView = Visit::distinct('ip_address')->count('ip_address');

        $todayView = Visit::whereDate('visited_at', Carbon::today())->count();
        $uniqueTodayView = Visit::whereDate('visited_at', Carbon::today())->distinct('ip_address')->count('ip_address');

        $last7DaysView = Visit::whereBetween('visited_at', [Carbon::now()->subDays(7), Carbon::now()])->count();
        $uniqueLast7DaysView = Visit::whereBetween('visited_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->distinct('ip_address')
            ->count('ip_address');

        $last15DaysView = Visit::whereBetween('visited_at', [Carbon::now()->subDays(15), Carbon::now()])->count();
        $uniqueLast15DaysView = Visit::whereBetween('visited_at', [Carbon::now()->subDays(15), Carbon::now()])
            ->distinct('ip_address')
            ->count('ip_address');
        $todayPercent = $totalView > 0 ? number_format(($todayView / $totalView) * 100, 1) : 0;
        $last7DaysPercent = $totalView > 0 ? number_format(($last7DaysView / $totalView) * 100, 1) : 0;
        $last15DaysPercent = $totalView > 0 ? number_format(($last15DaysView / $totalView) * 100, 1) : 0;
        $uniqueTodayPercent = $uniqueTotalView > 0 ? number_format(($uniqueTodayView / $uniqueTotalView) * 100, 1) : 0;
        $uniqueLast7DaysPercent = $uniqueTotalView > 0 ? number_format(($uniqueLast7DaysView / $uniqueTotalView) * 100, 1) : 0;
        $uniqueLast15DaysPercent = $uniqueTotalView > 0 ? number_format(($uniqueLast15DaysView / $uniqueTotalView) * 100, 1) : 0;
        return [
            'totalView' => $totalView,
            'uniqueTotalView' => $uniqueTotalView,
            'todayView' => $todayView,
            'uniqueTodayView' => $uniqueTodayView,
            'last7DaysView' => $last7DaysView,
            'uniqueLast7DaysView' => $uniqueLast7DaysView,
            'last15DaysView' => $last15DaysView,
            'uniqueLast15DaysView' => $uniqueLast15DaysView,
            'todayPercent' => $todayPercent,
            'last7DaysPercent' => $last7DaysPercent,
            'last15DaysPercent' => $last15DaysPercent,
            'uniqueTodayPercent' => $uniqueTodayPercent,
            'uniqueLast7DaysPercent' => $uniqueLast7DaysPercent,
            'uniqueLast15DaysPercent' => $uniqueLast15DaysPercent,
        ];
    }
}
