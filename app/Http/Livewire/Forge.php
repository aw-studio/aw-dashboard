<?php

namespace App\Http\Livewire;

use Laravel\Forge\ApiProvider;
use Livewire\Component;
use Laravel\Forge\Forge as ForgeApi;

class Forge extends Component
{
    protected $forge;

    public $servers;

    public function mount()
    {
        // $this->forge = new ForgeApi(new ApiProvider(env('FORGE_API_TOKEN')));
        // $this->servers = $this->forge->lazyLoad();
    }

    public function render()
    {
        return view('livewire.forge');
    }
}
