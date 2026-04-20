<?php

use App\Models\CsvRequest;
use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component
{
    #[Computed]
    public function csvRequests()
    {
        return CsvRequest::with('csvUploads')->orderByDesc('id')->get();
    }
};
?>

<div class="space-y-4 max-w-4xl" wire:poll.250ms="$refresh">
    @forelse ($this->csvRequests() as $request)
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-start mb-3">
                <h2 class="text-base font-semibold">Request #{{ $request->id }}</h2>
                <div class="text-right text-xs text-gray-600">
                    <p>{{ $request->created_at?->format('H:i:s') }}</p>
                    @if ($request->time_taken_ms)
                        <p class="text-green-600 font-medium">{{ number_format($request->time_taken_ms / 1000, 2) }}s</p>
                    @else
                        <p class="text-blue-600">In Progress</p>
                    @endif
                </div>
            </div>

            <div class="border-t pt-4">
                <h3 class="font-semibold mb-3 text-sm">CSV Uploads ({{ $request->csvUploads->count() }})</h3>

                <div class="flex flex-wrap gap-2">
                    @forelse ($request->csvUploads as $upload)
                        <div class="bg-gray-50 rounded px-2 py-1 text-xs whitespace-nowrap">
                            <p class="font-medium truncate">{{ $upload->file_name }}</p>
                            <p class="text-gray-600">Job #{{ $upload->job_number }}</p>
                            @if ($upload->completed)
                                <p class="text-green-600 font-medium">{{ number_format($upload->time_taken_ms / 1000, 2) }}s</p>
                            @else
                                <p class="text-blue-600">In progress...</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 text-xs">No CSV uploads yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @empty
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-yellow-800">No CSV requests found.</p>
        </div>
    @endforelse
</div>
