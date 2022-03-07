<div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">

   
    @isset($logo)
        <div>
            {{ $logo }}
        </div> 
    @endisset
    

    <div class=" sm:max-w-md px-6 py-4  shadow-md overflow-hidden sm:rounded-lg  backdrop-blur-sm bg-white/30 p-4">
        <div class="text-green-800 text-5xl font-bold tracking-widest mb-4">EL ITALIANO</div>
        {{ $slot }}
    </div>
</div>
