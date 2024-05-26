@extends('layouts.app')

@section('content')
    <meta name="ajaxChartURL" content={{ route('ajax.transport-used') }}>
    <div class="container">
        <div class="row mb-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Vehicle usage
                    </div>
                    <div class="card-body">
                        @foreach ($tripsProcentage as $name => $procentage)
                            <p class="w-100">{{ $name }}: <span class="ms-auto">{{ $procentage }}%</span></p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Vehicle average distance
                    </div>
                    <div class="card-body">
                        @foreach ($tripsDistanceAverage as $name => $distance)
                            <p class="w-100">{{ $name }}: <span class="ms-auto">{{ $distance }}KM</span></p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                Employee data overview
            </div>
            <div class="card-body">
                <table class="table table-striped" data-toggle="table">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="name">Name</th>
                            <th data-sortable="true" data-field="car">Usage car</th>
                            <th data-sortable="true" data-field="bike">Usage Bike</th>
                            <th data-sortable="true" data-field="public_transport">Usage Public transportation</th>
                            <th data-sortable="true" data-field="average_distance">Average distance</th>
                            <th data-sortable="true" data-field="average_duration">Average duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeData as $name => $data)
                            <tr>
                                <td data-field="name">{{ $name }}</td>
                                <td data-field="car">{{ $data['car'] }}%</td>
                                <td data-field="bike">{{ $data['bike'] }}%</td>
                                <td data-field="public_transport">{{ $data['public_transportation'] }}%</td>
                                <td data-field="average_distance">{{ $data['average_distance'] }} KM</td>
                                <td data-field="average_duration">{{ $data['average_duration'] }} minutes</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                Car experiment overview
            </div>
            <div class="card-body">
                <canvas id="car-chart"></canvas>
            </div>

        </div>
    </div>
@endsection
