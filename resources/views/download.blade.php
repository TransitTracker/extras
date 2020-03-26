@extends('layout')

@section('content')
    <div class="accordion" id="accordion">
        @foreach($directories as $directory)
            <div class="card">
                <div class="card-header row" id="heading{{ ltrim($directory, 'public/')}}">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ ltrim($directory, 'public/')}}" aria-expanded="false" aria-controls="collapse{{ ltrim($directory, 'public/')}}">
                        <b>{{ ltrim($directory, 'public/')}}</b>
                    </button>
                </div>
                <div class="collapse" id="collapse{{ ltrim($directory, 'public/')}}" aria-labelledby="heading{{ ltrim($directory, 'public/')}}" data-parent="#accordion">
                    <div>
                        <div class="card-body">
                            <ul>
                                @foreach(\Illuminate\Support\Facades\Storage::files($directory) as $file)
                                    <li>
                                        <a download="{{ ltrim($file, $directory) }}" href="{{ \Illuminate\Support\Facades\Storage::url($file) }}" title="{{ ltrim($file, $directory) }}">
                                            {{ ltrim($file, $directory) }}
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