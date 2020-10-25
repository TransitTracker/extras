<?php

namespace App\Http\Livewire;

use App\Models\Gtfs\Trip;
use Livewire\Component;
use Livewire\WithPagination;

class TripsView extends Component
{
    use WithPagination;

    public $selectedTrip;
    public $searchTrip;
    public $searchRoute;
    public $formHeadsign;
    public $formNotes;
    public $formUsername;
    public $formSuccess = false;

    protected $queryString = ['searchTrip', 'searchRoute'];

    public function selectTrip(int $id)
    {
        $this->selectedTrip = Trip::find($id);
        $this->formSuccess = false;
    }

    public function formSubmit()
    {
        $this->validate([
            'formHeadsign' => 'required',
            'formNotes' => 'required',
        ]);

        $this->selectedTrip->suggestions()->create([
            'payload' => [
                'trip_headsign' => $this->formHeadsign,
                'trip_notes' => $this->formNotes,
                'username' => $this->formUsername,
            ],
        ]);

        $this->formSuccess = true;
    }

    public function updatingSearchTrip()
    {
        $this->resetPage();
    }

    public function updatingSearchRoute()
    {
        $this->resetPage();
    }

    public function mount($id = null)
    {
        if ($id) { $this->selectTrip($id); }
    }

    public function render()
    {
        return view('livewire.trips-view', [
            'trips' => Trip::where([
                ['trip_id', 'like', "%{$this->searchTrip}%"],
                ['route_id', 'like', "%{$this->searchRoute}%"],
            ])->with(['stop_times' => function ($query) {
                $query->orderBy('stop_sequence', 'desc');
            }])->paginate(30),
        ]);
    }
}
