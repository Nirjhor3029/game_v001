@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-12">


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Manage</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{-- {{ $user->name }} --}}
                                </td>
                                <td>
                                    <a class="btn btn-app" href="{{ route('gm2.admin.user_manage', ['id' => 1]) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Manage</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    <script>
        // $(function () {
        //     $("#example1").DataTable({
        //         "responsive": true,
        //         "lengthChange": false,
        //         "autoWidth": false,
        //         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //     $('#example2').DataTable({
        //         "paging": true,
        //         "lengthChange": false,
        //         "searching": false,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false,
        //         "responsive": true,
        //     });
        // });
    </script>
@endsection

@push('js')

@endpush
