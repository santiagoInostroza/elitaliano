<div>
    <style>
        body::-webkit-scrollbar {
            display: none;
        }
        body {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>   
    <div>
        <div class="fixed inset-0 bg-gray-600 opacity-90"></div>
        <div class="fixed inset-4 bg-white shadow rounded overflow-auto z-10 " >
            <div class="p-4 text-sm md:text-base" >
                @if (isset($header))
                    <div class="text-xl">{{$header}}</div>
                    <hr>
                @endif
                @if (isset($body))
                    <div class="">  
                        {{$body}}
                    </div>     
                @endif
                @if (isset($footer))
                    <hr>
                    <div class=""> {{$footer}} </div>
                @endif
            </div>
        </div>
    </div>
</div>