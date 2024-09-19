<div class="container m-5 pt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-4 text-lg font-bold">Contact</h2>

            <!-- Loop para usuários da tabela User -->
            @foreach ($users as $user)
            <button class="p-2 bg-yellow-500 rounded-lg border text-white font-semibold"
                wire:click.prevent="chat('{{ $user->id }}', 'User')">{{ $user->name }}</button>
            @endforeach

            <!-- Loop para profissionais da tabela Profissional -->
            @foreach ($profissionais as $profissional)
            <button class="p-2 bg-yellow-500 rounded-lg border text-white font-semibold"
                wire:click.prevent="chat('{{ $profissional->idContratado }}', 'Profissional')">{{ $profissional->nomeContratado }}</button>
            @endforeach

            <!-- Loop para contratantes da tabela Contratante -->
            @foreach ($contratantes as $contratante)
            <button class="p-2 bg-yellow-500 rounded-lg border text-white font-semibold"
                wire:click.prevent="chat('{{ $contratante->idContratante }}', 'Contratante')">{{ $contratante->nomeContratante }}</button>
            @endforeach

        </div>
    </div>
</div>
