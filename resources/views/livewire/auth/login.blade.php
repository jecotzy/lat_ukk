<div class="relative bg-gradient-to-br from-gray-900/90 via-gray-900/80 to-gray-900/90 p-10 rounded-3xl shadow-2xl max-w-md w-full mx-auto text-gray-100 overflow-hidden">
    <!-- Blur floating circles inside card -->
    <div class="absolute top-1/4 left-1/4 w-36 h-36 bg-blue-500/20 rounded-full filter blur-2xl animate-float-slow opacity-25 pointer-events-none"></div>
    <div class="absolute bottom-1/3 right-1/4 w-44 h-44 bg-purple-500/20 rounded-full filter blur-2xl animate-float-medium opacity-25 pointer-events-none"></div>

    <div class="text-center mb-2">
        <h3 class="text-4xl md:text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400 mb-2 leading-relaxed">
            {{ __('Log in to your account') }}
        </h3>
        <p class="text-base text-gray-400 max-w-xl mx-auto">
            {{ __('Enter your email and password below to log in') }}
        </p>

    </div>


    <!-- Session Status -->
    <x-auth-session-status 
        class="relative z-10 text-center text-gray-300 mb-2" 
        :status="session('status')" 
    />

    <form wire:submit="login" class="relative z-10 flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
            class="bg-gray-800 text-gray-100 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
                class="bg-gray-800 text-gray-100 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />

            @if (Route::has('password.request'))
                <flux:link 
                    class="absolute right-0 top-0 text-sm text-blue-400 hover:text-blue-300 hover:underline transition-colors" 
                    :href="route('password.request')" 
                    wire:navigate
                >
                    {{ __('Forgot your password?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox 
            wire:model="remember" 
            :label="__('Remember me')" 
            class="text-gray-300"
        />

        <div class="flex items-center justify-end">
            <flux:button 
                variant="primary" 
                type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:ring-blue-400 text-white font-semibold rounded-lg shadow-lg transition duration-300 ease-in-out"
            >
                {{ __('Log in') }}
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="relative z-10 space-x-1 rtl:space-x-reverse text-center text-sm text-gray-400 mt-8">
            {{ __("Don't have an account?") }}
            <flux:link 
                :href="route('register')" 
                wire:navigate 
                class="text-blue-400 hover:text-blue-300 hover:underline transition-colors"
            >
                {{ __('Sign up') }}
            </flux:link>
        </div>
    @endif
</div>
