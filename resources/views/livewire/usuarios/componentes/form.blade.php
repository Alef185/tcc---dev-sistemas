<form>
    <div class="px-8 py-4">
        <div class="grid grid-flow-col grid-rows-1">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-grey-darker">Nome Completo:</label>
                <input wire:model.lazy="name" class="w-full uppercase px-3 py-2 border rounded text-grey-darker @error('name') border-red-700 @enderror" type="text" placeholder="Insira o nome completo do usuário">
                @error('name')
                    <small class="text-red-700">{!! $message !!}</small>
                @enderror
            </div>
            <div class="mb-4 ml-4">
                <label class="block mb-2 text-sm font-bold text-grey-darker">Email</label>
                <input wire:model.lazy="email" class="w-full lowercase px-3 py-2 border rounded text-grey-darker @error('email') border-red-700 @enderror" type="text" placeholder="Insira um email válido">
                @error('email')
                    <small class="text-red-700">{!! $message !!}</small>
                @enderror
            </div>
            <div class="mb-4 ml-4">
                <label class="block mb-2 text-sm font-bold text-grey-darker">Nível:</label>
                <select wire:model="nivel"  class="w-full px-3 py-2 border rounded text-grey-darker @error('nivel') border-red-700 @enderror">
                    <option value="">Escolher...</option>
                    @foreach ($niveis as $nivel => $valor)
                    <option value="{{$nivel}}">{{$valor}}</option>
                    @endforeach
                </select>
                @error('nivel')
                    <small class="text-red-700">{!! $message !!}</small>
                @enderror
            </div>
        </div>
        <h2 class="text-center font-thin text-red-500">ATENÇÃO: O Usuário deverá solicitar a troca da senha no primeiro acesso!</h2>
    </div>
</form>
