<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <h3 class="text-center">Table 2</h3>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" colspan="4" class="text-center">Cost of Additional Outlet with
                                    everything as it is <br>(in millions)
                                </th>
                                <th scope="col" colspan="4" class="text-center">Cost per outlet for offering a new
                                    line
                                    of product / change the quality within the existing setup
                                    <br>(in millions)
                                </th>
                            </tr>
                            <tr>
                                <th>Type/Area</th>
                                <th>Tri state Areas</th>
                                <th>Mid end Area</th>
                                <th>Low end Areas</th>
                                <th>Type/Quality</th>
                                <th>High</th>
                                <th>Mid</th>
                                <th>Low</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Continental/Intl Chain</th>
                                <td>10</td>
                                <td>8</td>
                                <td>6</td>
                                <th scope="row">Continental/Intl Chain</th>
                                <td>2</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Fast Food</th>
                                <td>5</td>
                                <td>4</td>
                                <td>3</td>
                                <th scope="row">Fast Food</th>
                                <td>1.5</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Coffee/Bistro</th>
                                <td>3</td>
                                <td>2</td>
                                <td>1</td>
                                <th scope="row">Coffee/Bistro</th>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Desi</th>
                                <td>4</td>
                                <td>3</td>
                                <td>2</td>
                                <th scope="row">Desi</th>
                                <td>1</td>
                                <td>0.5</td>
                                <td>0.5</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <h4>Use the template provided in table 2 to complete table 3 for your restaurant and wait for your
                        competitor(s) to make a move!
                    </h4>
                </div>


                <div class="col-md-4" style="border: 2px solid black">
                    <h5>Star Kabab</h5>
                    <br>
                    @php $costs = DB::table('costs')->where('parent_id',0)->get(); @endphp
                    <x-jet-label for="category" value="{{ __('Type') }}"/>
                    <select class="form-select block mt-1" name="category" id="category">
                        <option selected>Select Areas</option>
                        @foreach ($costs as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <x-jet-label for="subcategory" value="{{ __('Sub Type') }}"/>
                    <select class="form-select block mt-1" name="subcategory" id="subcategory">

                    </select>
                    <span id="cost_value"></span>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $('#category').on('change', function (e) {
                                let cat_id = e.target.value;
                                $.ajax({
                                    type: "POST",
                                    url: "subcat",
                                    data: {
                                        cat_id: cat_id
                                    },
                                    success: function (data) {
                                        //  console.log(data);return;
                                        $('#subcategory').empty();
                                        $('#subcategory').append(
                                            '<option selected>Select type</option>');
                                        $.each(data.subcategories[0].sub_costs, function (index,
                                                                                          subcategory) {
                                            $('#subcategory').append(
                                                '<option data-cost="' + subcategory
                                                    .value + '" value="' + subcategory
                                                    .id + '">' + subcategory.name +
                                                '</option>');
                                        })

                                    }
                                })
                            });
                            $('#subcategory').on('change', function (e) {
                                let cost = $(this).find(':selected').data('cost')
                                $('#cost_value').text(cost);
                            });
                        });
                    </script>

                </div>

                <div class="row">
                    <div class="col-md-10">
                        <h3 class="text-center">Table 3</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="row">Target Group Members</th>
                                <th scope="row">New Outlets</th>
                                <th scope="row">Expenditure for establishing new Outlets</th>
                                <th scope="row">Expenditure for offering new range of product</th>
                                <th scope="row" colspan="2">Marketing & Promotion Budget</th>
                                <th>Reserve for Competitor’s future move</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Discount within store</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Discount through Delivery services</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Advertising through social media</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Branding</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Others</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
