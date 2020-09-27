<?php

namespace App\Http\Livewire;

use App\Model\Gtfs\Trip;
use App\Model\Suggestion;
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
    public $formSuccess = false;

    protected $updatesQueryString = ['searchTrip', 'searchRoute'];

    public function selectTrip(int $id)
    {
        $this->selectedTrip = Trip::find($id);
    }

    public function formSubmit()
    {
        $this->validate([
            'formHeadsign' => 'required',
            'formNotes' => 'required',
        ]);

        Suggestion::create([
            'trip_id' => $this->selectedTrip->trip_id,
            'payload' => [
                'trip_headsign' => $this->formHeadsign,
                'trip_notes' => $this->formNotes,
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

    public function mount()
    {
        $this->searchTrip = request()->query('searchTrip', $this->searchTrip);
        $this->searchRoute = request()->query('searchRoute', $this->searchRoute);
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
