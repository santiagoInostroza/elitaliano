<div>
    <div class="fixed inset-0 bg-gray-600 opacity-90"></div>
    <div class="fixed inset-0 flex justify-center items-center z-10">
        <div class="bg-white shadow rounded">
            
            <div class="p-4 pr-8  relative  text-sm md:text-base">
                @if (isset($header))
                    <div class="text-xl p-4">
                        {{$header}}
                    </div>
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
