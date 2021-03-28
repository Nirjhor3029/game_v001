@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush
@push('js')
    <script>
        $(document).ready(function (e) {


            $(".deleteStudent").on("click", function (e) {
                let that = $(this);
                that.prop("disabled", "true");

                let parent = that.parents(".restaurant_container");
                let studentId = parent.find('.student_name').val();
                let restId = parent.find('.restaurant_select').children("option:selected").val();

                let data = {
                    studentId: studentId,
                    restId: restId,
                };
                $.ajax({
                    type: "POST",
                    url: "delete_student",
                    data: data,
                    success: function (successData) {
                        console.log(successData);
                        toastr.success(successData.success);
                        parent.find('.restaurant_select').prop("disabled", "true");
                        //return;
                        parent.hide();
                    }
                });
                console.log("click");
            });


            $(".setStudent").on("click", function (e) {
                let that = $(this);
                let parent = that.parents(".restaurant_container");
                let studentId = parent.find('.student_name').val();
                let restId = parent.find('.restaurant_select').children("option:selected").val();

                let dataStatus = that.attr("data-status");

                $.ajax({
                    type: "POST",
                    url: "assign_student",
                    data: {
                        studentId: studentId,
                        restId: restId,
                        dataStatus: dataStatus,
                    },
                    success: function (data) {
                        console.log(data);
                        toastr.success(data.success);
                        that.prop("disabled", "true");
                        parent.find('.restaurant_select').prop("disabled", "true");
                        //return;
                    }
                });
            });

        });
    </script>
@endpush
@section('content')


    <div class="gm2">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                    <h5>
                        Please assign one restaurant to every student to represent. You may change your decision by
                        simply clicking on the update button should you wish so. Please note that, to facilitate an
                        engrossing experience for the students, we recommend you to equally divide the restaurants among
                        the students. Thank you.
                    </h5>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-9vh"
                     style="padding:40px;box-sizing:border-box ">

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row" style="margin-bottom: 30px;font-weight:bolder">
                                <div class="col-sm-3">Students</div>
                                <div class="col-sm-2">University Id</div>
                                <div class="col-sm-3">Email</div>
                                <div class="col-sm-2">Restaurent</div>
                                <div class="col-sm-2">Action</div>
                            </div>
                            @foreach($students as $student)
                                <div class="row restaurant_container ">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">{{$student->name}} </label>
                                            <input type="text" value="{{$student->id}}" name="student_id[]" class="student_name student_id"
                                             hidden>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="">{{$student->student_uid}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">{{$student->email}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            @php
                                                $check = false;
                                                $checkStatus = false;
                                            @endphp
                                            <select name="group[]"
                                                    class="form-control form-control-sm  restaurant_select">
                                                <option value="null" selected disabled>Select</option>
                                                @foreach($restaurants as $item)
                                                    <?php
                                                    $item = (object)$item;
                                                    ?>
                                                    @if($student->restaurantUser->isEmpty())
                                                        @php
                                                            $check = false;
                                                        @endphp
                                                        <option value="{{$item->res_id}}">
                                                            {{Str::title($item->res_name)}}
                                                        </option>
                                                    @else
                                                        @php
                                                            $check = ($student->restaurantUser[0]->restaurant_id == $item->res_id);
                                                            if(!$checkStatus){
                                                                $checkStatus = $check;
                                                            }
                                                        @endphp

                                                        <option
                                                            value="{{$item->res_id}}" {{($check)? "selected":""}}>
                                                            {{Str::title($item->res_name)}}
                                                        </option>
                                                        @continue
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="button" name="" value="{{($checkStatus)? 'Update' : 'Set'}}"
                                               class="btn {{($checkStatus)? 'btn-warning' : 'btn-success'}} setStudent"
                                               data-status="{{($checkStatus)? 1 : 2}}">
                                        <input type="button" name="" value="Delete"
                                               class="btn btn-danger deleteStudent">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onclick="location.reload();">Show</button>
                </div>

            </div>
        </div>

        <div class="py-12 mt-5vh">
            <div class="row ">
                @foreach($groupStudents as $key => $item )
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                {{Str::title($restaurants[$key]['res_name'])}}
                                - {{Str::title($restaurants[$key]['group_name'])}}
                            </div>
                            <div class="card-body">
                                <ol>
                                    @foreach($item as $student)
                                        <li>{{Str::title($student['name'])}}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- Attack List Show -->

    </div>
@endsection
