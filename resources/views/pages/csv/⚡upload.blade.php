<?php

use Livewire\Component;

new class extends Component
{
    public $rows = 0;
    public $jobs = [];
    public $timeTakenMs = 0;

    public function save()
    {
        // todo: create a an POST endpoint to do this
        $this->jobs = [];
        $this->timeTakenMs = 0;
        for ($i = 0; $i < $this->rows; $i++) {
            $timeTaken = rand(1, 20) * 0.1;
            sleep($timeTaken);

            $this->jobs[] = ['jobNumber' => $i+1, 'timeTaken' => $timeTaken];
        }
        $this->timeTakenMs = array_sum(array_column($this->jobs, 'timeTaken')) * 1000;
    }

    public function processJob()
    {
        return view('pages.csv.upload');
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
