<x-guest-layout>

    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-blue-700 to-blue-950 px-4">

        <div class="w-full max-w-md">

            <!-- PCG Branding -->

            <div class="text-center mb-6">

                <div class="flex justify-center mb-4">

                    <div class="bg-yellow-400 rounded-full p-4 shadow-lg">

                        <i class="fas fa-anchor text-blue-900 text-4xl"></i>

                    </div>

                </div>


                <h1 class="text-white text-2xl font-bold tracking-wide">

                    PHILIPPINE COAST GUARD

                </h1>


                <h2 class="text-yellow-400 font-semibold text-lg">

                    Marine Environmental Protection Command

                </h2>


                <p class="text-blue-100 text-sm mt-2">

                    Marine Environmental Protection Integrated Operation System

                </p>

            </div>



            <!-- Login Card -->

            <div class="bg-white rounded-xl shadow-2xl p-8">


                <x-auth-session-status class="mb-4" :status="session('status')" />


                <form method="POST" action="{{ route('login') }}">

                    @csrf


                    <!-- Email -->

                    <div>

                        <x-input-label for="email" value="Email Address" />


                        <x-text-input id="email"
                            class="block mt-1 w-full border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                            type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" />


                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    </div>



                    <!-- Password -->

                    <div class="mt-4">

                        <x-input-label for="password" value="Password" />


                        <x-text-input id="password"
                            class="block mt-1 w-full border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                            type="password" name="password" required autocomplete="current-password" />


                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>




                    <!-- Remember -->

                    <div class="mt-4">

                        <label class="inline-flex items-center">

                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-gray-300 text-blue-700 shadow-sm focus:ring-blue-700">


                            <span class="ms-2 text-sm text-gray-600">

                                Remember me

                            </span>

                        </label>

                    </div>




                    <!-- Button -->

                    <div class="mt-6">


                        <button type="submit"
                            class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-3 rounded-lg shadow-lg transition">

                            <i class="fas fa-sign-in-alt mr-2"></i>

                            Login to PCG MEPIOS


                        </button>


                    </div>



                    @if (Route::has('password.request'))
                        <div class="text-center mt-4">

                            <a href="{{ route('password.request') }}" class="text-sm text-blue-700 hover:text-blue-900">

                                Forgot your password?

                            </a>


                        </div>
                    @endif


                </form>


            </div>



            <!-- Footer -->

            <div class="text-center mt-6 text-blue-100 text-sm">

                <p>

                    Philippine Coast Guard

                </p>

                <p>

                    Marine Environmental Protection Command © {{ date('Y') }}

                </p>

            </div>


        </div>


    </div>


</x-guest-layout>
