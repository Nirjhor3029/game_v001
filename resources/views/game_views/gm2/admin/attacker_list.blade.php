@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush
@push('js')

@endpush
@section('content')


    <div class="gm2">
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                    <h5>
                    Students cannot continue the next stage of the game unless you allow them to start defending their own market share. 
                    </h5>
                </div>
            </div>
        </div>
        <div class="py-12 bg-white">
            <div class="row ">
                <div class="col-sm-6 col-md-8 col-lg-10 col-xl-12  table-responsive" >
                   

                   
                    <table class="table ">
                            <thead >
                                <tr>
                                    <th>Defender</th>
                                    <th>Attackers</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($defendList as  $item )
                                    <tr>
                                        <td>
                                            {{Str::title($item['defender_name'])}} 
                                            
                                                <span class="badge badge-secondary">
                                                    {{Str::title($studentInfo[$item['defender']]['rest_name'])}}
                                                </span>
                                                
                                            
                                        </td>
                                        <td>
                                                @php $attackers = $item['attackers_name']; @endphp
                                                @if(!is_null($attackers))
                                                    @foreach($attackers  as $key => $attacker)
                                                        <p>
                                                            {{Str::title($attacker)}}
                                                            <span class="badge badge-secondary">
                                                                {{Str::title($studentInfo[$item['attacker'][$key]]['rest_name'])}}
                                                            </span>
                                                        </p>
                                                    @endforeach
                                                @else
                                                    <p>No Attackers</p>
                                                @endif    
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2"><h4 style="text-align: center;">No Defenders</h4></td>
                                    </tr>
                                
                                @endforelse
                            </tbody>
                    </table>

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
