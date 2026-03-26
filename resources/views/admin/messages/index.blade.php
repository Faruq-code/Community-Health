@extends('layouts.admin')

@section('header', 'Public Inquiries')

@section('content')
<div class="mb-8">
    <p class="text-gray-400 font-medium">Manage submissions from the public contact form</p>
</div>

<x-ui.card class="overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/10 bg-white/5 whitespace-nowrap">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400 w-8"></th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Sender</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Subject/Preview</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Date</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($messages as $message)
                    <tr class="hover:bg-white/5 transition whitespace-nowrap {{ !$message->is_read ? 'bg-amber-500/5' : '' }}">
                        <td class="px-6 py-4">
                            @if(!$message->is_read)
                                <div class="w-2 h-2 rounded-full bg-amber-500 shadow-[0_0_8px_#f59e0b]"></div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-200">{{ $message->name }}</div>
                            <div class="text-[10px] text-gray-500 uppercase tracking-tighter">{{ $message->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold {{ !$message->is_read ? 'text-white' : 'text-gray-500' }}">{{ $message->subject }}</div>
                            <div class="text-xs text-gray-600 mt-1 truncate max-w-xs">{{ Str::limit($message->message, 60) }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $message->created_at->format('M d, H:i') }}</td>
                        <td class="px-6 py-4 text-right">
                            <x-ui.button variant="ghost" size="sm" href="{{ route('admin.messages.show', $message) }}" class="text-amber-500 font-bold uppercase tracking-widest">
                                Read
                            </x-ui.button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-20 text-center text-gray-500 italic">No contact messages received yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>

<div class="mt-6">
    {{ $messages->links() }}
</div>
@endsection
