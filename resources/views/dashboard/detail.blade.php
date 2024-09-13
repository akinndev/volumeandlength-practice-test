@extends('layouts.app')
@section('content')
    <div>
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">{{ $data['name'] }}</h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-black-500">
                <strong>SPKID:</strong> {{ $data['neo_reference_id'] }}
            </p>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Physical Parameters</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <dl class="px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 max-h-40 overflow-y-auto">
                            <dt class="font-semibold">absolute_magnitude_h</dt>
                            <dd>{{ $data['absolute_magnitude_h'] }}</dd>
                        </dl>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Orbit Parameters</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <dl class="px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 max-h-40 overflow-y-auto">
                            @php
                                $data['orbital_data']['orbit_class'] = '';
                            @endphp
                            @foreach ($data['orbital_data'] as $key => $value)
                                <div class="mb-2">
                                    <dt class="font-semibold">{{ $key }}</dt>
                                    <dd>{{ $value ? $value : 'N/A' }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Close Approach Data</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <dl class="px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 max-h-40 overflow-y-auto">
                            @foreach ($data['close_approach_data'] as $item)
                                @foreach ($item as $key => $value)
                                    <div class="mb-2">
                                        <dt class="font-semibold">{{ $key }}</dt>
                                        <dd>
                                            @if (is_array($value))
                                                <dl>
                                                    @foreach ($value as $key => $value)
                                                        <dt class="font-semibold">{{ $key }}</dt>
                                                        <dd>{{ $value ? $value : 'N/A' }}</dd>
                                                    @endforeach
                                                </dl>
                                            @else
                                                {{ $value ? $value : 'N/A' }}
                                            @endif
                                        </dd>
                                    </div>
                                @endforeach
                            @endforeach
                        </dl>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
