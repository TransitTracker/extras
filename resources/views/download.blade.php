@extends('layout')

@section('content')
    <div class="accordion" id="accordion">
        @foreach($directories as $directory)
            <div class="card">
                <div class="card-header row" id="heading{{ basename($directory) }}">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ basename($directory) }}" aria-expanded="false" aria-controls="collapse{{ basename($directory) }}">
                        <b>{{ basename($directory) }}</b>
                    </button>
                </div>
                <div class="collapse" id="collapse{{ basename($directory) }}" aria-labelledby="heading{{ basename($directory) }}" data-parent="#accordion">
                    <div>
                        <div class="card-body">
                            <ul>
                                @foreach(\Illuminate\Support\Facades\Storage::files($directory) as $file)
                                    <li>
                                        <a download="{{ basename($file) }}" href="{{ \Illuminate\Support\Facades\Storage::url($file) }}" title="{{ basename($file) }}">
                                            {{ basename($file) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection