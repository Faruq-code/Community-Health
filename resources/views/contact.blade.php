@extends('layouts.guest')

@section('content')
<x-ui.card class="w-full max-w-2xl">
    <x-ui.card.header class="text-center">
        <x-ui.card.title class="text-indigo-500 uppercase tracking-tighter text-4xl">Contact Us</x-ui.card.title>
        <x-ui.card.description>Have a question? We're here to help.</x-ui.card.description>
    </x-ui.card.header>

    <x-ui.card.content>
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-lg text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('contact') }}" method="POST" class="grid grid-cols-2 gap-6">
            @csrf
            <div class="col-span-1 space-y-2">
                <x-ui.label for="name" value="Name" />
                <x-ui.input id="name" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="col-span-1 space-y-2">
                <x-ui.label for="email" value="Email" />
                <x-ui.input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="col-span-2 space-y-2">
                <x-ui.label for="subject" value="Subject" />
                <x-ui.input id="subject" type="text" name="subject" :value="old('subject')" required />
            </div>

            <div class="col-span-2 space-y-2">
                <x-ui.label for="message" value="Message" />
                <x-ui.textarea id="message" name="message" required rows="5">{{ old('message') }}</x-ui.textarea>
            </div>

            <div class="col-span-2">
                <x-ui.button class="w-full h-12" size="lg">
                    Send Message
                </x-ui.button>
            </div>
        </form>
        
        <div class="mt-8 text-center text-xs text-gray-600">
            <a href="{{ route('login') }}" class="hover:text-gray-400 underline">Back to Security Login</a>
        </div>
    </x-ui.card.content>
</x-ui.card>
@endsection
