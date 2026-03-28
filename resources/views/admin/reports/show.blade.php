@extends('layouts.admin')

@section('header', 'Manage Report')

@section('content')
<div class="max-w-5xl grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <x-ui.button variant="ghost" size="sm" href="{{ route('admin.reports.index') }}" class="text-xs font-bold uppercase tracking-widest p-0 h-auto">
            <span class="mr-2">←</span> Back to reports
        </x-ui.button>

        <x-ui.card class="p-10">
            <div class="mb-8 pb-8 border-b border-white/10 flex flex-col sm:flex-row justify-between items-start gap-6">
                <div>
                    <x-ui.badge variant="amber" class="mb-2 text-[10px] uppercase font-bold tracking-widest">
                        {{ $report->category }}
                    </x-ui.badge>
                    <h1 class="text-3xl md:text-4xl font-bold syne tracking-tight">{{ $report->title }}</h1>
                    <div class="mt-4 text-xs text-gray-500">From User: <span class="text-white font-bold">{{ $report->user->name }}</span></div>
                </div>
                <div class="sm:text-right">
                    <x-ui.label class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 block">Priority</x-ui.label>
                    <div class="text-xl font-bold syne uppercase {{ $report->priority == 'Critical' ? 'text-red-500' : 'text-white' }}">{{ $report->priority }}</div>
                </div>
            </div>

            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed min-h-[200px] whitespace-pre-line">
                {{ $report->description }}
            </div>
        </x-ui.card>

        <x-ui.card class="p-10 border-indigo-500/20">
            <h3 class="text-indigo-400 text-xs font-bold uppercase tracking-widest mb-6">Send Official Response</h3>
            <form action="{{ route('admin.reports.respond', $report) }}" method="POST">
                @csrf
                <x-ui.textarea name="admin_response" rows="6" required placeholder="Type your response here... This will resolve the report.">{{ $report->admin_response }}</x-ui.textarea>
                <div class="mt-6">
                    <x-ui.button variant="default" type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-500 px-10 py-6 h-auto">
                        Submit Response & Resolve
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>

    <!-- Side management -->
    <div class="space-y-6">
        <x-ui.card class="p-8 border-amber-500/10">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-8 font-syne">Current Progress</h3>
            <x-ui.status-timeline :status="$report->status" />
        </x-ui.card>

        <x-ui.card class="p-8">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-6 font-syne">Update status</h3>
            <form action="{{ route('admin.reports.status', $report) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div class="space-y-2">
                    @foreach(['Pending', 'In Progress', 'Resolved'] as $status)
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="radio" name="status" value="{{ $status }}" {{ $report->status == $status ? 'checked' : '' }} onChange="this.form.submit()" class="hidden">
                            <div class="w-5 h-5 rounded-md border border-white/20 flex items-center justify-center transition group-hover:border-amber-500/50 {{ $report->status == $status ? 'bg-amber-500 border-amber-500' : '' }}">
                                @if($report->status == $status) <svg class="w-3 h-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> @endif
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest {{ $report->status == $status ? 'text-amber-500' : 'text-gray-400 group-hover:text-gray-200' }}">
                                {{ $status }}
                            </span>
                        </label>
                    @endforeach
                </div>
                <p class="text-[10px] text-gray-600 italic mt-4">Changing status will auto-update user view.</p>
            </form>
        </x-ui.card>

        <x-ui.card class="p-8">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-6 font-syne">Meta Information</h3>
            <div class="space-y-4 text-[10px]">
                <div class="flex justify-between items-center py-2 border-b border-white/5">
                    <span class="text-gray-600 font-bold uppercase tracking-widest">User ID</span>
                    <span class="text-gray-300 font-mono">{{ Str::limit($report->user_id, 8, '...') }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-white/5">
                    <span class="text-gray-600 font-bold uppercase tracking-widest">Submitted</span>
                    <span class="text-gray-300">{{ $report->created_at->diffForHumans() }}</span>
                </div>
                @if($report->responded_at)
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600 font-bold uppercase tracking-widest">Responded</span>
                    <span class="text-gray-300">{{ $report->responded_at->diffForHumans() }}</span>
                </div>
                @endif
            </div>
        </x-ui.card>
    </div>
</div>
@endsection
