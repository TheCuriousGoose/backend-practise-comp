<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function ajaxTransportUsed()
    {
        $labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'];
        $weeklyTrips = Trip::selectRaw('YEAR(start_date) as year, WEEK(start_date) as week, transportation_id, COUNT(*) as transportCount')
            ->groupBy('year', 'week', 'transportation_id')
            ->orderBy('year')
            ->orderBy('week')
            ->orderBy('transportation_id')
            ->get();

        $formattedData = [];
        foreach ($weeklyTrips as $trips) {
            $formattedData[$trips->week][Transportation::find($trips->transportation_id)->name] = $trips->transportCount;
        }

        return response()->json(['labels' => $labels, 'data' => $formattedData]);
    }
}
