@extends('layouts.guest')

@section('content')
<x-ui.card class="w-full max-w-md border-amber-500/20">
    <x-ui.card.header class="text-center">
        <div class="flex justify-center mb-4">
            <x-ui.badge variant="amber" class="uppercase tracking-widest px-3 py-1">Secure Portal</x-ui.badge>
        </div>
        <x-ui.card.title class="text-amber-500 uppercase tracking-tighter text-3xl">Admin Login</x-ui.card.title>
        <x-ui.card.description>Management interface</x-ui.card.description>
    </x-ui.card.header>

    <x-ui.card.content>
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-lg text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <x-ui.label for="email" value="Admin Email" />
                <x-ui.input id="email" type="email" name="email" :value="old('email')" required placeholder="admin@example.com" class="focus-visible:ring-amber-500" />
            </div>

            <div class="space-y-2">
                <x-ui.label for="password" value="Password" />
                <x-ui.input id="password" type="password" name="password" required placeholder="••••••••" class="focus-visible:ring-amber-500" />
            </div>

            <x-ui.button variant="amber" class="w-full h-12" size="lg">
                Authorize Access
            </x-ui.button>
        </form>

        <div class="mt-8 text-center text-xs text-gray-600">
            <a href="{{ route('login') }}" class="hover:text-gray-400">Return to User Portal</a>
        </div>
    </x-ui.card.content>
</x-ui.card>
@endsection
