<?php

namespace App\Livewire\Forms;

use App\Http\Traits\HttpTrait;
use Livewire\Attributes\Rule;
use Livewire\Form;

class Stock extends Form
{
    use HttpTrait;

    public ?int $id;

    #[Rule('required|min:3')]
    public string $nome = '';

    public function store()
    {
        return $this->sendPostRequest('/estoques', $this->all());
    }

    public function update($id)
    {
        return $this->sendPutRequest("/estoques/$id", $this->all());
    }

    public function setStock(array $stock)
    {
        $this->id = $stock['id'];
        $this->nome = $stock['nome'];
    }
}
