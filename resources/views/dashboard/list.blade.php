@extends('layouts.app')
@section('content')
    <ul role="list" class="divide-y divide-gray-100">
        @if (isset($data['near_earth_objects']))
            @foreach ($data['near_earth_objects'] as $item)
            {{-- {{dd($item)}} --}}
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900"><a href="{{route('dashboard.detail', ['id' => $item['neo_reference_id']])}}">{{ $item['name'] }} -
                                #{{ $item['neo_reference_id'] }}</a></p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-500"><a target="blank"
                                    href="{{ $item['nasa_jpl_url'] }}">{{ $item['nasa_jpl_url'] }}</a></p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm leading-6 text-gray-900">Absolute Magnitude H</p>
                        <p class="mt-1 text-xs leading-5 text-gray-500">{{ $item['absolute_magnitude_h'] }}</p>
                    </div>
                </li>
            @endforeach
        @else
            <li class="flex justify-between gap-x-6 py-5">Data not found.</li>
        @endif
    </ul>

    @if (isset($data['links']) && isset($data['near_earth_objects']))
        @php
            $previousUrl = parse_url($data['links']['previous']);
            $nextUrl = parse_url($data['links']['next']);
            parse_str($previousUrl['query'], $queryParams);
            $previousStartDate = $queryParams['start_date'];
            $previousEndDate = $queryParams['end_date'];

            parse_str($nextUrl['query'], $queryParams);
            $nextStartDate = $queryParams['start_date'];
            $nextEndDate = $queryParams['end_date'];
        @endphp
        <div class="items-center border-t border-gray-200 bg-white py-3">
            <div class="items-center">
                <a href="{{ route('dashboard.list', ['start_date' => $previousStartDate, 'end_date' => $previousEndDate]) }}"
                    class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                <a href="{{ route('dashboard.list', ['start_date' => $nextStartDate, 'end_date' => $nextEndDate]) }}"
                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
            </div>
        </div>
    @endif
@endsection
