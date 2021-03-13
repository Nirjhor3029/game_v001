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

                            <div class="left-side-container" style="text-align: center;">
                                <h4>Teacher Not Set The Question Yet.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
