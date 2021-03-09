@extends('game_views.gm2.layout.app')

@push('css')

@endpush

@push('js')
<script>
$("#sortable").sortable({
    connectWith: [".droppable"]
});

$(".droppable").sortable({
    cursor: "move",
    connectWith: "#sortable",
    update: function(e, ui) {
        let row = $(this).closest('tr').index();
        let column = $(this).closest('td').index();
        console.log(`row ${row} & column ${column}`);
        /* each restaurant drop in every box so push restaurant Id & name array */
        let restData = [];
        $(this).children().each(function(idx, ele) {
            let result = {
                'restId': $(ele).data('tag'),
                'restName': $(ele).data('name'),
            }
            restData.push(result);
        });

        console.dir(restData);
        sendData(row, column, restData);
    }
});

function sendData(graphPointRow, graphPointColumn, restData) {
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let data = {
            graphPointRow: graphPointRow,
            graphPointColumn: graphPointColumn,
            restData: restData
        };
        $.ajax({
            type: "POST",
            url: "add_graph",
            data: data,
            success: function(data) {
                // console.log(data);
            }
        });
    });
}

function titleCase(str) {
    return str.toLowerCase().split(' ').map(function(word) {
        return (word.charAt(0).toUpperCase() + word.slice(1));
    }).join(' ');
}

    $(".ajx_select_criteria").on("change", function(e) {
        console.log("change");
        let xAxis = $('#x-axis').children("option:selected").val();
        let yAxis = $('#y-axis').children("option:selected").val();
        $.ajax({
            type: "POST",
            url: "set_student_criteria",
            data: {
                xAxis: xAxis,
                yAxis: yAxis,
            },
            success: function(data) {
                console.log(data);
                // $(this).prop("disabled", "true");
                //return;
            }
        });
    });

$(document).ready(function() {
    let records = @json($records);
    records.forEach(function(ele) {
        let point = ele.graph_point;
        let row = (String(point).slice(0, 1)) - 1;
        let col = (String(point).slice(-1)) - 1;
        $('.dragdrop_graph tr').eq(row).children(':eq(' + col + ')').append(
            '<div data-tag="' + ele.restaurant_id + '" data-name="' + ele.name +
            '" draggable="true" class="option-item bg-light ui-sortable-handle" style=""><span class="">' +
            titleCase(ele.name) + '</span></div>');
    });
});
</script>

@endpush

@section('content')

<?php $mimnus_data = $added_restaurant;?>
<div class="gm2">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">

                <div class="row mt-9vh">
                    <div class="col-md-2">
                        <div>
                            <div id="sortable" class="" style="min-height: 600px;">
                                @foreach($restaurants as $restaurant)
                                @if(!in_array(trim($restaurant->id),$mimnus_data))
                                <div data-tag="{{$restaurant->id}}" data-name="{{$restaurant->name}}" draggable="true"
                                    class="option-item bg-light">
                                    <span class="">{{Str::title($restaurant->name)}}</span>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="select_box">
                        How many group You want to create: 
                        <div class="row">
                            <select class="form-control offset-sm-4 col-sm-3" id="gm2_number_of_group">
                                <option value="" selected>Select</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <p id="gm2_select_group_txt" class="gm2_select_group_txt"></p>
                        </div>
                        </div>

                        <div class="left-side-container">
                            <div class="row">
                                <div class="col-sm-4 txt-center">High</div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4"></div>
                            </div>

                            <div class="flex">
                                <!-- <h1>Price</h1> -->
                                <select name="" id="y-axis" class="form-control form-control-sm select_criteria ajx_select_criteria"
                                    data-type="1">
                                    <option selected value="0">Select criteria</option>
                                    @foreach($gType as $item)
                                    <option value="{{$item['id']}}" class="" {{(optional($graphLevel)->y_level==$item['id'])? "selected":""}}>{{$item['name']}}
                                    </option>
                                    @endforeach
                                </select>


                                <div class="chart">
                                    <div class="table-responsive">
                                        <table class="dragdrop_graph " id="">
                                            <tr>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                            </tr>
                                            <tr>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                            </tr>
                                            <tr>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                            </tr>
                                            <tr>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                            </tr>
                                            <tr>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                                <td class="empty2 droppable jquery_drop_box"></td>
                                            </tr>
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
                                        <select name="" id="x-axis" class="form-control form-control-sm ajx_select_criteria" data-type="2">
                                            <option selected value="0">Select criteria</option>
                                            @foreach($gType as $item)
                                            <option value="{{$item['id']}}" {{(optional($graphLevel)->x_level==$item['id'])? "selected":""}} >{{$item['name']}}</option>
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

                <a href="{{route('gm2.market_scenario')}}" class="btn btn-success float-right">Next</a>
            </div>
        </div>
    </div>
</div>

@endsection
