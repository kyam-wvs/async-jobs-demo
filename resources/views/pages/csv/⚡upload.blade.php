<?php

use Livewire\Component;
use App\Services\CsvService;
use App\Models\CsvUpload;
use App\Models\CsvRequest;

new class extends Component
{
    public $rows = 0;
    public $rowsAsynchronous = 0;
    public $inProgress = false;

    public function save(CsvService $service)
    {
        $this->inProgress = true;

        $service->processCsvBatchSync($this->rows);

        $this->inProgress = false;
    }

    public function saveAsynchronous(CsvService $service)
    {
        $this->inProgress = true;

        $service->processCsvBatchAsync($this->rowsAsynchronous);

        $this->inProgress = false;

        // todo: add a processed property to all models, default to false
    }

    public function clear()
    {
        CsvUpload::truncate();
        CsvRequest::truncate();
    }
};
?>

<div>
    <h2>CSV File upload</h2>
    @if(!$this->inProgress)
        <form wire:submit="save">
            <label>
                CSV rows
                <input type="number" wire:model="rows">
            </label>

            <button type="submit">Submit CSV (synchronous)</button>
        </form>
            <form wire:submit="saveAsynchronous">
                <label>
                    CSV rows
                    <input type="number" wire:model="rowsAsynchronous">
                </label>

                <button type="submit">Submit CSV (asynchronous)</button>
            </form>

        <form wire:submit="clear">
            <button type="submit">Clear all</button>
        </form>
    @else
        <p class="text-blue-600">Processing CSV files... Please wait.</p>
    @endif

    <livewire:csv.view />
</div>
