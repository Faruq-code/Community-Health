@extends('layouts.app')

@section('header', 'Edit Report')

@section('content')
<div class="max-w-3xl">
    <div class="mb-8">
        <x-ui.button variant="ghost" size="sm" href="{{ route('user.reports.show', $report) }}" class="text-xs font-bold uppercase tracking-widest p-0 h-auto">
            <span class="mr-2">←</span> Back to report
        </x-ui.button>
    </div>

    <x-ui.card class="p-10">
        <div class="mb-8 p-4 bg-amber-500/10 border border-amber-500/20 rounded-lg">
            <p class="text-amber-500 text-xs font-bold uppercase tracking-widest flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Note: You can only edit reports that are still "Pending".
            </p>
        </div>

        <form action="{{ route('user.reports.update', $report) }}" method="POST" x-data="{ count: {{ strlen(old('description', $report->description)) }} }">
            @csrf
            @method('PUT')
            
            <div class="space-y-8">
                <div class="space-y-2">
                    <x-ui.label for="title" value="Report Title" />
                    <x-ui.input id="title" name="title" :value="old('title', $report->title)" required placeholder="Brief summary of the issue" />
                    @error('title') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <x-ui.label for="category" value="Category" />
                        <x-ui.select name="category" required>
                            <option value="" disabled class="bg-[#111318]">Select Category</option>
                            @foreach(['Bug', 'Feature Request', 'Infrastructure', 'Security', 'Other'] as $cat)
                                <option value="{{ $cat }}" class="bg-[#111318]" {{ old('category', $report->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </x-ui.select>
                        @error('category') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="priority" value="Priority Level" />
                        <x-ui.select name="priority" required>
                            @foreach(['Low', 'Medium', 'High', 'Critical'] as $prio)
                                <option value="{{ $prio }}" class="bg-[#111318]" {{ old('priority', $report->priority) == $prio ? 'selected' : '' }}>{{ $prio }}</option>
                            @endforeach
                        </x-ui.select>
                        @error('priority') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <x-ui.label for="description" value="Detailed Description" />
                        <span class="text-[10px] text-gray-600 uppercase font-bold" x-text="count + ' / 5000'"></span>
                    </div>
                    <x-ui.textarea id="description" name="description" rows="8" x-on:input="count = $el.value.length" required placeholder="Explain the issue in detail...">{{ old('description', $report->description) }}</x-ui.textarea>
                    @error('description') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 flex flex-col sm:flex-row items-center gap-6">
                    <x-ui.button size="lg" class="w-full sm:w-auto px-10 py-6 h-auto">
                        Update Report
                    </x-ui.button>
                    <x-ui.button variant="ghost" href="{{ route('user.reports.show', $report) }}" class="w-full sm:w-auto">
                        Cancel
                    </x-ui.button>
                </div>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
