@extends('layouts.app')

@section('header', 'Welcome, ' . auth()->user()->name)

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <x-ui.card class="p-6">
        <x-ui.label class="uppercase tracking-widest text-[10px] mb-2 block">Total Reports</x-ui.label>
        <div class="text-4xl font-bold syne">{{ $stats['total'] }}</div>
    </x-ui.card>
    <x-ui.card class="p-6 border-amber-500/20">
        <x-ui.label class="text-amber-500/60 uppercase tracking-widest text-[10px] mb-2 block">Pending</x-ui.label>
        <div class="text-4xl font-bold syne text-amber-500">{{ $stats['pending'] }}</div>
    </x-ui.card>
    <x-ui.card class="p-6 border-blue-500/20">
        <x-ui.label class="text-blue-500/60 uppercase tracking-widest text-[10px] mb-2 block">In Progress</x-ui.label>
        <div class="text-4xl font-bold syne text-blue-500">{{ $stats['in_progress'] }}</div>
    </x-ui.card>
    <x-ui.card class="p-6 border-green-500/20">
        <x-ui.label class="text-green-500/60 uppercase tracking-widest text-[10px] mb-2 block">Resolved</x-ui.label>
        <div class="text-4xl font-bold syne text-green-500">{{ $stats['resolved'] }}</div>
    </x-ui.card>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-8">
    <h3 class="text-xl font-bold syne uppercase tracking-tight">Recent Reports</h3>
    <x-ui.button href="{{ route('user.reports.create') }}" class="w-full sm:w-auto">
        Submit New Report
    </x-ui.button>
</div>

<x-ui.card class="overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/10 bg-white/5 whitespace-nowrap">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Title</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Category</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Date</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($reports as $report)
                    <tr class="hover:bg-white/5 transition whitespace-nowrap">
                        <td class="px-6 py-4 font-medium text-white max-w-xs truncate">{{ $report->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $report->category }}</td>
                        <td class="px-6 py-4">
                            @php
                                $badgeVariant = match($report->status) {
                                    'Pending' => 'amber',
                                    'In Progress' => 'outline',
                                    'Resolved' => 'success',
                                    default => 'secondary',
                                };
                            @endphp
                            <x-ui.badge :variant="$badgeVariant">
                                {{ $report->status }}
                            </x-ui.badge>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $report->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <x-ui.button variant="ghost" size="sm" href="{{ route('user.reports.show', $report) }}">
                                View Details
                            </x-ui.button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">No reports found. Start by submitting one!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>
@endsection
