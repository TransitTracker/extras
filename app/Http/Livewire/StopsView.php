<?php

namespace App\Http\Livewire;

use App\Models\Gtfs\Stop;
use Livewire\Component;
use Livewire\WithPagination;

class StopsView extends Component
{
    use WithPagination;

    public $selectedStop;
    public $searchId;
    public $searchName;
    public $formName;
    public $formLocation;
    public $formRealStop;
    public $formUsername;
    public $formSuccess = false;

    protected $queryString = ['searchId', 'searchName'];

    public function selectStop(int $stopId)
    {
        $this->selectedStop = Stop::find($stopId);
    }

    public function formSubmit()
    {
        $this->validate([
            'formName' => 'required',
            'formLocation' => 'required',
            'formRealStop' => 'nullable|numeric'
        ]);

        $this->selectedStop->suggestions()->create([
            'payload' => [
                'stop_name' => $this->formName,
                'stop_location' => $this->formLocation,
                'real_stop' => $this->formRealStop,
                'username' => $this->formUsername,
            ],
        ]);

        $this->formSuccess = true;
    }

    public function updatingSearchId()
    {
        $this->resetPage();
    }

    public function updatingSearchName()
    {
        $this->resetPage();
    }

    public function mount($id = null)
    {
        if ($id) { $this->selectStop($id); }
    }

    public function render()
    {
        return view('livewire.stops-view', [
            'stops' => Stop::where([
                ['is_fake', '=', true],
                ['stop_id', 'like', "%{$this->searchId}%"],
                ['stop_name', 'like', "%{$this->searchName}%"],
            ])->paginate(30),
        ]);
    }
}
