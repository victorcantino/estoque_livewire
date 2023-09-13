<?php

namespace App\Livewire\Stocks;

use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Create extends Component
{
    public $title = 'Crie um novo Estoque';
    public \App\Livewire\Forms\Stock $form;

    #[Reactive]
    public $stock;
    public $action = 'create';

    public function render()
    {
        return view('livewire.stocks.create');
    }

    #[On('rename-stock')]
    public function rename()
    {
        $this->title = 'Renomeando Estoque';
        $this->clearValidation();
        $this->form->reset();
        $this->form->setStock($this->stock);
    }

    public function save()
    {
        $this->validate();
        if (isset($this->form->id)) {
            $this->form->update($this->form->id);
        } else {
            $this->form->store();
        }
        redirect()->to('/stocks');
    }

    public function clear()
    {
        $this->form->reset();
        $this->reset($this->stock);
    }
}
