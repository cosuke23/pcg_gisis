<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#001f3f] via-[#003366] to-[#00111f]">

    <div class="absolute inset-0 bg-[url('/images/ocean-bg.jpg')] bg-cover bg-center opacity-20"></div>


    <div class="relative w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-6">

            <img 
                src="{{ \App\Support\ClaudePane::logo() }}"
                class="mx-auto w-32 h-32 object-contain drop-shadow-lg"
            >

            <h1 class="mt-4 text-2xl font-bold text-white">
                Philippine Coast Guard
            </h1>

            <h2 class="text-yellow-400 font-semibold tracking-wide">
                Maritime Environmental Protection Command
            </h2>

            <p class="text-blue-200 text-sm mt-2">
                Environmental Information System
            </p>

        </div>


        <!-- Login Card -->
        <div class="bg-white/95 backdrop-blur rounded-xl shadow-2xl p-8">


            <x-auth-session-status 
                class="mb-4" 
                :status="session('status')" 
            />


            <form method="POST" action="{{ route('login') }}">

                @csrf


                <!-- Email -->
                <div>

                    <x-input-label 
                        for="email"
                        value="Email Address"
                    />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full border-gray-300 focus:border-[#003366] focus:ring-[#003366]"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                    />

                    <x-input-error 
                        :messages="$errors->get('email')" 
                        class="mt-2"
                    />

                </div>



                <!-- Password -->

                <div class="mt-4">

                    <x-input-label 
                        for="password"
                        value="Password"
                    />


                    <x-text-input

                        id="password"

                        class="block mt-1 w-full border-gray-300 focus:border-[#003366] focus:ring-[#003366]"

                        type="password"

                        name="password"

                        required

                    />


                    <x-input-error 
                        :messages="$errors->get('password')" 
                        class="mt-2"
                    />


                </div>



                <!-- Remember -->

                <div class="mt-4">

                    <label class="inline-flex items-center">

                        <input 
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-[#003366] shadow-sm"
                        >

                        <span class="ml-2 text-sm text-gray-600">
                            Remember me
                        </span>

                    </label>

                </div>



                <!-- Button -->

                <div class="mt-6">

                    <button

                        type="submit"

                        class="w-full bg-[#003366] hover:bg-[#002244] text-white font-bold py-3 rounded-lg shadow-lg transition duration-300"

                    >

                        <i class="fas fa-sign-in-alt"></i>

                        Login to MEPCOM System

                    </button>


                </div>


            </form>


        </div>



        <!-- Footer -->

        <div class="text-center mt-6 text-blue-200 text-sm">

            <p>
                Philippine Coast Guard
            </p>

            <p>
                Maritime Environmental Protection Command
            </p>

            <p class="mt-2 text-yellow-400">
                Protecting Philippine Waters
            </p>

        </div>


    </div>


</div>


</x-guest-layout>