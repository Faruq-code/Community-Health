@extends('layouts.admin')

@section('header', 'Admin Overview')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
    <x-ui.card class="p-6">
        <x-ui.label class="uppercase tracking-widest text-[10px] mb-2 block">Total Reports</x-ui.label>
        <div class="text-4xl font-bold syne">{{ $stats['total_reports'] }}</div>
    </x-ui.card>
    <x-ui.card class="p-6 border-amber-500/20">
        <x-ui.label class="text-amber-500/60 uppercase tracking-widest text-[10px] mb-2 block">Pending Reports</x-ui.label>
        <div class="text-4xl font-bold syne text-amber-500">{{ $stats['pending_reports'] }}</div>
    </x-ui.card>
    <x-ui.card class="p-6 border-green-500/20">
        <x-ui.label class="text-green-500/60 uppercase tracking-widest text-[10px] mb-2 block">Resolved</x-ui.label>
        <div class="text-4xl font-bold syne text-green-500">{{ $stats['resolved_reports'] }}</div>
    </x-ui.card>
    <x-ui.card class="p-6">
        <x-ui.label class="uppercase tracking-widest text-[10px] mb-2 block">Contact Messages</x-ui.label>
        <div class="text-4xl font-bold syne">{{ $stats['total_messages'] }}</div>
    </x-ui.card>
    <x-ui.card class="p-6 border-indigo-500/20 sm:col-span-2 lg:col-span-1">
        <x-ui.label class="text-indigo-500/60 uppercase tracking-widest text-[10px] mb-2 block">Unread Messages</x-ui.label>
        <div class="text-4xl font-bold syne text-indigo-400">{{ $stats['unread_messages'] }}</div>
    </x-ui.card>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
    <!-- Recent Reports -->
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold syne uppercase tracking-tight">Recent User Reports</h3>
            <x-ui.button variant="ghost" size="sm" href="{{ route('admin.reports.index') }}" class="text-amber-400 hover:text-amber-300 p-0 h-auto">
                View All
            </x-ui.button>
        </div>
        <x-ui.card class="overflow-hidden">
            <table class="w-full text-left text-sm">
                <tbody class="divide-y divide-white/5">
                    @forelse($recent_reports as $report)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium text-white">{{ Str::limit($report->title, 40) }}</div>
                                <div class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">{{ $report->user->name }} • {{ $report->category }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusVariant = match($report->status) {
                                        'Pending' => 'amber',
                                        'In Progress' => 'outline',
                                        'Resolved' => 'success',
                                        default => 'secondary',
                                    };
                                @endphp
                                <x-ui.badge :variant="$statusVariant" class="text-[9px]">
                                    {{ $report->status }}
                                </x-ui.badge>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-ui.button variant="ghost" size="sm" href="{{ route('admin.reports.show', $report) }}" class="text-white hover:text-amber-400">
                                    Show
                                </x-ui.button>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-6 py-10 text-center text-gray-500 italic">No recent reports.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </x-ui.card>
    </div>

    <!-- Recent Messages -->
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold syne uppercase tracking-tight">Recent Messages</h3>
            <x-ui.button variant="ghost" size="sm" href="{{ route('admin.messages.index') }}" class="text-amber-400 hover:text-amber-300 p-0 h-auto">
                View All
            </x-ui.button>
        </div>
        <x-ui.card class="overflow-hidden">
            <table class="w-full text-left text-sm">
                <tbody class="divide-y divide-white/5">
                    @forelse($recent_messages as $message)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 {{ !$message->is_read ? 'border-l-2 border-amber-500' : '' }}">
                                <div class="font-medium {{ !$message->is_read ? 'text-white' : 'text-gray-400' }}">{{ $message->subject }}</div>
                                <div class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">From: {{ $message->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-ui.button variant="ghost" size="sm" href="{{ route('admin.messages.show', $message) }}" class="text-white hover:text-amber-400">
                                    Read
                                </x-ui.button>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-6 py-10 text-center text-gray-500 italic">No recent messages.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </x-ui.card>
    </div>
</div>
@endsection
