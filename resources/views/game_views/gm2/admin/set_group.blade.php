@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush
@push('js')

@endpush
@section('content')

    <?php
    $rows = 5;
    $columns = 5;
    ?>
    <div class="gm2">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-9vh"
                     style="padding:40px;box-sizing:border-box ">

                    <div class="row">

                        <div class="col-sm-6" id="group_input_container">


                            <div class="row group_input" style="margin-bottom: 50px;">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="group_name">Group Name</label>
                                        <input type="text"
                                               class="form-control form-control-sm group_name"
                                               value="Group 1">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="row">Row</label>
                                        <select name="row" id="row"
                                                class="form-control form-control-sm group_row gm2-row">
                                            <option value="null">Select Row</option>
                                            @for ($i=1; $i <= $rows; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="column">Column</label>
                                        <select name="column" disabled id="column"
                                                class="form-control form-control-sm gm2-column group_column">
                                            <option value="null">Select Column</option>
                                            @for ($i=1; $i <= $columns; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <input type="button" value="+"
                                           class="btn btn-success btn-sm form-control group_input_plus">
                                    <input type="button" value="-"
                                           class="invisible btn btn-danger btn-sm form-control group_input_minus">
                                </div>
                            </div>


                            @foreach($restaurantGroups as $key => $item)
                                <?php
                                $firstInput = $restaurantGroups;
                                $row = substr($item->point, 0, 1);
                                $column = substr($item->point, 1, 2);
                                ?>

                                <div class="row group_input">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="group_name">Group Name</label>
                                            <input type="text"
                                                   class="form-control form-control-sm group_name"
                                                   value="{{$item->name}}">
                                        </div>
                                    </div>

                                    <?php
                                    $row = substr($item->point, 0, 1);
                                    $column = substr($item->point, 1, 2);
                                    ?>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="row">Row</label>
                                            <select name="row" id="row"
                                                    class="form-control form-control-sm group_row gm2-row">
                                                <option value="null">Select Row</option>
                                                @for ($i=1; $i <= $rows; $i++)
                                                    <option
                                                        value="{{$i}}" {{ ( $row == $i )? "selected" : ""}} >{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="column">Column</label>
                                            <select name="column" disabled id="column"
                                                    class="form-control form-control-sm gm2-column group_column">
                                                <option value="null">Select Column</option>
                                                @for ($i=1; $i <= $columns; $i++)
                                                    <option
                                                        value="{{$i}}" {{ ( $column == $i )? "selected" : ""}} >{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">

                                        <input type="button" value="-"
                                               class=" btn btn-danger btn-sm form-control group_input_minus">
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="col-sm-6">
                            <div class="left-side-container">
                                <div class="row">
                                    <div class="col-sm-4 txt-center">High</div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4"></div>
                                </div>

                                <div class="flex">
                                    <!-- <h1>Price</h1> -->
                                    <select name="" id="gm2-y-axis" class="form-control form-control-sm select_criteria"
                                            data-type="1">
                                        <option selected value="0" disabled>Select criteria</option>
                                        @foreach($gType as $item)
                                            <option value="{{$item['id']}}"
                                                    class="" {{ ( optional($graphLevel)->y_level == $item['id'] )? "selected" : ""}}>{{Str::title($item['name'])}}
                                            </option>
                                        @endforeach
                                    </select>


                                    <div class="chart">
                                        <div class="table-responsive">
                                            <table class="dragdrop_graph " id="">
                                                @for($r=1; $r <= $rows; $r++)
                                                    <tr>
                                                        @for($c=1; $c <= $columns; $c++)
                                                            <td class="empty2 droppable jquery_drop_box"
                                                                id="{{$r}}{{$c}}"></td>
                                                        @endfor
                                                    </tr>
                                                @endfor
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-sm-4 txt-center">
                                            Low
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <select name="" id="gm2-x-axis" class="form-control form-control-sm "
                                                    data-type="2">
                                                <option selected value="0" disabled>Select criteria</option>
                                                @foreach($gType as $item)
                                                    <option
                                                        value="{{$item['id']}}" {{ ( optional($graphLevel)->x_level == $item['id'] )? "selected" : ""}}>{{Str::title($item['name'])}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 txt-center">
                                            High
                                        </div>
                                    </div>
                                    <!-- <h1 class="txt_xaxis">Level of vertical Integration</h1> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" value="Set" class="btn btn-success" id="gm2_group_set">
                </div>
            </div>
        </div>
    </div>

@endsection
