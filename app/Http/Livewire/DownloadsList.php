<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DownloadsList extends Component
{
    public $directories;
    public $selectedDirectory = '';
    public $files = [];

    public function setSelectedDirectory(string $selectedDirectory)
    {
        if (!in_array($selectedDirectory, $this->directories)) return;

        $this->selectedDirectory = $selectedDirectory;
        $this->files = Storage::files($selectedDirectory);
    }

    public function mount()
    {
        $this->directories = Storage::directories('public/gtfs');
    }
}
