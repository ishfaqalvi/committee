<?php

namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Committee;
use App\Models\Interval;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DynamicPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewHomePage()
    {
        return view('public.index');
    }

    public function startIntervals()
    {
        $todayTimestamp = now()->startOfDay()->timestamp;
        $committees = Committee::where('start_date', '<=', $todayTimestamp)->get();
        DB::transaction(function () use ($committees) {
            foreach ($committees as $committee) {
                $pendingMember = $committee->members()->where('status', 'Pending')->orderBy('order', 'asc')->first();
                if ($pendingMember) {
                    $committee->members()->where('status', 'Active')->update(['status' => 'Closed']);

                    $pendingMember->status = 'Active';
                    $pendingMember->save();

                    foreach ($pendingMember->committee->members()->pluck('user_id') as $id) {
                        $pendingMember->submissions()->create(['user_id' => $id]);  
                    }
                }
            }
        });
        return 'Intervals start Successfully.';
    }

    public function closeIntervals()
    {
        $ids = Committee::where('status', 'Active')->pluck('id');
        foreach (Interval::whereIn('committee_id',$ids)->closeToday()->get() as $interval) {
            $interval->update(['status' => 'Closed']);
        }
        return 'Intervals closed Successfully.';
    }
}