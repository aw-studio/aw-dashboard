<?php

namespace App\Http\Livewire;

use App\Models\Site;
use App\Models\Deploy;
use App\Models\Server;
use Livewire\Component;

class Forge extends Component
{
    public $servers = [];

    public $sites = [];

    public $deploys = [];

    public function mount()
    {
        $this->load();
    }

    public function hydrate()
    {
        $this->load();
    }

    protected function load()
    {
        $this->sites = Site::all();
        $this->servers = Server::all();
        $this->deploys = Deploy::where('seen', false)->get();
    }

    public function render()
    {
        return view('livewire.forge');
    }
}
