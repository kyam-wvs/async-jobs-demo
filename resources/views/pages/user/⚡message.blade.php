<?php

use Livewire\Component;
use App\Services\UserMessageService;

new class extends Component
{
    public $jobs = [];
    public $timeTakenMs = 0;
    public $rows = 0;
    public function save()
    {
        $service = new UserMessageService();
        $this->jobs = $service->messageUsers($this->rows);
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
        <form wire:submit="save">

        <button type="submit">Send messages</button>
        </form>
    </form>

    <h3>Jobs</h3>
    <ul>
        @foreach ($jobs as $job)
            <li>Job {{ $job['jobNumber'] }}: {{ $job['timeTaken'] }} seconds</li>
        @endforeach
    </ul>
    <p>Total time taken: {{ $timeTakenMs }} ms</p>
</div>
