<div x-data="{show:false}">
    <div x-on:click="show= !show">
        {{$slot}}
    </div>
   
        <div class="hidden" :class="{'hidden': !show}">
            <div class="fixed inset-0 bg-gray-600 opacity-90"></div>
            <div class="fixed inset-0 flex justify-center items-center z-10">
                <div class="bg-white shadow rounded">
                    
                    <div class="p-4 pr-8  relative  text-sm md:text-base">
                        <div x-on:click="show = !show" class="absolute right-0 top-0 p-3 cursor-pointer transform hover:scale-125 hover:bg-gray-200 rounded ">
                            <i class="fas fa-times"></i>
                        </div>
                        @if (isset($header))
                            <h2 class="text-xl p-4">{{$header}}</h2>
                            <hr>
                        @endif
                        @if (isset($body))
                            <div class="p-4">  
                                {{$body}}
                            </div>     
                        @endif
                        @if (isset($footer))
                            <hr>
                            <div class="m-4"> {{$footer}} </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    
    
</div>