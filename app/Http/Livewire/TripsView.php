<?php

namespace App\Http\Livewire;

use App\Model\Trip;
use Livewire\Component;
use Livewire\WithPagination;

class TripsView extends Component
{
    use WithPagination;

    public $selectedTrip;
    public $searchTrip;
    public $searchRoute;

    protected $updatesQueryString = ['searchTrip', 'searchRoute'];

    public function selectTrip(int $id) {
        $trip = Trip::find($id);
        $this->selectedTrip = $trip;
    }

    public function mount()
    {
        $this->selectedTrip = Trip::first();
        $this->searchTrip = request()->query('searchTrip', $this->searchTrip);
        $this->searchRoute = request()->query('searchRoute', $this->searchRoute);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.trips-view', [
            'trips' => Trip::where([
                ['trip_id', 'like', '%'.$this->searchTrip.'%'],
                ['route_id', 'like', '%'.$this->searchRoute.'%'],
            ])->paginate(10),
        ]);
    }
}
