<x-app-layout>
    <?php
    $previousUrl = "/revenue-other";
    $nextUrl = "/cash-flow-statements";
    ?>
    @section('nextUrl',$nextUrl)
    @section('previousUrl',$previousUrl)

    @include('partials.subnavbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">

                <div class="row">
                    <div class="col-md-5">
                        {{-- @include('partials.aside')  --}}
                        <div class="row" style="margin-bottom:30px;">
                            <h1 class="aside_title">Financial statements</h1>
                            <p class="aside_details">
                                You need to make a cash flow statement, and profit and loss statement from the table. To
                                make it perfect please choose from the list.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-7">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="left-side-container">

                                    <div
                                        style="background-color: #002060;margin-bottom: 5px;padding: 5px 10px;margin-bottom:5px;">
                                        <p style="padding: 0px; color: white;margin: 0px;">Revenue</p>
                                    </div>
                                    <div class="" style="width:100%;border:1px solid rgb(224, 224, 224);">
                                        <ul id="revenue" class="revinew_left_list" style="height:230px;overflow-y:auto">
                                            <?php $mimnus_data = array();?>
                                            @if(!is_null($revenueData))
                                                @foreach($revenueData as $ree)
                                                    <li data-tag="{{$ree->title}}"
                                                        data-pay="{{$ree->value}}"> {{$ree->title}}
                                                        <span style="float: right">{{$ree->value}} BDT</span></li>
                                                    <?php $mimnus_data[] = $ree->title;?>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                    <p style="background-color:#F4F5F7;margin-top:5px;padding:5px;">Total Net Revenue
                                        <span id="total_revenues"
                                              style="float:right;font-weight:bold">{{$total_revenue}} BDT</span>
                                    </p>


                                    <div
                                        style="background-color: #002060;margin-bottom: 5px;padding: 5px 10px;margin-bottom:5px;margin-top:30px;">
                                        <p style="padding: 0px; color: white;margin: 0px;">Expenses</p>
                                    </div>
                                    <div class="" style="width:100%;border:1px solid rgb(224, 224, 224);">
                                        <ul id="expenses" class="revinew_left_list"
                                            style="height:230px;overflow-y:auto">

                                            @if(!is_null($expensesData))
                                                @foreach($expensesData as $ree)
                                                    <li data-tag="{{$ree->title}}"
                                                        data-pay="{{$ree->value}}"> {{$ree->title}}
                                                        <span style="float: right">{{$ree->value}} BDT</span></li>
                                                    <?php $mimnus_data[] = $ree->title;?>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <p style="background-color:#F4F5F7;margin-top:5px;padding:5px;">Total Expenses <span
                                            id="total_expenses" style="float:right;font-weight:bold">{{$total_expenses}}
                                            BDT</span>
                                    </p>

                                    <p
                                        style="background-color:#0070C0;margin-top:5px;padding:5px;font-weight:bold;color:white">
                                        Net Income <span id="netincome_result"
                                                         style="float:right;font-weight:bold">{{$total_income}} BDT</span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">

                                {{-- {{dd($mimnus_data)}} --}}

                                <div style="padding:5px;background-color:#F4F5F7;" class="">
                                    <ul id="sortable" class="revinew_right_list" style="min-height: 600px;">
                                        <?php $i = 0;?>
                                        @foreach($options as $option)
                                            @if(!in_array(trim($option->title),$mimnus_data))
                                                <?php $i++;?>
                                                <li data-tag="{{$option->title}}" data-pay="{{$option->value}}">
                                                    {{$option->title}} <span
                                                        style="float: right">{{$option->value}} BDT</span>
                                                </li>
                                            @endif
                                        @endforeach
                                        <?php $i = 0;?>
                                        @foreach($options_dynamic as $key => $val)
                                            @if(!in_array(trim($key),$mimnus_data))
                                                <?php $i++;?>
                                                <li data-tag="{{$key}}" data-pay="{{$val}}"> {{ucfirst($key)}} <span
                                                        style="float: right">{{$val}} BDT</span></li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>

                                <a class="btn btn-primary float-right" href="{{url('cash-flow-statements')}}"
                                   style="margin-top:50px;">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#sortable").sortable({
            connectWith: ["#revenue", "#expenses"]
        });

        var netincome = 0;
        var net_total_rev = 0;
        var net_total_exp = 0;

        $("#revenue").sortable({
            connectWith: "#sortable",
            update: function (e, ui) {
                //var revenue = $("#revenue").sortable('serialize').toString();
                var resultData = [];
                var total_revenues = 0;
                $("#revenue").children().each(function (idx, val) {
                    var result = {
                        'tag': $(val).data('tag'),
                        'pay': parseFloat($(val).data('pay')),
                    }
                    total_revenues += parseFloat($(val).data('pay'));
                    resultData.push(result);
                });

                sendRevenues(resultData, total_revenues);
                $("#total_revenues").html(total_revenues + " BDT");
                net_total_rev = total_revenues;
                netincome = net_total_rev - net_total_exp;
                $("#netincome_result").html(netincome + " BDT");

            }
        });


        function sendRevenues(senddata, total_revenues) {
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = {
                    sendData: senddata,
                    totalreview: total_revenues
                };
                $.ajax({
                    type: "POST",
                    url: "add-revenues",
                    data: data,
                    success: function (data) {
                        console.log(data);
                    }
                });

            });

        }


        //'grand-total':parseFloat($(val).data('grandtotal'))


        $("#expenses").sortable({
            cursor: "move",
            connectWith: "#sortable",
            update: function (e, ui) {
                //var revenue = $("#revenue").sortable('serialize').toString();
                var resultExpensesData = [];
                var total_expenses = 0;
                $("#expenses").children().each(function (idx, val) {
                    var resultEx = {
                        'tag': $(val).data('tag'),
                        'pay': parseFloat($(val).data('pay')),
                    }
                    total_expenses += parseFloat($(val).data('pay'));
                    resultExpensesData.push(resultEx);
                });
                sendExpenses(resultExpensesData, total_expenses);
                $("#total_expenses").html(total_expenses + " BDT");
                net_total_exp = total_expenses;
                netincome = net_total_rev - net_total_exp;
                $("#netincome_result").html(netincome + " BDT");
            }
        });


        function sendExpenses(senddata, total_revenues) {
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = {
                    sendData: senddata,
                    totalreview: total_revenues
                };
                $.ajax({
                    type: "POST",
                    url: "add-expenses",
                    data: data,
                    success: function (data) {
                        console.log(data);
                    }
                });

            });

        }
    </script>

</x-app-layout>
