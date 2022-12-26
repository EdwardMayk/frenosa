<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class LiveProductoTable extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5;
    public function render()
    {
        return view('livewire.live-producto-table',[
            'productos' => Producto::where('nombre','like', "%{$this->search}%")
            ->orwhere('codigo','like',"%{$this->search}%")
            ->orwhere('marca','like',"%{$this->search}%")
            ->paginate($this->perPage)
        ]);
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
