@extends('layout')

@section('content')
    <div class="accordion" id="accordion">
        @foreach($trips as $trip)
            <div class="card">
                <div class="card-header row" id="heading{{ $trip->id }}">
                    <div class="col-6 col-md-4">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $trip->id }}" aria-expanded="false" aria-controls="collapse{{ $trip->id }}">
                            <b>{{ $trip->trip_id }}</b>
                        </button>
                    </div>
                    <div class="col-6 col-md-4">
                        At {{ $trip->start_time }} on
                        @if(strpos($trip->route_id, 'E') !== false)
                            <div class="badge badge-info">
                                {{ $trip->route_id }}
                            </div>
                        @else
                            <div class="badge badge-warning">
                                {{ $trip->route_id }}
                            </div>
                        @endif
                    </div>
                    @if($trip->sight)
                        <div class="col-12 col-md-4">
                            @if($trip->sight->monday)
                                <b>Mon</b>
                            @endif
                            @if($trip->sight->tuesday)
                                <b>Tue</b>
                            @endif
                            @if($trip->sight->wednesday)
                                <b>Wed</b>
                            @endif
                            @if($trip->sight->thursday)
                                <b>Thu</b>
                            @endif
                            @if($trip->sight->friday)
                                <b>Fri</b>
                            @endif
                            @if($trip->sight->saturday)
                                <b>Sat</b>
                            @endif
                            @if($trip->sight->sunday)
                                <b>Sun</b>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="collapse" id="collapse{{ $trip->id }}" aria-labelledby="heading{{ $trip->id }}" data-parent="#accordion">
                    <div>
                        <div class="row card-body">
                            <div class="col-6">
                                <b>First sight:</b> {{ $trip->created_at }}
                            </div>
                            <div class="col-6">
                                <b>Last sight:</b> {{ $trip->updated_at }}
                            </div>
                        </div>
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
            </div>
        @endforeach
    </div>
@endsection