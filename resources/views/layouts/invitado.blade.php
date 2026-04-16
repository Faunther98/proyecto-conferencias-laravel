
 <!-- ESTE LAYOUT ES PARA  LA HOMEPAGE PARA LOS INVITADOS YA QUE EL GUEST ANTERIOR ERA 
UN LOGIN CHICO CENTRADO  -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos UNAM - Inicio</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <nav x-data="{ open: false }" class="bg-primario-500 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block h-9 w-auto text-white fill-current" />
                        </a>
                    </div>

                    <div class="hidden space-x-2 sm:-my-px sm:ms-10 lg:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white border-white">
                            {{ __('Inicio') }}
                        </x-nav-link>
                        <x-nav-link :href="route('creditos')" :active="request()->routeIs('creditos')" class="text-white border-transparent">
                            {{ __('Créditos') }}
                        </x-nav-link>
                    </div>
                </div>

            <div class="hidden lg:flex lg:items-center lg:ms-6 space-x-4">
                <a href="{{ route('login') }}" class="text-white text-sm font-bold hover:underline">
                    Ingresar
                </a>
    
                 @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-white text-primario-600 px-4 py-2 rounded-lg font-bold text-sm shadow">
                    Registrarse
                </a>
                @endif
            </div>

                <div class="-me-2 flex items-center lg:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-primario-400">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white">
                    {{ __('Inicio') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('creditos')" :active="request()->routeIs('creditos')" class="text-white">
                    {{ __('Créditos') }}
                </x-responsive-nav-link>
            </div>
        <div class="pt-4 pb-1 border-t border-primario-400">
            <div class="space-y-1">
            <x-responsive-nav-link :href="route('login')" class="text-white">Ingresar</x-responsive-nav-link>
        
            @if (Route::has('register'))
            <x-responsive-nav-link :href="route('register')" class="text-white font-bold">Registrarse</x-responsive-nav-link>
            @endif
    </div>
</div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>