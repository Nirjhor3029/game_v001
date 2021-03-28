@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush

@section('content')


    <div class="gm2">
        <div class="py-12 mt-5vh">
            <div class="row ">
                <div class="col-sm-6 col-md-8 col-lg-10 col-xl-12  table-responsive" >
                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Date picker</h3>
              </div>
              <div class="card-body">
                <!-- Date and time range -->
                <div class="form-group">
                  <label>Date and time range:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservationtime">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
                <div class="card-footer">
                  <button class="btn btn-success" id="task1_time">Set Time</button>
                </div>
              <!-- /.card-body -->
            </div>

                </div>
                
            </div>
            <form action="{{route('teacher.attacker_list')}}" method="post">
                @csrf
                <button class="btn btn-success" type="submit">Start Defend</button>
            </form>
        </div>

        <!-- Attack List Show -->
        
    </div>
@endsection

@push('js')
    <script>
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 10,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })


        $('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
            let startDate =  picker.startDate.format('YYYY-MM-DD');
            let endDate =  picker.startDate.format('YYYY-MM-DD');
            
            dt1 = new Date(startDate);
            dt2 = new Date(endDate);
            console.log(diff_minutes(dt1, dt2));
            // console.log(picker.endDate.format('YYYY-MM-DD'));
        });

        function diff_minutes(dt1, dt2) {
            console.log(dt1);
            console.log(dt1.getTime());
            var diff =(dt2.getTime() - dt1.getTime()) / 1000;
            diff /= 60;
            return Math.abs(Math.round(diff));
        } 
    </script>
@endpush
