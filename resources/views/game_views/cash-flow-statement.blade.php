<x-app-layout>
    @include('partials.subnavbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">


                <div class="row">
                    <div class="col-md-5">
                        {{-- @include('partials.aside')  --}}

                        <h1 class="aside_title">Cash flow statement</h1>
                        <p class="aside_details">You need to make a cash flow statement, and profit and loss statement
                            from the table. To make it perfect please choose from the list</p>

                    </div>
                    <div class="col-md-7">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="left-side-container">

                                    <div
                                        style="background-color: #002060;margin-bottom: 5px;padding: 5px 10px;margin-bottom:5px;">
                                        <p style="padding: 0px; color: white;margin: 0px;">Cash from customer</p>
                                    </div>
                                    <div class="" style=";width:100%;border:1px solid rgb(224, 224, 224);">
                                        <ul id="revenue" class="revinew_left_list" style="height:190px;overflow-y:auto" data-id="1">
                                            <?php $mimnus_data = array();?>
                                            @if(!is_null($revenueData))
                                                @foreach($revenueData as $ree)
                                                    <li data-tag="{{$ree->title}}"
                                                        data-pay="{{$ree->value}}"> {{$ree->title}} <span
                                                            style="float: right">{{$ree->value}} BDT</span></li>
                                                    <?php $mimnus_data[] = $ree->title;?>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                    <p style="background-color:#F4F5F7;margin-top:5px;padding:5px;">Total Net Revenue
                                        <span id="total_revenues" style="float:right;font-weight:bold">{{$total_revenue}} BDT</span>
                                    </p>


                                    {{-- All Expenses --}}

                                    {{-- Cash for operating Expenses --}}
                                    <div
                                        style="background-color: #002060;margin-bottom: 5px;padding: 5px 10px;margin-bottom:5px;margin-top:30px;">
                                        <p style="padding: 0px; color: white;margin: 0px;">Cash for operating
                                            Expenses</p>
                                    </div>
                                    <div class="" style=";width:100%;border:1px solid rgb(224, 224, 224);">
                                        <ul id="cash_operating_expenses" class="revinew_left_list" data-id="2"
                                            style="height:190px;overflow-y:auto">

                                            @if(!is_null($expensesData))
                                                @foreach($expensesData as $ree)
                                                    <li data-tag="{{$ree->title}}"
                                                        data-pay="{{$ree->value}}"> {{$ree->title}} <span
                                                            style="float: right">{{$ree->value}} BDT</span></li>
                                                    <?php $mimnus_data[] = $ree->title;?>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                    {{-- Cash to suppliers --}}
                                    <div
                                        style="background-color: #002060;margin-bottom: 5px;padding: 5px 10px;margin-bottom:5px;margin-top:30px;">
                                        <p style="padding: 0px; color: white;margin: 0px;">Cash to suppliers</p>
                                    </div>
                                    <div class="" style=";width:100%;border:1px solid rgb(224, 224, 224);">
                                        <ul id="cash_to_suppliers" class="revinew_left_list" data-id="3"
                                            style="height:190px;overflow-y:auto">

                                            {{-- @if(!is_null($expensesData))
                                                @foreach($expensesData as $ree)
                                                    <li data-tag="{{$ree->title}}"
                                                        data-pay="{{$ree->value}}"> {{$ree->title}} <span
                                                            style="float: right">{{$ree->value}} BDT</span></li>
                                                    <?php $mimnus_data[] = $ree->title;?>
                                                @endforeach
                                            @endif --}}
                                        </ul>
                                    </div>


                                    {{-- Cash for interest --}}
                                    <div
                                        style="background-color: #002060;margin-bottom: 5px;padding: 5px 10px;margin-bottom:5px;margin-top:30px;">
                                        <p style="padding: 0px; color: white;margin: 0px;">Cash for interest</p>
                                    </div>
                                    <div class="" style=";width:100%;border:1px solid rgb(224, 224, 224);">
                                        <ul id="cash_for_interest" class="revinew_left_list" data-id="4"
                                            style="height:190px;overflow-y:auto">

                                            {{-- @if(!is_null($expensesData))
                                                @foreach($expensesData as $ree)
                                                    <li data-tag="{{$ree->title}}"
                                                        data-pay="{{$ree->value}}"> {{$ree->title}} <span
                                                            style="float: right">{{$ree->value}} BDT</span></li>
                                                    <?php $mimnus_data[] = $ree->title;?>
                                                @endforeach
                                            @endif --}}
                                        </ul>
                                    </div>

                                    {{-- Cash for Taxes --}}
                                    <div
                                        style="background-color: #002060;margin-bottom: 5px;padding: 5px 10px;margin-bottom:5px;margin-top:30px;">
                                        <p style="padding: 0px; color: white;margin: 0px;">Cash for Taxes</p>
                                    </div>
                                    <div class="" style=";width:100%;border:1px solid rgb(224, 224, 224);">
                                        <ul id="cash_for_taxes" class="revinew_left_list" data-id="5"
                                            style="height:190px;overflow-y:auto">

                                            {{-- @if(!is_null($expensesData))
                                                @foreach($expensesData as $ree)
                                                    <li data-tag="{{$ree->title}}"
                                                        data-pay="{{$ree->value}}"> {{$ree->title}} <span
                                                            style="float: right">{{$ree->value}} BDT</span></li>
                                                    <?php $mimnus_data[] = $ree->title;?>
                                                @endforeach
                                            @endif --}}
                                        </ul>
                                    </div>
                                    <p style="background-color:#F4F5F7;margin-top:5px;padding:5px;">Total Expenses <span
                                            id="total_expenses" style="float:right;font-weight:bold">{{$total_expenses}} BDT</span>
                                    </p>

                                    <p style="background-color:#0070C0;margin-top:5px;padding:5px;font-weight:bold;color:white">
                                        Net Cash flow <span id="net_income" style="float:right;font-weight:bold">{{$total_income}} BDT</span>
                                    </p>


                                </div>

                            </div>
                           {{-- right side statement list--}}
                            <div class="col-md-6">
                                {{-- {{dd($mimnus_data)}} --}}
                                <div style="padding:5px;background-color:#F4F5F7;" class="">
                                    <ul id="sortable" class="revinew_right_list" style="min-height: 600px;">
                                        <?php $i = 0;?>
                                        @foreach($options as $option)
                                            @if(!in_array(trim($option->title),$mimnus_data))
                                                <?php $i++;?>
                                                <li data-tag="{{$option->title}}"
                                                    data-pay="{{$option->value}}"> {{$option->title}} <span
                                                        style="float: right">{{$option->value}} BDT</span></li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $("#sortable").sortable({
            connectWith: ["#revenue", "#cash_for_taxes","#cash_for_interest","#cash_to_suppliers","#cash_operating_expenses"]
        });

        var in_total = 0;
        var in_revenue = 0;
        var in_expense = 0;
        $("#revenue, #cash_operating_expenses, #cash_to_suppliers, #cash_for_interest, #cash_for_taxes").sortable({
            connectWith: "#sortable",
            update: function (e, ui) {
                let index_id = $(this).attr('id'); /* get attribute id name */
                let data_id = $(this).data('id'); /* get attribute data id */
                var resultData = [];
                var total_revenues = 0;
                $('#'+index_id).children().each(function (idx, val) {
                    var result = {
                        'tag': $(val).data('tag'),
                        'pay': parseFloat($(val).data('pay')),
                    }
                    total_revenues += parseFloat($(val).data('pay'));
                    resultData.push(result);
                });

                let totalData = calculateData(data_id, total_revenues);
                sendRevenues(data_id, index_id, resultData, totalData);
                $("#total_revenues").html(totalData.revenue + " BDT");
                $("#total_expenses").html(totalData.expense + " BDT");
                $("#net_income").html(totalData.total + " BDT");

            }
        });
        var expense = new Map();
        function calculateData(id, total){
            if(id === 1){
                in_revenue = total;
            }else{
                expense[id] = total;
                in_expense = sum(expense);
            }

            function sum( obj ) {
                var e = 0;
                for( var el in obj ) {
                    if( obj.hasOwnProperty( el ) ) {
                        e += parseFloat( obj[el] );
                    }
                }
                return e;
            }
            return {
                'revenue': in_revenue,
                'expense': in_expense,
                'total': in_revenue - in_expense,
            };
        }

        function sendRevenues(dataId, indexId, sendData, total_revenues) {
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let data = {dataId:dataId ,id:indexId, sendData: sendData, totalreview: total_revenues};
                $.ajax({
                    type: "POST",
                    url: "add_cash_flow",
                    data: data,
                    success: function (data) {
                        console.log(data);
                    }
                });

            });

        }
    </script>

</x-app-layout>
