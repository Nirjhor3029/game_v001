<style>
.aside_active{
    color:black;
    font-size: 12px;
}

.aside_text_default{
    color:silver;
    font-size: 12px;
}

    </style>


@foreach(DB::table('tutorials')->get() as $tutorial)


@if(url()->current() == strtolower(url(trim($tutorial->title))))

<div class="row" style="margin-bottom:30px;">
    {{-- <div class="col-md-4">
        <h4>{{$tutorial->title}}</h4>
    </div>
    <div class="col-md-8 aside_active">
        {!! $tutorial->description!!}
    </div> --}}

    <h1 class="aside_title">{{$tutorial->title}}</h1>
    <p class="aside_details">{!! $tutorial->description!!}</p>
</div>

@else 
{{-- <div class="row" style="margin-bottom:30px;">
    <div class="col-md-4">
        <h4>{{$tutorial->title}}</h4>
    </div>
    <div class="col-md-8 aside_text_default">
        {!! $tutorial->description!!}
    </div>
</div> --}}


@endif

@endforeach

