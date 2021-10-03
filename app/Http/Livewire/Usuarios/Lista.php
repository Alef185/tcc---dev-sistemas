<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use App\Models\{Team, User};
use DB;
use Str;

class Lista extends Component
{
    public $modalDelete = false;
    public $modalRestore = false;
    public $showModalNew = false;

    public $bloqueados;
    public $itensPaginas = 10;
    public $termo;

    public $usuarioFake;
    public $nivel;

    public $name;
    public $email;

    public function resetData(){
        $this->reset();
    }

    //neste caso o metodo tem que chamar rules mesmo
    protected $rules = [
        'name' => "required|string|min:3",
        'email' => "required|email|unique:users,email"
    ];
    protected $messages = [
        'name.required' => 'O campo <strong>Nome do Usuário</strong> é obrigatório',
        'name.min' => 'O campo <strong>Nome do Usuário</strong> precisa ter no mínimo 3 caracteres',
        'email.required' => 'O campo <strong>E-mail</strong> é obrigatório sua besta',
    ];
    public function rules(){
        return [
            'name' => "required|string|min:3",
            'email' => "required|email|unique:users,email"
        ];
    }
    public function regrasAlteracao(){
        return [
            'name' => "required|string|min:3",
            'email' => "required|email|unique:users,email,".$idUsuario
        ];
    }

    public function messages(){
        return [
            'name.required' => 'O campo <strong>Nome do Usuário</strong> é obrigatório',
            'name.min' => 'O campo <strong>Nome do Usuário</strong> precisa ter no mínimo 3 caracteres',
            'email.required' => 'O campo <strong>E-mail</strong> é obrigatório sua besta',
        ];
    }
    public function mensagemAlteracao(){
        return [
            'name.required' => 'O campo <strong>Nome do Usuário</strong> é obrigatório',
            'name.min' => 'O campo <strong>Nome do Usuário</strong> precisa ter no mínimo 3 caracteres',
            'email.required' => 'O campo <strong>E-mail</strong> é obrigatório sua besta',
            'email.unique' => 'Este email já está sendo utilizado'
        ];
    }

    public function mount(){
        //atribui as regras de validdacao no carregamento da tela
        $this->rules = $this->rules();
        $this->messages = $this->messages();
    }


    public function render(){
        if($this->termo){
            if( !$this->bloqueados ){
                $usuarios = User::where('name', 'like', '%'.$this->termo.'%')->orderBy('name')->paginate($this->itensPaginas);
            }else{
                $usuarios = User::withTrashed()->where('name', 'like', '%'.$this->termo.'%')->orderBy('name')->paginate($this->itensPaginas);
            }
        }else{
            if( !$this->bloqueados ){
                $usuarios = User::orderBy('name')->paginate($this->itensPaginas);
            }else{
                $usuarios = User::withTrashed()->orderBy('name')->paginate($this->itensPaginas);
            }
        }
        $niveis = collect([0 => 'ADMINISTRADOR', 10 => 'GERENTE', 99 => 'COMUM']);
        return view('livewire.usuarios.lista')->withUsuarios($usuarios)->withNiveis($niveis);
    }

    public function remover($id){
        $this->usuarioFake = User::findOrFail(decrypt($id));
        $this->modalDelete = true;
    }

    public function delete($id){
        try {
            $usuario = User::findOrFail(decrypt($id));
            // $usuario->team->delete();
            $usuario->delete();
            session()->flash('success', "Usuário bloqueado com sucesso!");
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
        $this->reset();
    }

    public function restaurar($id){
        $this->usuarioFake = User::withTrashed()->findOrFail(decrypt($id));
        $this->modalRestore = true;
    }

    public function restore($id){
        try {
            $usuario = User::withTrashed()->findOrFail(decrypt($id));
            $usuario->restore();
            session()->flash('success', "Usuário restaurado com sucesso!");
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
        $this->reset();
    }

    public function create(){
        $this->validate();
        DB::beginTransaction();
        try {
            $usuario = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Str::random(40)
            ]);
            $time = Team::create([
                'name' => "Time " . $usuario->name,
                'personal_team' => '1',
                'user_id' => $usuario->id
            ]);
            $usuario->current_team_id = $time->id;
            $usuario->save();
            DB::commit();
            session()->flash('success', "Usuário cadastrado com sucesso!");
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', $ex->getMessage());
        }
        $this->reset();
        $this->dispatchBrowserEvent('click');
    }
}
