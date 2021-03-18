@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush
@push('js')

@endpush
@section('content')


    <div class="gm2">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-9vh"
                     style="padding:40px;box-sizing:border-box ">

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row" style="margin-bottom: 30px;">
                                <div class="col-sm-3">Students</div>
                                <div class="col-sm-3">Email</div>
                                <div class="col-sm-4">Restaurent</div>
                                <div class="col-sm-2">Set</div>
                            </div>
                            @foreach($students as $student)

                                <div class="row restaurant_container ">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">{{$student->name}} </label>
                                            <input type="text" value="{{$student->id}}" name="" class="student_name"
                                                   hidden>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">{{$student->email}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            @php $check = 1 @endphp
                                            <select name="group[]"
                                                    class="form-control form-control-sm  restaurant_select" {{(!$check)? "disabled" : ""}}>
                                                <option value="null" selected disabled>Select Group</option>
                                                @foreach($restaurants as $item)
                                                    <?php $item = (object)$item; ?>
                                                    @if(empty($student->restaurantUser[0]))
                                                        @php $check = 1 @endphp
                                                        <option value="{{$item->res_id}}">
                                                            {{Str::title($item->res_name ." - ". $item->group_name)}}
                                                        </option>
                                                    @else
                                                        @php $check = ($student->restaurantUser[0]->restaurant_id == $item->res_id) @endphp
                                                        <option
                                                            value="{{$item->res_id}}" {{($check)? "selected":""}}>
                                                            {{Str::title($item->res_name ." - ". $item->group_name)}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="button" name="" value="{{($check)? 'Set' : 'Update'}}"  class="btn {{($check)? 'btn-success' : 'btn-warning'}} set" data-status = "{{($check)? 1 : 2}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12 mt-5vh">
            <div class="row ">
                @foreach($groupStudents as $key => $item )
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            {{Str::title($restaurants[$key]['res_name'])}} - {{Str::title($restaurants[$key]['group_name'])}}
                        </div>
                        <div class="card-body">
                            <ol>
                                @foreach($item as $student)
                                <li>{{Str::title($student['name'])}}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
    </div>
@endsection