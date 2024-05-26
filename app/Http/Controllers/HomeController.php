<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $groupedTrips = Trip::with('transportation')->get()->groupBy('transportation.name');
        $employeeTrips = Trip::with('transportation', 'employee')->get()->groupBy('employee.fullname');
        $totalTripsCount = Trip::count();

        $tripsProcentage = [];
        $tripsDistanceAverage = [];

        foreach ($groupedTrips as $name => $trips) {
            $tripsProcentage[$name] = round(($trips->count() / $totalTripsCount) * 100, 2);
        }

        foreach ($groupedTrips as $name => $trips) {
            $tripsDistanceAverage[$name] = round($trips->average('distance'), 2);
        }

        $employeeData = [];

        $carId = Transportation::where('name', 'car')->pluck('id')[0];
        $bikeId = Transportation::where('name', 'bicycle')->pluck('id')[0];
        $publicTransportId = Transportation::where('name', 'publictransportation')->pluck('id')[0];

        foreach ($employeeTrips as $employee => $trips) {
            $totalTrips = $trips->count();

            $employeeData[$employee] = [
                'car' => round(($trips->where('transportation_id', $carId)->count() / $totalTrips) * 100, 2),
                'bike' => round($trips->where('transportation_id', $bikeId)->count() / $totalTrips * 100, 2),
                'public_transportation' => round($trips->where('transportation_id', $publicTransportId)->count() / $totalTrips * 100, 2),
                'average_distance' => round($trips->average('distance'), 2),
                'average_duration' => round($trips->average(function ($trip) {
                    return Carbon::parse($trip->end_date)->diffInMinutes(Carbon::parse($trip->start_date));
                }), 2)
            ];
        }

        uasort($employeeData, function($a, $b) {
            return $b['average_distance'] - $a['average_distance'];
        });

        return view('home', [
            'tripsProcentage' => $tripsProcentage,
            'tripsDistanceAverage' => $tripsDistanceAverage,
            'employeeData' => $employeeData
        ]);
    }
}
