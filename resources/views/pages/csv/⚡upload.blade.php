<?php

use Livewire\Component;
use App\Services\CsvService;
use App\Models\CsvRequest;

new class extends Component
{
    public $rows = 0;
    public $inProgress = false;

    public function save()
    {
        $this->inProgress = true;
        // add a clear all button

        $service = new CsvService();
        $result = $service->processCsvFiles($this->rows);

        $this->inProgress = false;
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

    <livewire:csv.view />
</div>
