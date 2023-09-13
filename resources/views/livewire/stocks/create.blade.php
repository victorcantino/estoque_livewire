<div>
    <form wire:submit.prevent="save">
        <fieldset class="border p-3 mb-3">
            <legend class="w-auto px-2">{{ $title }}</legend>
            <div class="mb-3">
                <input type="hidden" wire:model="form.id">
                <input type="text" wire:model="form.nome" placeholder="Nome do estoque...">
                @error('form.nome') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-sm btn-primary" type="submit">Salvar</button>
                <button class="btn btn-sm btn-secondary" wire:click.prevent="clear">Cancelar</button>
            </div>
        </fieldset>
    </form>
</div>