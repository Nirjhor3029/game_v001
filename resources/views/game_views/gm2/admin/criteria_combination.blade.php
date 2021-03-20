@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush
@push('js')

@endpush
@section('content')

    <div class="gm2">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                    <p>
                        Students can use any two out of the seven variables, namely, Price, Product Quality, Level of  Vertical Integration, Type of Food, Product Range, Breadth of Location, and Dining Option  to create a combination of two for their respective strategic groups. Please set an evaluation standard for each combination as per your choice. Thank you!
                    </p>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                    @php
                        $level_options = Config::get('game.game2.options');
                    @endphp
                    {{-- create form --}}

                    <form action="{{ route('teacher.criteria_combination') }}" method="post" class="row mt-9vh">
                        @csrf
                        <div class="offset-sm-3 col-sm-6">
                            <table class="table table-responsive table-condensed">
                                <tr>
                                    <th>Serial No</th>
                                    <th>X-Axis</th>
                                    <th>Y-Axis</th>
                                    <th>Point</th>
                                </tr>
                                <?php
                                    $i = 1;
                                    $x = [];
                                ?>
                                @foreach ($level_options as $level1)
                                    @foreach ($level_options as $level2)
                                        @if ($level1['id'] == $level2['id'])    <!-- same id check ex: 1,1/ 2,2 -->
                                            @continue
                                        @else
                                            @php $x[] = $level1['id']; @endphp

                                            @if((in_array($level2['id'],$x))) <!-- combination check ex: 1,2 & 2,1 -->
                                                @continue
                                            @else
                                                {{-- create input field --}}

                                                <div class="col-sm-9">
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ Str::title($level1['name']) }} </td>
                                                        <td>{{ Str::title($level2['name']) }}</td>
                                                        <td>
                                                            <?php $input_name = strtolower(str_replace(' ', '',
                                                            $level1['id'] . '_' . $level2['id'])); ?>
                                                            <?php
                                                            $value = 0;
                                                            if($combinations->isEmpty()){
                                                                $value = 0;
                                                            }else{
                                                                $value = $combinations[$i-1]->point;
                                                            }
                                                            ?>
                                                            <div class="form-group">
                                                                <input type="number" name="point_value[]"
                                                                    class="form-control form-control-sm" value="{{$value}}" min="1" max="10">
                                                                <input type="text" name="point[]" value="{{ $input_name }}"
                                                                    hidden>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </div>


                                            @endif

                                            <?php $i++; ?>
                                        @endif
                                    @endforeach
                                @endforeach
                            </table>
                            <div class="submit go-right">
                                <input type="submit" value="Submit" class="btn btn-success">
                                <a href="{{route('teacher.set_group2')}}" class="btn btn-warning">Next</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
