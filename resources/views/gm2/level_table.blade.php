@extends('game_views.gm2.layout.app')

@push('css')

@endpush
@push('js')

@endpush
@section('content')
    <div class="gm2">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"
                     style="padding:40px;box-sizing:border-box">
                    <div class="row mt-9vh">
                        @php
                            $level_options = Config::get('game.game2.options');
                        @endphp
                        {{--create form--}}
                        <ul>
                            @foreach ($level_options as $level1)
                                @foreach ($level_options as $level2)
                                    @if($level1['id'] == $level2['id'])
                                        @continue
                                    @else
                                        {{--create input field--}}
                                        <li>{{ $level1['id'] }} {{ $level2['id'] }}</li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
