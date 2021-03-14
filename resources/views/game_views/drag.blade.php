<x-app-layout>


    @include('partials.subnavbar')

    <?php $mimnus_data = array();?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">


                <div class="row">
                    <div class="col-md-4">
                        <div style="padding:5px;background-color:#F4F5F7;" class="">
                            <ul id="sortable" class="revinew_right_list empty" style="min-height: 600px;">
                                <?php $i = 0;?>
                                @foreach($options as $option)
                                    @if(!in_array(trim($option->title),$mimnus_data))
                                        <?php $i++;?>
                                        <li data-tag="{{$option->title}}" data-pay="{{$option->value}}" class="fill"
                                            draggable="true">
                                            {{$option->title}} <span style="float: right">{{$option->value}} BDT</span>
                                        </li>
                                    @endif
                                @endforeach


                            </ul>
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
                                            <td class="empty2 droppable">
                                                <ul>
                                                    <li>kacchi</li>
                                                </ul>
                                            </td>
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

        $(function () {
            $(".droppable").droppable({
                drop: function (event, ui) {
                    // console.log(event.target);
                    // console.log(ui);
                    $(this)
                        .addClass("ui-state-highlight")
                        .html("Dropped!" + event.target);
                }
            });
        });

        $(".droppable").sortable({
            cursor: "move",
            connectWith: "#sortable",
            update: function (e, ui) {
                console.log(e);
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
