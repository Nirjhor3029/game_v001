@extends('game_views.gm2.layout.app')

@push('css')

@endpush
@push('js')

@endpush
@section('content')

<?php
    $groups = [1,2, 3, 4, 5,6,7,8,9];
?>
<div class="gm2">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-9vh"
                style="padding:40px;box-sizing:border-box ">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">Restaurants</div>
                            <div class="col-sm-6">Groups</div>
                            <div class="col-sm-2">Leader</div>
                        </div>
                        @foreach($restaurants as $restaurant)
                        
                        <div class="row restaurant_container">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" value="{{$restaurant->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="group" id="group" class="form-control form-control-sm group">
                                        <option value="null" selected disabled>Select Group</option>
                                        @foreach($groups as $group)
                                        <option value="{{$group}}">{{$group}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" name="leader" id="" class="leader">
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