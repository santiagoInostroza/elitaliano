<div x-data="{show:false}" >
    <style>
        body::-webkit-scrollbar {
            display: none;
        }
        body {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
    <div x-on:click="show= !show">
        {{$slot}}
    </div>
   
        <div class="hidden" :class="{'hidden': !show}">
            <div class="fixed inset-0 bg-gray-600 opacity-90"></div>
            <div class="fixed inset-4 bg-white shadow rounded overflow-auto z-10" >
               
                <div x-on:click="show = !show" class="absolute  right-0 top-0 p-4 cursor-pointer">
                    <i class="fas fa-times"></i>
                </div>
                <div class="p-4  text-sm md:text-base" >
                    @if (isset($header))
                        <h2 class="text-xl">{{$header}}</h2>
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