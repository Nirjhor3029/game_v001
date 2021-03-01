@extends('game_views.gm2.layout.app')

@push('css')
    <style>
        .empty {
            display: inline-block;
            height: 160px;
            width: 80%;
            margin: 10px;
            border: 3px solid cyan;
            background-color: white;
        }

        .hold {
            border: 4px solid #ccc;
        }

        .hovered {
            background: #f4f4f4;
            border: 2px dashed black !important;
        }

        .invisible {
            display: none;
        }


        /* Table */

        .dragdrop_graph {
            /* background-color: aliceblue; */
            width: 80%;
            height: 400px;
            border-collapse: collapse;
        }


        .flex {
            display: flex;
            align-items: center;
        }

        .flex h1 {
            /* Rotate from top left corner (not default) */
            /* transform-origin: 0 0; */
            transform: rotate(-90deg);
        }

        .chart {
            width: 900px;
        }

        .txt_xaxis {
            margin-left: 10%;
        }

        .option-item {
            width: 100px;
            border: 1px solid #2d2b2b;
            margin-bottom: 2px;
            cursor: pointer;
        }

        .droppable {
            min-width: 130px !important;
        }

    </style>
@endpush

@push('js')
    <script>

        $("#sortable").sortable({
            connectWith: [".droppable"]
        });

        $(".droppable").sortable({
            cursor: "move",
            connectWith: "#sortable",
            update: function (e, ui) {
                let row = $(this).closest('tr').index();
                let column = $(this).closest('td').index();
                console.log(`row ${row} & column ${column}`);
                /* each restaurant drop in every box so push restaurant Id & name array */
                let restData = [];
                $(this).children().each(function (idx, ele) {
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
            $(document).ready(function () {
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
                    success: function (data) {
                        // console.log(data);
                    }
                });
            });
        }

        function titleCase(str) {
            return str.toLowerCase().split(' ').map(function (word) {
                return (word.charAt(0).toUpperCase() + word.slice(1));
            }).join(' ');
        }

        $(document).ready(function () {
            let records = {!! $records !!}
            records.forEach(function (ele) {
                let point = ele.graph_point;
                let row = (String(point).slice(0, 1)) - 1;
                let col = (String(point).slice(-1)) - 1;
                $('.dragdrop_graph tr').eq(row).children(':eq(' + col + ')').append(
                    '<div data-tag="' + ele.restaurant_id + '" data-name="' + ele.name + '" draggable="true" class="option-item bg-light ui-sortable-handle" style=""><span class="">' + titleCase(ele.name) + '</span></div>');
            })

        });

    </script>

@endpush

@section('content')

    <?php $mimnus_data = $added_restaurant;?>
    <div class="gm2">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"
                     style="padding:40px;box-sizing:border-box">
                    <div class="row mt-9vh">
                        <div class="col-md-4">
                            <div>
                                <div id="sortable" class="" style="min-height: 600px;">
                                    @foreach($restaurants as $restaurant)
                                        @if(!in_array(trim($restaurant->id),$mimnus_data))
                                            <div data-tag="{{$restaurant->id}}" data-name="{{$restaurant->name}}"
                                                 draggable="true"
                                                 class="option-item bg-light">
                                                <span class="">{{Str::title($restaurant->name)}}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="left-side-container">
                                <div class="flex">
                                    <div>
                                        <h1>Price</h1>
                                        <div class="col-md-4">
                                            <select name="" id="y-axis" class="form-control form-control-sm"
                                                    data-type="1">
                                                <option selected>Select Level</option>
                                                @foreach($gType as $item)
                                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="chart">
                                        <table class="dragdrop_graph">
                                            <tr>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                            </tr>
                                            <tr>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                            </tr>
                                            <tr>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                            </tr>
                                            <tr>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                            </tr>
                                            <tr>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                                <td class="empty2 droppable"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-4">
                                        <select name="" id="x-axis" class="form-control form-control-sm" data-type="2">
                                            <option selected>Select Level</option>
                                            @foreach($gType as $item)
                                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <h1 class="txt_xaxis">Level of vertical Integration</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
