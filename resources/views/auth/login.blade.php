@include('template.header')
<x-guest-layout>

        <section class="w-full h-full px-8 pt-32 xl:px-8 bg-gray-50">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col items-center md:flex-row">

                    <div class="">
                    <x-slot name="logo">
                        <a href="/">
                            
                        </a>
                    </x-slot>    
                        <h2 class="text-2xl font-extrabold leading-none text-black sm:text-3xl md:text-5xl" id="">Changing The Way People.</h2>                        
                    </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="w-full">
                    <div class="relative z-10 h-full py-10 overflow-hidden border-b-2 rounded-lg shadow-2xl px-7 bg-dark ml-3" id="">
                        <h3 class="mb-6 text-2xl font-medium text-center" id="">Masuk untuk melakukan izin</h3>
                        <div class="block mb-4">
                <div class="block mb-4 border border-gray-200 rounded-lg">
                    <input type="email" name="email" id="email" class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" placeholder="Alamat Email" :value="old('email')" required autofocus>
                </div>

                <!-- Password -->
                <div class="block mb-4 border border-gray-200 rounded-lg">
                    <input type="password" name="password" id="password" class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none" placeholder="Password" required autocomplete="current-password">
                </div>

                <!-- Remember Me -->
                {{-- <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                    </label>
                </div> --}}

                <div class="flex items-center justify-center mt-4">                
                    <button class="px-3 py-4 object-center self-auto font-medium text-white bg-blue-600 rounded-lg w-40 hover:shadow-inner transform hover:scale-105 transition ease-out duration-300" id="">Login <i class="fas fa-sign-in-alt"></i></button>                  
                </div>                
            </form>                        
</x-guest-layout>
        <div clas="flex">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-8" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}                        
                </a>
            @endif             --}}
            <p class="text-sm text-gray-600">
            Belum memiliki akun ?
                <a class="underline text-sm text-gray-600 hover:text-blue-500 mt-8 space-x-8" href="{{ route('register') }}">
                    {{ __('Daftar') }}
                </a>
            </p>
        </div>
</section> 
@include('template.footer')
