<?php

namespace App\Http\Livewire;

use App\Model\Gtfs\Stop;
use App\Model\Suggestion;
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
    public $formSuccess = false;

    protected $updatesQueryString = ['searchId', 'searchName'];

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

        Suggestion::create([
            'stop_id' => $this->selectedStop->stop_id,
            'payload' => [
                'stop_name' => $this->formName,
                'stop_location' => $this->formLocation,
                'real_stop' => $this->formRealStop,
            ]
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

    public function mount()
    {
        $this->searchId = request()->query('searchId', $this->searchId);
        $this->searchName = request()->query('searchName', $this->searchName);
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
