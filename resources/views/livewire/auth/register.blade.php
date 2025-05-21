<div class="flex flex-col gap-6 text-gray-900 dark:text-gray-100">
    <x-auth-header 
        :title="__('Create an account')" 
        :description="__('Enter your details below to create your account')" 
    />

    <!-- Session Status -->
    <x-auth-session-status 
        class="text-center text-gray-800 dark:text-gray-100" 
        :status="session('status')" 
    />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
            class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
            class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable
            class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
            viewable
            class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700"
        />

        <div class="flex items-center justify-end">
            <flux:button
                type="submit"
                variant="primary"
                class="w-full bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-500 text-white font-semibold rounded-md shadow-md transition duration-300 ease-in-out"
            >
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-gray-800 dark:text-gray-400">
        {{ __('Already have an account?') }}
        <flux:link 
            :href="route('login')" 
            wire:navigate 
            class="text-gray-900 dark:text-gray-300 hover:underline"
        >
            {{ __('Log in') }}
        </flux:link>
    </div>
</div>
