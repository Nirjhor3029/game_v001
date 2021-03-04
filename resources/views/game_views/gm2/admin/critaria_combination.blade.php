@extends('game_views.gm2.layout.app')

@push('css')

@endpush
@push('js')

@endpush
@section('content')
<div class="gm2">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">

                @php
                $level_options = Config::get('game.game2.options');
                @endphp
                {{--create form--}}

                <form action="{{route('gm2.admin.critaria_combination')}}" method="post" class="row mt-9vh">
                    @csrf
                    <div class="offset-sm-3 col-sm-6 ">
                        <table class="table ">
                            <tr>
                                <th>No.</th>
                                <th>X Axis</th>
                                <th>Y Axis</th>
                                <th>Value/Mark</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach ($level_options as $level1)
                            @foreach ($level_options as $level2)
                            @if($level1['id'] == $level2['id'])
                            @continue
                            @else
                            {{--create input field--}}
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $level1['name'] }}</td>
                                <td>{{ $level2['name'] }}</td>
                                <td>
                                    <?php
                                    $input_name = strtolower(str_replace(' ', '',  $level1['id']."_".$level2['id']));
                                ?>
                                    <div class="form-group">
                                        <input type="number" name="point_value[]" class="form-control form-control-sm">
                                        <input type="text" name="point[]" value="{{$input_name}}" hidden>
                                    </div>

                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endif
                            @endforeach
                            @endforeach

                        </table>

                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>

@endsection
