<div>
    <!-- Abas de navegação usando Bootstrap -->
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <!-- Primeira aba "Criar" (ativa por padrão) -->
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="aba1-tab" data-bs-toggle="tab" href="#aba1" role="tab" aria-controls="aba1" aria-selected="true">Criar</a>
        </li>
        <!-- Segunda aba "Pesquisar" -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="aba2-tab" data-bs-toggle="tab" href="#aba2" role="tab" aria-controls="aba2" aria-selected="false">Pesquisar</a>
        </li>
    </ul>

    <!-- Conteúdo das Abas -->
    <div class="tab-content" id="myTabsContent">
        <!-- Conteúdo da primeira aba "Criar" (ativa por padrão) -->
        <div class="tab-pane fade show active" id="aba1" role="tabpanel" aria-labelledby="aba1-tab">
            <!-- Componente Livewire para criar estoque -->
            <livewire:stocks.create :$stock />
        </div>
        <!-- Conteúdo da segunda aba "Pesquisar" -->
        <div class="tab-pane fade" id="aba2" role="tabpanel" aria-labelledby="aba2-tab">
            <h3>Aba 2</h3>
            <p>Conteúdo da Aba 2...</p>
        </div>
    </div>

    <div class="mb-3">
        <button class="btn btn-sm btn-primary" wire:click="create()">Criar novo Estoque</button>
    </div>

    <!-- Verifica se há estoques a serem exibidos -->
    @if (count($stocks))
    <!-- Tabela estilizada com Bootstrap -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <!-- Cabeçalho da tabela -->
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Criado Em</th>
                <th>Atualizado Em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop para exibir cada estoque -->
            @foreach ($stocks as $stock)
            <tr>
                <!-- Coluna de ID -->
                <td>{{ $stock['id'] }}</td>
                <!-- Coluna de Nome -->
                <td>{{ $stock['nome'] }}</td>
                <!-- Coluna de Data de Criação formatada -->
                <td>{{ $this->dateFormat($stock['created_at']) }}</td>
                <!-- Coluna de Data de Atualização formatada -->
                <td>{{ $this->dateFormat($stock['updated_at']) }}</td>
                <!-- Coluna de Ações -->
                <td>
                    <!-- Botão "Editar" com emoji -->
                    <button title="Renomear" class="btn btn-sm" wire:click="rename({{ $stock['id'] }})">&#x1F3F7;</button>

                    <!-- Botão "Excluir" com emoji -->
                    <button title="Excluir" class="btn btn-sm" wire:click="delete({{ $stock['id'] }})">&#x274C;</button>

                    <!-- Botão "Adicionar Item" com emoji -->
                    <button title="Gerenciar Produtos" class="btn btn-sm" wire:click="addItemToStock({{ $stock['id'] }})">&#x2795;&#x1F4E6;</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <!-- Exibido quando nenhum estoque é encontrado -->
    <p>Nenhum estoque encontrado.</p>
    @endif
</div>