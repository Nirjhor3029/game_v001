@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush
@push('js')
<script>
    

    $("table td").on("click",function(e){
        let that = $(this);
        that.toggleClass("checkedTd");
        console.log("clicked !");
    });

    $(document).on("click",".setTD",function(e){
        let that = $(this);
        let checkedTds = [];
        $(".checkedTd").each(function(el){
            let tdId = $(this).attr("id");
            checkedTds.push(tdId)
            // console.log(tdId);
        });
        console.log(checkedTds);
        let groupInput = that.parents(".group_input");
        groupInput.find(".group_name").attr("disabled",true);
        groupInput.find(".setTD").attr("disabled",true);
        
    });

</script>

@endpush
@section('content')

    <?php
    $rows = 5;
    $columns = 5;
    ?>
    <div class="gm2">
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                    <p>
                    In order to make the next game accessible to your students you need to form strategic groups for the restaurants industry and assign a particular restaurant to each student. Please note that you can only choose only one restaurant per group to be assigned among students. So, if you have burger king and KFC under the same group, you can only assign either Burger King or KFC to students. 
                    </p>
                    <p>
                    To create your own strategic group, please select the variables to be used as dimensions on axis.
                    </p>
                    <p>
                    Then create the number of groups that you may deem necessary by clicking on the add button. Please click on the available boxes (green) to create your strategic groups. You may choose more than one box to create a group.
                    </p>
                    <p>
                    Once you have created your groups, please drag the restaurant in that specific group. Please select one restaurant per group to be assigned. The selected restaurant would be assigned a a star on the right after the selection is done. 
                    </p>
                </div>
            </div>
        </div>
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
                                        <input type="text" class="form-control form-control-sm group_name" value="Group 1">
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <label for=""></label>
                                    <input type="button" value="+" class="btn btn-success btn-sm form-control group_input_plus">
                                </div>
                                <div class="col-sm-1">
                                    <label for=""></label>
                                    <button  class="invisible btn btn-default btn-sm form-control setTD">
                                        <img src="{{asset('/assets/icons/checked.svg')}}" alt="" class="leader-icon">
                                    </button>
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
                                            <input type="text" class="form-control form-control-sm group_name"
                                                   value="{{$item->name}}">
                                        </div>
                                    </div>

                                    <?php
                                        $row = substr($item->point, 0, 1);
                                        $column = substr($item->point, 1, 2);
                                    ?>

                                    <div class="offset-sm-1 col-sm-1">
                                        <label for=""></label>
                                        <input type="button" value="-" class=" btn btn-danger btn-sm form-control group_input_minus">
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
                                                            <td class="empty2 droppable jquery_drop_box setGroupTd"
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
