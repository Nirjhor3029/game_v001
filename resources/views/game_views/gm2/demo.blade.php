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

/*    $(function () {
        $(".droppable").droppable({
            drop: function (event, ui) {
                // console.log(event.target);
                // console.log(ui);
                $(this)
                    .addClass("ui-state-highlight")
                    .html("Dropped!" + event.target);

            }
        });
    });*/

$(".droppable").sortable({
    cursor: "move",
    connectWith: "#sortable",
    update: function(e, ui) {
        let x = $(this).closest('tr').index();
        let y = $(this).closest('td').index();
        console.log(e.target);
        console.log(`row ${x} & column ${y}`);
        let selected_td = $(this).closest('td');
        if (selected_td.has('.option-item').length > 0) {
            selected_td.css("background-color", "#afce8d");
        } else {
            selected_td.css("background-color", "#ffffff");
        }
        console.log(selected_td.has('.option-item').length);

    }
});
</script>

@endpush

@section('content')

<?php $mimnus_data = array();?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=" overflow-hidden shadow-xl sm:rounded-lg " style="padding:40px;box-sizing:border-box">
            <div class="row bg-white mt-9vh game-content">
                <div class="col-md-4">
                    <div>
                        <div id="sortable" class="" style="min-height: 600px;">
                            <?php $i = 0;?>
                            <?php $tcolor = ['red', 'gray','yellow','green','blue','indigo','purple','pink'];?>
                            <?php $bcolor = ['primary', 'secondary','success','danger','warning','info','light'];?>
                            @foreach($options as $option)
                            @if(!in_array(trim($loop->index),$mimnus_data))
                            <?php $i++;?>
                            <div data-tag="{{$loop->index}}" data-pay="{{$option}}" draggable="true"
                                class="option-item bg-{{$bcolor[rand(0,count($bcolor)-1)]}} ">
                                <span class="">{{Str::title($option)}}</span>
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





@endsection
