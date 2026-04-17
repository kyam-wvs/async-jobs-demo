<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\UserMessageRequest;

new class extends Component
{
    #[Computed]
    public function messageRequests()
    {
        return UserMessageRequest::with('messages')->orderByDesc('id')->get();
    }
};
?>

<div class="space-y-4" wire:poll.250ms="$refresh">
    @forelse ($this->messageRequests() as $request)
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">CSV Request #{{ $request->id }}</h2>

            <div class="mb-4 text-sm text-gray-600">
                <p>Started: {{ $request->created_at?->format('M d, Y H:i:s') }}</p>
                @if ($request->time_taken_ms)
                    <p class="text-green-600 font-medium">Time taken: {{ $request->time_taken_ms }}ms</p>
                @else
                    <p class="text-blue-600">Status: In Progress</p>
                @endif
            </div>

            <div class="border-t pt-4">
                <h3 class="font-semibold mb-3">Messages ({{ $request->messages->count() }})</h3>

                @forelse ($request->messages as $upload)
                    <div class="bg-gray-50 rounded p-3 mb-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">{{ $upload->file_name }}</p>
                                <p class="text-sm text-gray-600">Job #{{ $upload->job_number }} - complete</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No CSV uploads yet.</p>
                @endforelse
            </div>
        </div>
    @empty
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-yellow-800">No Message requests found.</p>
        </div>
    @endforelse
</div>
