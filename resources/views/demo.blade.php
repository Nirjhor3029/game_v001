<x-app-layout>
    <style>

        .fill {
            /* background-image: url('https://source.unsplash.com/random/150x150');
            position: relative;
            height: 150px;
            width: 150px;
            top: 5px;
            left: 5px;
            cursor: pointer; */
        }

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

        .dragdrop_graph tr {
            /* border-bottom: 2px solid rgba(0, 0, 0, 0.1);*/
        }

        .dragdrop_graph td {
            /* border-left: 2px solid rgba(0, 0, 0, 0.1);*/
            width: 30px;
        }

        .dragdrop_graph tr:last-child {
            /* border-bottom: none; */
        }

        .dragdrop_graph td:last-child {
            border-right: none;
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
        }

        .droppable {
            min-width: 130px !important;
        }
    </style>
    <?php $mimnus_data = array();?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <div id="sortable" class="" style="min-height: 600px;">
                                <?php $i = 0;?>
                                <?php $tcolor = ['red', 'gray', 'yellow', 'green', 'blue', 'indigo', 'purple', 'pink'];?>
                                <?php $bcolor = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];?>
                                @foreach($options as $option)
                                    @if(!in_array(trim($option->id),$mimnus_data))
                                        <?php $i++;?>
                                        <div data-tag="{{$option->id}}" data-name="{{$option->name}}"
                                             draggable="true"
                                             class="option-item bg-{{$bcolor[rand(0,count($bcolor)-1)]}} ">
                                            <span class="">{{Str::title($option->name)}}</span>
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
                            <h1 class="txt_xaxis">Level of vertical Integration</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

                let data = {graphPointRow: graphPointRow, graphPointColumn: graphPointColumn, restData: restData};
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

        

        $(document).ready(function () {
            console.log('dfds')
            let c = $('.dragdrop_graph tr').eq(1).children(':eq(3)').append(' <span class="">robin</span>');
            console.dir(c)

        });

    </script>
</x-app-layout>
