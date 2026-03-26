@extends('layouts.admin')

@section('header', 'All User Reports')

@section('content')
<div class="mb-8">
    <p class="text-gray-400 font-medium">Manage, prioritize and resolve community health issues</p>
</div>

<x-ui.card class="overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/10 bg-white/5 whitespace-nowrap">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">User</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Title & Category</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Priority</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400">Date</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($reports as $report)
                    <tr class="hover:bg-white/5 transition whitespace-nowrap">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-200">{{ $report->user->name }}</span>
                                <span class="text-[10px] text-gray-500 uppercase tracking-tighter">{{ $report->user->email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-white max-w-xs truncate">{{ $report->title }}</div>
                            <x-ui.label class="text-[10px] text-gray-600 uppercase font-bold tracking-widest mt-1 block">{{ $report->category }}</x-ui.label>
                        </td>
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
                            <x-ui.button variant="secondary" size="sm" href="{{ route('admin.reports.show', $report) }}" class="text-xs uppercase tracking-widest">
                                Manage
                            </x-ui.button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-20 text-center text-gray-500 italic">No reports submitted yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>

<div class="mt-6">
    {{ $reports->links() }}
</div>
@endsection
