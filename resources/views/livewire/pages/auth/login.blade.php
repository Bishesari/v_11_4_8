<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.logreg')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="sm:w-96 w-80">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Form Title -->
    <h1 class="text-center font-semibold my-2">{{__('فرم ورود')}}</h1>

    <!-- Form Body -->
    <div class="border py-8 px-6 rounded-md">
        <form wire:submit="login">
            <!-- User Name -->
            <x-input.flt-lbl name="form.user_name" label="نام کاربری:" style="direction: ltr" autofocus  maxlength="20"/>
            <!-- Password -->
            <x-input.flt-lbl name="form.password" label="کلمه عبور:" style="direction: ltr" type="password" maxlength="20"/>

            <div class="mt-5 flex justify-between">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" name="remember"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 hover:cursor-pointer">
                    <span class="ms-2 text-sm text-gray-600 hover:cursor-pointer">{{ __('بخاطر سپاری') }}</span>
                </label>
                <a href="#" wire:navigate class="text-gray-600 text-sm" tabindex="-1">
                    {{__('بازنشانی کلمه عبور')}}
                </a>
            </div>

            <div class="flex justify-between mt-5">
                <a href="{{route('register')}}" wire:navigate tabindex="-1" class="text-sm px-2 pt-2.5 text-green-600
                hover:bg-gray-100 rounded-md">{{__('هنوز ثبت نام نکرده اید؟')}}</a>

                <button wire:click="login" class="border border-sky-700 px-3.5 pt-[5px] pb-1.5 text-sm text-sky-700 h-9 w-20
                   hover:text-white hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-sky-300 rounded
                   transition duration-200">
                    <span wire:loading.remove>{{__('ورود')}}</span>
                    <span wire:loading class="animate-spin">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
                        </svg>
                    </span>
                </button>

            </div>
        </form>
    </div>


</div>
