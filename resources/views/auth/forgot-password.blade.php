<x-guest-layout>
    <div class="fixed inset-o">
        <figure>
            <img  class="w-full h-full object-cover "  src="{{asset('images/cover_page/paltas.jpg')}}" alt="">
        </figure>
    </div>
    <div class="absolute inset-0 flex justify-center items-center">
        <div class="">
            <x-jet-authentication-card>
                {{-- <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot> --}}

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('¿Olvidaste tu contraseña? No hay problema. Ingresa tu email y te enviaremos un enlace de restablecimiento de contraseña que te permitirá elegir una nueva.') }}
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="block">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button>
                            {{ __('ENLACE DE RESTABLECIMIENTO DE EMAIL') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
        </div>
    </div>
</x-guest-layout>
