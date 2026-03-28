@props(['status'])

@php
    $steps = [
        ['id' => 'Pending', 'label' => 'Pending', 'icon' => 'M12 8v4l3 3'],
        ['id' => 'In Progress', 'label' => 'In Progress', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
        ['id' => 'Resolved', 'label' => 'Resolved', 'icon' => 'M5 13l4 4L19 7'],
    ];

    $currentIndex = 0;
    foreach ($steps as $index => $step) {
        if ($step['id'] === $status) {
            $currentIndex = $index;
            break;
        }
    }
@endphp

<div class="w-full py-6">
    <div class="flex items-center justify-between relative">
        <!-- Connecting Line -->
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-0.5 bg-white/10 -z-0"></div>
        <div class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 bg-indigo-500 transition-all duration-500 -z-0" 
             style="width: {{ ($currentIndex / (count($steps) - 1)) * 100 }}%"></div>

        @foreach($steps as $index => $step)
            @php
                $isCompleted = $index < $currentIndex;
                $isActive = $index === $currentIndex;
                $isFuture = $index > $currentIndex;

                $dotClass = $isActive 
                    ? 'bg-indigo-500 border-indigo-400 shadow-[0_0_15px_rgba(99,102,241,0.5)]' 
                    : ($isCompleted ? 'bg-indigo-500 border-indigo-500' : 'bg-[#111318] border-white/10');
                
                $textClass = $isActive ? 'text-white font-bold' : ($isCompleted ? 'text-indigo-400' : 'text-gray-500');
            @endphp

            <div class="flex flex-col items-center relative z-10">
                <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center transition-all duration-500 {{ $dotClass }}">
                    <svg class="w-5 h-5 {{ $isActive || $isCompleted ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"></path>
                    </svg>
                </div>
                <div class="absolute -bottom-8 whitespace-nowrap text-[10px] uppercase tracking-widest font-bold {{ $textClass }}">
                    {{ $step['label'] }}
                </div>
            </div>
        @endforeach
    </div>
</div>
