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
            border-bottom: 2px solid rgba(0, 0, 0, 0.1);
        }

        .dragdrop_graph td {
            border-left: 2px solid rgba(0, 0, 0, 0.1);
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
        .option-item{
            width: 100px;
            border: 1px solid #2d2b2b;
            margin-bottom: 2px;
        }
        .droppable{
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
                               <?php $tcolor = ['red', 'gray','yellow','green','blue','indigo','purple','pink'];?>
                               <?php $bcolor = ['primary', 'secondary','success','danger','warning','info','light','dark'];?>
                                @foreach($options as $option)
                                    @if(!in_array(trim($loop->index),$mimnus_data))
                                        <?php $i++;?>
                                        <div  data-tag="{{$loop->index}}" data-pay="{{$option}}"
                                            draggable="true" class="option-item bg-{{$bcolor[rand(0,count($bcolor)-1)]}} ">
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
            update: function (e, ui) {
             let x =   $(this).closest('tr').index();
             let y =   $(this).closest('td').index();
                console.log( e.target);
                console.log(`row ${x} & column ${y}`);
            }
        });
    </script>

    <!-- <script>
        const fills = document.querySelectorAll('.fill');
        const empties = document.querySelectorAll('.empty');
        const empties2 = document.querySelectorAll('.empty2');


        //Fil listeners
        for (const fill of fills) {
            // console.log(fill);
            fill.addEventListener('dragstart', dragStart);
            fill.addEventListener('dragend', dragEnd);

        }


        //Loop through empties and all drag events
        for (const empty of empties) {

            empty.addEventListener("dragover", dragOver);
            empty.addEventListener("dragenter", dragEnter);
            empty.addEventListener("dragleave", dragLeave);
            empty.addEventListener("drop", dragDrop);

        }

        // Loop through empties and all drag events
        for (const empty of empties2) {
            console.log(empty);
            empty.addEventListener("dragover", dragOver);
            empty.addEventListener("dragenter", dragEnter);
            empty.addEventListener("dragleave", dragLeave2);
            empty.addEventListener("drop", dragDrop2);

        }

        // Drag Functions
        function dragStart(e) {
            var eventTarget = e.target;
            console.log(eventTarget);
            // console.log(empties);
            console.log("drag start");
            this.className += " hold";
            setTimeout(() => (this.className = "invisible"), 0);
        }

        function dragEnd() {
            console.log("drag end");

            this.className = 'fill';
        }

        function dragOver(e) {
            console.log("drag over");
            e.preventDefault();


        }

        function dragEnter(e) {
            console.log("drag enter");
            e.preventDefault();
            this.className += " hovered";

        }

        function dragLeave() {
            console.log("drag leave");
            this.className = "empty";

        }

        function dragDrop() {
            console.log("drag drop");
            this.className = "empty";
            this.append(fill);

        }


        function dragLeave2() {
            console.log("drag leave");
            this.className = "empty2";

        }

        function dragDrop2() {
            console.log("drag drop" + fills[0]);
            this.className = "empty2";
            this.append(fills[0]);

        }
    </script> -->


</x-app-layout>
