@extends('layout')

@section('content')
    <div class="accordion" id="accordion">
        <div class="card">
            @foreach($trips as $trip)
                <div class="card-header" id="heading{{ $trip->id }}">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $trip->id }}" aria-expanded="false" aria-controls="collapse{{ $trip->id }}">
                        <b>{{ $trip->trip_id }}</b> at {{ $trip->start_time }} on {{ $trip->route_id }}
                    </button>
                </div>
                <div class="collapse" id="collapse{{ $trip->id }}" aria-labelledby="heading{{ $trip->id }}" data-parent="#accordion">
                    <div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Stop sequence</th>
                                    <th>Arrival time</th>
                                    <th>Departure time</th>
                                    <th>Stop ID</th>
                                    <th>Schedule relationship</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trip->stop_time_updates as $stop)
                                    <tr>
                                        <th scope="row">{{ $stop['stop_sequence'] }}</th>
                                        <td class="timestamp">{{ $stop['arrival_time'] }}</td>
                                        <td class="timestamp">{{ $stop['departure_time'] }}</td>
                                        <td>{{ $stop['stop_id'] }}</td>
                                        <td>{{ $stop['schedule_relationship'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection