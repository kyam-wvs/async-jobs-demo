<?php

use Livewire\Component;
use App\Services\CsvService;

new class extends Component
{
    public $rows = 0;
    public $jobs = [];
    public $timeTakenMs = 0;

    public function save()
    {
        $this->jobs = [];
        $this->timeTaken = 0;

        $service = new CsvService();
        $result = $service->processCsvFiles($this->rows);

        $this->jobs = $result;

        $this->timeTakenMs = array_sum(array_column($this->jobs, 'timeTaken')) * 1000;
    }
};
?>

<div>
    <h2>CSV File upload</h2>
    <form wire:submit="save">
        <label>
            CSV rows
            <input type="number" wire:model="rows">
        </label>
        <form wire:submit="save">

        <button type="submit">Submit CSV</button>
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
