<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.logreg')] #[Title('ثبت نام')] class extends Component {

    public string $n_code = '';
    public string $mobile = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'n_code' => ['required', 'digits:10', new Ncode(), 'unique:' . Profile::class . ',n_code'],
            'mobile' => ['required', 'starts_with:09', 'digits:11'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        event(new Registered($user = User::create($validated)));
        Auth::login($user);
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="sm:w-96 w-80">

    <!-- Form Title -->
    <h1 class="text-center font-semibold my-2">{{__('ثبت نام')}}</h1>
    <!-- Form Body -->
    <div class="border py-8 px-6 rounded-md">
        <form wire:submit="register">
            <!-- National Code -->
            <x-input.flt-lbl name="n_code" label="کدملی:" style="direction: ltr" autofocus maxlength="10"/>
            <!-- Mobile Number -->
            <x-input.flt-lbl name="mobile" label="شماره موبایل:" style="direction: ltr" maxlength="11"/>
            <!-- Password -->
            <x-input.flt-lbl name="password" type="password" label="کلمه عبور:" style="direction: ltr" maxlength="20"/>
            <x-input.flt-lbl name="password_confirmation" type="password" label="تکرار کلمه عبور:"
                             style="direction: ltr" maxlength="20"/>

            <div class="flex justify-between mt-5">
                <a href="{{route('login')}}" wire:navigate tabindex="-1" class="text-sm px-2 pt-2.5 text-blue-600
                hover:bg-gray-100 rounded-md">{{__('قبلا ثبت نام کرده اید؟')}}</a>

                <button wire:click="login" class="border border-green-700 px-3.5 pt-[5px] pb-1.5 text-sm text-green-700 h-9 w-20
                   hover:text-white hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 rounded
                   transition duration-200">
                    <span wire:loading.remove>{{__('ثبت نام')}}</span>
                    <span wire:loading class="animate-spin">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                            <path
                                d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
                            <path fill-rule="evenodd"
                                  d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
                        </svg>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
