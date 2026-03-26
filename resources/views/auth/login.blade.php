@extends('layouts.guest')

@section('content')
<x-ui.card class="w-full max-w-md">
    <x-ui.card.header class="text-center">
        <x-ui.card.title class="text-indigo-500 uppercase tracking-tighter text-3xl">Sign In</x-ui.card.title>
        <x-ui.card.description>Welcome back to the portal</x-ui.card.description>
    </x-ui.card.header>

    <x-ui.card.content>
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-lg text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <x-ui.label for="email" value="Email Address" />
                <x-ui.input id="email" type="email" name="email" :value="old('email')" required placeholder="name@example.com" />
            </div>

            <div class="space-y-2">
                <x-ui.label for="password" value="Password" />
                <x-ui.input id="password" type="password" name="password" required placeholder="••••••••" />
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-400 cursor-pointer">
                    <input type="checkbox" name="remember" class="mr-2 rounded border-white/10 bg-white/5 text-indigo-500 focus:ring-offset-0 focus:ring-indigo-500">
                    Remember me
                </label>
            </div>

            <x-ui.button class="w-full h-12" size="lg">
                Sign In
            </x-ui.button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-400">
            Don't have an account? <a href="{{ route('register') }}" class="text-indigo-400 hover:underline">Create an Account</a>
        </div>

        <div class="mt-4 text-center text-xs text-gray-600 flex justify-center items-center space-x-2">
            <a href="{{ route('admin.login') }}" class="hover:text-gray-400">Admin Portal</a>
            <span class="text-white/10">|</span>
            <a href="{{ route('contact') }}" class="text-indigo-400 hover:text-indigo-300 font-bold">Need Help? Contact Us</a>
        </div>
    </x-ui.card.content>
</x-ui.card>
@endsection
