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
       
        <div class="fixed inset-0 z-10 bg-gray-300 " >
            <div class="text-sm md:text-base max-h-screen " >
                @if (isset($header))
                    <div class="">{{$header}}</div>
                    <hr>
                @endif
                @if (isset($body))
                    <div class="">  
                        {{$body}}
                    </div>     
                @endif
                @if (isset($footer))
                    <hr>
                    <div class="w-full"> {{$footer}} </div>
                @endif
            </div>
        </div>
    </div>
</div>