<div class="flex flex-col gap-6 text-gray-900 dark:text-gray-100">
    <x-auth-header 
        :title="__('Log in to your account')" 
        :description="__('Enter your email and password below to log in')" 
    />

    <!-- Session Status -->
    <x-auth-session-status 
        class="text-center text-gray-800 dark:text-gray-100" 
        :status="session('status')" 
    />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
            class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md"
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
                class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md"
            />

            @if (Route::has('password.request'))
                <flux:link 
                    class="absolute end-0 top-0 text-sm text-gray-600 dark:text-gray-400 hover:underline" 
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
            class="text-gray-900 dark:text-gray-100"
        />

        <div class="flex items-center justify-end">
            <flux:button 
                variant="primary" 
                type="submit" 
                class="w-full bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-500 text-white font-semibold rounded-md shadow-md transition duration-300 ease-in-out"
            >
                {{ __('Log in') }}
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-gray-800 dark:text-gray-400">
            {{ __('Don\'t have an account?') }}
            <flux:link 
                :href="route('register')" 
                wire:navigate 
                class="text-gray-900 dark:text-gray-300 hover:underline"
            >
                {{ __('Sign up') }}
            </flux:link>
        </div>
    @endif
</div>
