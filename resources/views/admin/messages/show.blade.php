@extends('layouts.admin')

@section('header', 'Read Inquiry')

@section('content')
<div class="max-w-4xl space-y-8">
    <x-ui.button variant="ghost" size="sm" href="{{ route('admin.messages.index') }}" class="text-xs font-bold uppercase tracking-widest p-0 h-auto">
        <span class="mr-2">←</span> Back to messages
    </x-ui.button>

    <x-ui.card class="p-10 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-10 opacity-5">
            <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z"/></svg>
        </div>

        <div class="mb-10 pb-10 border-b border-white/10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
        <div>
            <x-ui.label class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2 block">From</x-ui.label>
            <div class="text-2xl font-bold syne">{{ $message->name }}</div>
            <div class="text-amber-500 font-bold text-sm">{{ $message->email }}</div>
        </div>
        <div class="md:text-right">
            <x-ui.label class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2 block">Subject</x-ui.label>
            <div class="text-2xl font-bold syne text-white uppercase tracking-tight">{{ $message->subject }}</div>
            <div class="text-xs text-gray-600 font-bold mt-1 uppercase">{{ $message->created_at->format('F d, Y \a\t H:i') }}</div>
        </div>
    </div>
</div>

        <div class="prose prose-invert max-w-none">
            <div class="text-lg text-gray-300 leading-relaxed italic whitespace-pre-line">
                "{{ $message->message }}"
            </div>
        </div>
    </x-ui.card>

    <div class="flex space-x-6">
        <x-ui.button variant="default" href="mailto:{{ $message->email }}?subject=RE: {{ $message->subject }}" size="lg" class="bg-indigo-600 text-white hover:bg-indigo-500 px-10 py-6 h-auto font-syne">
            Reply via Email
            <span class="ml-2">↗</span>
        </x-ui.button>
    </div>
</div>
@endsection
