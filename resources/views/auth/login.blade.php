<x-guest-layout>
    <div class="fixed inset-0 w-screen h-screen flex items-center justify-center z-50 overflow-y-auto" style="background-color: #1B4D3E;">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl overflow-hidden my-auto mx-4">
            
            
            <div class="px-6 py-6 text-center text-white" style="background-color: #1B4D3E;">
                <h2 class="text-xl font-bold tracking-tight">Mr. Mendoza Health Center</h2>
                <p class="text-xs text-emerald-100 mt-1">Sign in to manage clinic dashboard</p>
            </div>

            
            <div class="px-8 py-8">
                
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    
                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Username</label>
                        <input id="email" class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600 text-sm" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    
                    <div>
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Password</label>
                        <input id="password" class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600 text-sm" type="password" name="password" required autocomplete="current-password" placeholder="Enter password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    
                    @if (Route::has('password.request'))
                        <div class="flex justify-end pt-1">
                            <a class="text-xs text-emerald-700 hover:text-emerald-900 underline font-medium" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        </div>
                    @endif

                    
                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-semibold text-white hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition" style="background-color: #1B4D3E;">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>