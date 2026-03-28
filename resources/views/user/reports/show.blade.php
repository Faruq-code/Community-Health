@extends('layouts.app')

@section('header', 'Report Details')

@section('content')
<div class="max-w-4xl space-y-8">
    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
        <x-ui.button variant="ghost" size="sm" href="{{ route('user.reports.index') }}" class="text-xs font-bold uppercase tracking-widest p-0 h-auto">
            <span class="mr-2">←</span> Back to list
        </x-ui.button>
        <div class="flex flex-wrap gap-2">
            @if($report->status === 'Pending')
                <x-ui.button variant="outline" size="sm" href="{{ route('user.reports.edit', $report) }}" class="text-xs font-bold uppercase tracking-widest border-white/10 hover:border-white/20">
                    Edit Report
                </x-ui.button>
                <form action="{{ route('user.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <x-ui.button variant="destructive" size="sm" type="submit" class="text-xs font-bold uppercase tracking-widest">
                        Delete
                    </x-ui.button>
                </form>
            @endif
             @php
                $statusVariant = match($report->status) {
                    'Pending' => 'amber',
                    'In Progress' => 'outline',
                    'Resolved' => 'success',
                    default => 'secondary',
                };
            @endphp
            <x-ui.badge :variant="$statusVariant" class="px-4 py-1 text-xs uppercase font-bold tracking-widest">
                {{ $report->status }}
            </x-ui.badge>
            <x-ui.badge variant="outline" class="px-4 py-1 text-xs uppercase font-bold tracking-widest bg-white/5">
                {{ $report->priority }} Priority
            </x-ui.badge>
        </div>
    </div>

    <div class="glass p-8 rounded-2xl border border-white/10">
        <x-ui.status-timeline :status="$report->status" />
    </div>

    <x-ui.card class="p-10">
        <div class="mb-8 pb-8 border-b border-white/10">
            <x-ui.label class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-1 block">{{ $report->category }}</x-ui.label>
            <h1 class="text-4xl font-bold syne tracking-tight">{{ $report->title }}</h1>
            <div class="mt-4 text-xs text-gray-500 uppercase tracking-widest">Submitted on {{ $report->created_at->format('F d, Y \a\t H:i') }}</div>
        </div>

        <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed whitespace-pre-line">
            {{ $report->description }}
        </div>
    </x-ui.card>

    @if($report->admin_response)
        <x-ui.card class="bg-indigo-600/10 border-indigo-500/30 p-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4">
                <svg class="w-12 h-12 text-indigo-500/20" fill="currentColor" viewBox="0 0 24 24"><path d="M11.19 2.04c-4.47.33-8.12 3.98-8.45 8.45A10.019 10.019 0 0012 22a9.914 9.914 0 005.45-1.61c.33.22.73.36 1.15.36 1.1 0 2-.9 2-2 0-.42-.14-.82-.36-1.15a9.957 9.957 0 001.37-3.95A10.003 10.003 0 0011.19 2.04zM13 14h-2v-2h2v2zm0-4h-2V6h2v4z"/></svg>
            </div>
            <h3 class="text-indigo-400 text-sm font-bold uppercase tracking-widest mb-4">Official Admin Response</h3>
            <div class="text-lg text-white font-medium leading-relaxed mb-6">
                {{ $report->admin_response }}
            </div>
            <div class="text-xs text-indigo-500/60 uppercase tracking-widest">Responded on {{ $report->responded_at->format('F d, Y \a\t H:i') }}</div>
        </x-ui.card>
    @else
        <x-ui.card class="p-10 border-dashed flex flex-col items-center justify-center text-center">
            <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center mb-4 border border-white/10">
                <span class="text-gray-500 text-xl font-bold italic">?</span>
            </div>
            <h3 class="text-gray-400 font-bold syne uppercase tracking-widest">Awaiting Admin Response</h3>
            <p class="text-gray-600 text-sm mt-2 font-medium">Our team is reviewing your report. You'll be notified of updates.</p>
        </x-ui.card>
    @endif
</div>
@endsection
