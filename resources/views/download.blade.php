@extends('layouts.app')

@section('content')
<div class="flex flex-col">
    <div class="w-full bg-primary-500 p-3 md:px-8 md:py-3">
        <a href="{{ route('home') }}" class="text-white">Back</a>
    </div>
    <div class="flex-grow w-full flex flex-col p-2 md:p-8">
        <ul>
            @foreach($files as $file)
                <li>
                    <a download="{{ basename($file) }}" href="{{ \Illuminate\Support\Facades\Storage::url($file) }}" title="{{ basename($file) }}" class="underline list-disc">
                        {{ basename($file) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection