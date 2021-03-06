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
                    url: "add_user_graph",
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
            let records = @json($rest_groups);
            records.forEach(function (ele) {
                let point = ele.point;
                let row = (String(point).slice(0, 1)) - 1;
                let col = (String(point).slice(-1)) - 1;
                $('.dragdrop_graph tr').eq(row).children(':eq(' + col + ')').append(
                    '<div data-tag="' + ele.id + '" data-name="' + ele.name +
                    '"><span class="">' +
                    titleCase(ele.name) + '</span></div>');
            });
        });
    </script>

@endpush

@section('content')

    <?php $mimnus_data = [];?>
    <div class="gm2">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"
                     style="padding:40px;box-sizing:border-box">

                    <div class="row mt-9vh">
                        <div class="col-md-2">
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

                        <div class="col-md-10">

                            <div class="left-side-container">
                                <div class="row">
                                    <div class="col-sm-4 txt-center">High</div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4"></div>
                                </div>

                                <div class="flex">
                                    <h1> {{ Str::title($level_options[($graph_level->x_level)-1]['name'])}} </h1>

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
                                            <h1> {{ Str::title($level_options[($graph_level->y_level)-1]['name'])}} </h1>
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
                </div>
            </div>
        </div>
    </div>

@endsection
