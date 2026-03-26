@extends('layouts.app')

@section('header', 'Submit New Report')

@section('content')
<div class="max-w-3xl">
    <x-ui.card class="p-10">
        <form action="{{ route('user.reports.store') }}" method="POST" x-data="{ count: {{ strlen(old('description', '')) }} }">
            @csrf
            
            <div class="space-y-8">
                <div class="space-y-2">
                    <x-ui.label for="title" value="Report Title" />
                    <x-ui.input id="title" name="title" :value="old('title')" required placeholder="Brief summary of the issue" />
                    @error('title') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <x-ui.label for="category" value="Category" />
                        <x-ui.select name="category" required>
                            <option value="" disabled selected class="bg-[#111318]">Select Category</option>
                            <option value="Bug" class="bg-[#111318]" {{ old('category') == 'Bug' ? 'selected' : '' }}>Bug</option>
                            <option value="Feature Request" class="bg-[#111318]" {{ old('category') == 'Feature Request' ? 'selected' : '' }}>Feature Request</option>
                            <option value="Infrastructure" class="bg-[#111318]" {{ old('category') == 'Infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                            <option value="Security" class="bg-[#111318]" {{ old('category') == 'Security' ? 'selected' : '' }}>Security</option>
                            <option value="Other" class="bg-[#111318]" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                        </x-ui.select>
                        @error('category') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="priority" value="Priority Level" />
                        <x-ui.select name="priority" required>
                            <option value="Low" class="bg-[#111318]" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Medium" class="bg-[#111318]" {{ old('priority', 'Medium') == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="High" class="bg-[#111318]" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Critical" class="bg-[#111318]" {{ old('priority') == 'Critical' ? 'selected' : '' }}>Critical</option>
                        </x-ui.select>
                        @error('priority') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <x-ui.label for="description" value="Detailed Description" />
                        <span class="text-[10px] text-gray-600 uppercase font-bold" x-text="count + ' / 5000'"></span>
                    </div>
                    <x-ui.textarea id="description" name="description" rows="8" x-on:input="count = $el.value.length" required placeholder="Explain the issue in detail...">{{ old('description') }}</x-ui.textarea>
                    @error('description') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 flex flex-col sm:flex-row items-center gap-6">
                    <x-ui.button size="lg" class="w-full sm:w-auto px-10 py-6 h-auto">
                        Submit Report
                    </x-ui.button>
                    <x-ui.button variant="ghost" href="{{ route('user.reports.index') }}" class="w-full sm:w-auto">
                        Cancel
                    </x-ui.button>
                </div>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
