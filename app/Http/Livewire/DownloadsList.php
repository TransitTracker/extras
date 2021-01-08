<?php

namespace App\Http\Livewire;

use App\Models\Period;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DownloadsList extends Component
{
    public $directories;
    public $period;

    public function mount()
    {
        $this->directories = Storage::directories('public/archive');
        $this->period = Period::whereDate('start_date', '<=', today())->whereDate('end_date', '>=', today())->first();
    }
}
