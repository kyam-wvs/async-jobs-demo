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

<div class="space-y-4 max-w-4xl" wire:poll.250ms="$refresh">
    @forelse ($this->messageRequests() as $request)
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
                <h3 class="font-semibold mb-3 text-sm">Messages ({{ $request->messages->count() }})</h3>

                <div class="flex flex-wrap gap-2">
                    @forelse ($request->messages as $message)
                        <div class="bg-gray-50 rounded px-2 py-1 text-xs whitespace-nowrap">
                            <p class="font-medium truncate">{{ $message->file_name }}</p>
                            <p class="text-gray-600">Job #{{ $message->job_number }}</p>
                            <p class="text-green-600 font-medium">{{ number_format($message->time_taken_ms / 1000, 2) }}s</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-xs">No messages yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @empty
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-yellow-800">No Message requests found.</p>
        </div>
    @endforelse
</div>
