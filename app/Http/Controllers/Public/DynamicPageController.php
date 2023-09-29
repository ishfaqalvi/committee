<?php

namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Committee;
use Carbon\Carbon;

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

    public function cronJob()
    {
        foreach (Committee::where('status', 'Active')->get() as $committee) {
            
            // if ($active = $committee->intervals()->active()->first()) {
            //     // code...
            // }
            $start_date = $committee->start_date;
            $close_date = addDays($start_date, $committee->collection_days);
            $intervals  = $committee->intervals()->closed()->count();
            if ($intervals > 0) {
                $start_date = addDays($start_date, $committee->committeeType->duration_days * $intervals);
                $close_date   = addDays($start_date, $committee->collection_days);
            }
            if ($start_date == strtotime(date('Y-m-d'))) {
                $interval = $committee->intervals()->pending()->first();
                $interval->update([
                    'start_date' => $start_date,
                    'close_date' => $close_date,
                    'status'     => 'Active'
                ]);
                foreach ($committee->intervals()->pluck('user_id') as $id) {
                    $interval->payments()->create(['user_id' => $id]);  
                }
            }
        }
        return 'Cron Job run Successfully.';
    }
}