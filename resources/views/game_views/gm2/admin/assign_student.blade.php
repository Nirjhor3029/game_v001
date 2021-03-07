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
                    <div class="col-sm-6">
                        <div class="row" style="margin-bottom: 30px;">
                            <div class="col-sm-4">Students</div>
                            <div class="col-sm-6">Restaurent</div>
                            <div class="col-sm-2">Set</div>
                        </div>
                        @foreach($students as $student)
                        
                        <div class="row restaurant_container ">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">{{$student->name}}</label>
                                    <input type="text" value="{{$student->id}}" name="" class="student_name" hidden>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="group[]"  class="form-control form-control-sm  restaurant_select">
                                        <option value="null" selected disabled>Select Group</option>
                                        @foreach($restaurants as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="button" name="" value="Set" id="" class="btn btn-success set">
                            </div>
                        </div>
                            
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
