@extends('layouts.guest')

@section('content')
<x-ui.card class="w-full max-w-md">
    <x-ui.card.header class="text-center">
        <x-ui.card.title class="text-indigo-500 uppercase tracking-tighter text-3xl">Register</x-ui.card.title>
        <x-ui.card.description>Join the Issue Reporting system</x-ui.card.description>
    </x-ui.card.header>

    <x-ui.card.content>
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-lg text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <x-ui.label for="name" value="Full Name" />
                <x-ui.input id="name" type="text" name="name" :value="old('name')" required placeholder="John Doe" />
            </div>

            <div class="space-y-2">
                <x-ui.label for="email" value="Email Address" />
                <x-ui.input id="email" type="email" name="email" :value="old('email')" required placeholder="name@example.com" />
            </div>

            <div class="space-y-2">
                <x-ui.label for="password" value="Password" />
                <x-ui.input id="password" type="password" name="password" required placeholder="••••••••" />
            </div>

            <div class="space-y-2">
                <x-ui.label for="password_confirmation" value="Confirm Password" />
                <x-ui.input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••" />
            </div>

            <x-ui.button class="w-full h-12" size="lg">
                Create Account
            </x-ui.button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-400">
            Already have an account? <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Sign In Instead</a>
        </div>
    </x-ui.card.content>
</x-ui.card>
@endsection
