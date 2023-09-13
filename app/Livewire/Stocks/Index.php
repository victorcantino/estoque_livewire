<?php

namespace App\Livewire\Stocks;

use Carbon\Carbon;
use Livewire\Component;
use App\Http\Traits\HttpTrait;

class Index extends Component
{
    use HttpTrait;

    public $stock = [
        'id' => null,
        'nome' => '',
    ];
    
    public $stocks = [];
    public $action = '';
    public $title = 'Formulário estoque';

    // Método para renderizar a página inicial
    public function render()
    {
        // Obtém a lista de estoques por meio de uma requisição HTTP e a armazena na variável $stocks
        $this->stocks = $this->sendGetRequest('/estoques');

        // Retorna a view 'livewire.stock' para renderização na interface do usuário
        return view('livewire.stocks.index');
    }

    public function rename($id)
    {
        $this->stock = $this->sendGetRequest("/estoques/$id");
        $this->dispatch('rename-stock');
    }

    // Método para excluir um estoque
    public function delete($id)
    {
        // Envia uma requisição HTTP DELETE para excluir o estoque com o ID fornecido
        $this->sendDeleteRequest("/estoques/$id");

        // Reseta os campos do formulário
        $this->reset();
    }

    public function dateFormat($data)
    {
        return Carbon::parse($data)->format('d/m/Y D h:i:s');
    }

    public function create() 
    {
        dd($this->stock);
        $this->stock['id'] = null;
    }
}
