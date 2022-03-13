<div class="w-full h-full mx-auto   ">
    @if (isset($title) || isset($subtitlle))
        <header class="px-5 py-4 border-b border-gray-100">
    @endif
    @if (isset($title) )
        <h2 class="uppercase tracking-wide ">{{ $title }}</h2>
    @endif
    @if (isset($subtitle))
        {{$subtitle}}
    @endif
    @if (isset($title) || isset($subtitlle))
        </header>
    @endif
   
    <div class=" w-full h-full">
            <div class="overflow-auto  w-full h-full m-auto">
                <table class="table-auto w-full  rounded bg-white">
                    @if (isset($thead))
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            {{ $thead}}
                        </thead>
                    @endif
                    @if (isset($tbody))
                        <tbody class="text-sm divide-y divide-gray-100">
                            {{ $tbody}}               
                        </tbody>
                    @endif
               
                </table>
            </div>
    
    </div>
</div>