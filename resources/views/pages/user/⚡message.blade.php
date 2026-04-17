<?php

use Livewire\Component;
use App\Services\UserMessageService;

use App\Models\UserMessage;
use App\Models\UserMessageRequest;

new class extends Component
{
    public $rows = 0;
    public function save()
    {
        $service = new UserMessageService();
        $service->messageUsers($this->rows);
    }

    public function clear()
    {
        UserMessage::truncate();
        UserMessageRequest::truncate();
    }
};
?>

<div>
    <h2>CSV File upload</h2>
    <form wire:submit="save">
        <label>
            Users to message
            <input type="number" wire:model="rows">
        </label>

        <button type="submit">Send messages</button>
    </form>


    <form wire:submit="clear">
        <button type="submit">Clear all</button>
    </form>

    <livewire:message.view />
</div>
