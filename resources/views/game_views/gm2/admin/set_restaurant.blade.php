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
                                <div class="col-sm-4">Restaurants</div>
                                <div class="col-sm-6">Groups</div>
                                <div class="col-sm-2">Market Leader</div>
                            </div>
                            @foreach($restaurants as $restaurant)

                                <div class="row restaurant_container ">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="">{{Str::title($restaurant->name)}}</label>
                                            <input type="text" value="{{$restaurant->id}}" name="restaurant_name[]"
                                                   class="restaurant_name" hidden>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="group[]" class="form-control form-control-sm group">
                                                <option value="null" selected disabled>Select Group</option>
                                                @foreach($restaurantGroups as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="leader[]" id="" class="leader">
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
