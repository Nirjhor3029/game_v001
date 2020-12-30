<style>
    .aside_active{
        color:black;
        font-size: 12px;
    }
    
    .aside_text_default{
        color:silver;
        font-size: 12px;
    }
    
    /* Timeline-start */
    .history-tl-container{
    font-family: "Roboto",sans-serif;
    width:100%;
    margin:auto;
    display:block;
    position:relative;
    }
    .history-tl-container ul.tl{
        margin:20px 0;
        padding:0;
        display:inline-block;

    }
    .history-tl-container ul.tl li{
        list-style: none;
        margin:auto;
        margin-left:50px;
        
        min-height:50px;
        /*background: rgba(255,255,0,0.1);*/
        border-left:2px dashed #86D6FF ;
        padding:0 0 50px 30px;
        position:relative;
    }
    /* .history-tl-container ul.tl li:last-child{ border-left:0 !important;} */
    .history-tl-container ul.tl li::before{
        position: absolute;
        left: -22px;
        top: -5px;
        content: " ";
        border: 5px solid rgba(255, 255, 255, 0.74);
        border-radius: 500%;
        background: #258CC7;
        height: 40px;
        width: 40px;
        transition: all 500ms ease-in-out;

    }
    .history-tl-container ul.tl li:hover::before{
        border-color:  #258CC7;
        transition: all 1000ms ease-in-out;
        
    }
    ul.tl li .item-title{
    }
    ul.tl li .item-detail{
        color:rgba(0,0,0,0.5);
        font-size:12px;
    }
    ul.tl li .timestamp{
        color: #ffffff;
        position: absolute;
        width: 100px;
        left: -18%;
        text-align: right;
        font-size: 20px;
        font-weight: bold;
    }

    .tl-row{
        margin-left: 10px;
        margin-top: -5px;
        cursor: pointer;
    }
    /* Timeline-end */

</style>
    

<div class="history-tl-container">
    <ul class="tl">
        <?php
            $tutorials = DB::table('tutorials')->orderBy('priority')->get();
        ?>
        @foreach($tutorials as $index => $tutorial)
            @if(url()->current() == strtolower(url(trim($tutorial->title))))
                <div class="row" style="">
                <li class="tl-item {{ ($index >= count($tutorials))? "" : "" }}" ng-repeat="item in retailer_history" style="">
                        <div class="timestamp">
                            {{$index+1}}
                        </div>
                        <div class="tl-row">
                            <div class="item-title">{{$tutorial->title}}</div>
                            <div class="item-detail aside_active">{!! $tutorial->description!!}</div>
                        </div>
                    </li>
                </div>
            
            @else 
                <div class="row" style="">
                    <li class="tl-item" ng-repeat="item in retailer_history">
                        <div class="timestamp">
                            {{$index+1}}
                        </div>
                        <div class="tl-row">
                            <div class="item-title">{{$tutorial->title}}</div>
                            <div class="item-detail aside_active">{!! $tutorial->description!!}</div>
                        </div>
                        
                    </li>
                </div>
            @endif
        @endforeach
    </ul>
    
</div>
    