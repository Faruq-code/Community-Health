@extends('layouts.app')

@section('header', 'My Reports')

@section('content')
<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
    <div>
        <p class="text-gray-400 mb-4">Track and manage your submitted issues</p>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('user.reports.index') }}" class="px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition {{ !request('status') ? 'bg-indigo-600 text-white' : 'glass text-gray-400 hover:text-white' }}">All</a>
            <a href="{{ route('user.reports.index', ['status' => 'Pending']) }}" class="px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition {{ request('status') == 'Pending' ? 'bg-amber-500 text-black' : 'glass text-gray-400 hover:text-white' }}">Pending</a>
            <a href="{{ route('user.reports.index', ['status' => 'In Progress']) }}" class="px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition {{ request('status') == 'In Progress' ? 'bg-blue-500 text-white' : 'glass text-gray-400 hover:text-white' }}">In Progress</a>
            <a href="{{ route('user.reports.index', ['status' => 'Resolved']) }}" class="px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition {{ request('status') == 'Resolved' ? 'bg-green-500 text-white' : 'glass text-gray-400 hover:text-white' }}">Resolved</a>
        </div>
    </div>
    <x-ui.button href="{{ route('user.reports.create') }}" class="w-full md:w-auto">
        New Report
    </x-ui.button>
</div>

<x-ui.card class="overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/10 bg-white/5 whitespace-nowrap">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Title</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Category</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Priority</th>
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
                                $priorityVariant = match($report->priority) {
                                    'Critical' => 'destructive',
                                    'High' => 'amber',
                                    'Medium' => 'secondary',
                                    default => 'outline',
                                };
                            @endphp
                            <x-ui.badge :variant="$priorityVariant" class="text-[9px]">
                                {{ $report->priority }}
                            </x-ui.badge>
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
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $report->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <x-ui.button variant="ghost" size="sm" href="{{ route('user.reports.show', $report) }}" class="text-indigo-400 hover:text-indigo-300 font-bold uppercase tracking-widest text-[10px]">
                                View
                            </x-ui.button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">No reports matches the criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>

<div class="mt-6">
    {{ $reports->links() }}
</div>
@endsection
