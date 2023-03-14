<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Medicamento;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SalaController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Sala::class, 'sala');
    }

    public function index()
    {
        $salas = Sala::orderBy('fecha_hora_inicio', 'desc')->paginate(25);
        if(Auth::user()->tipo_usuario_id == 1){
            $salas = Auth::user()->medico->salas()->orderBy('fecha_hora_inicio', 'desc')->paginate(25);
        }
        elseif(Auth::user()->tipo_usuario_id == 2){
            $salas = Auth::user()->paciente->salas()->orderBy('fecha_hora_inicio', 'desc')->paginate(25);
        }
        return view('/salas/index', ['salas' => $salas]);
    }

    public function create()
    {
        $medicos = Medico::all();
        $pacientes = Paciente::all();
        if(Auth::user()->tipo_usuario_id == 1){
            return view('salas/create', ['medico' => Auth::user()->medico, 'pacientes' => $pacientes]);
        }
        elseif(Auth::user()->tipo_usuario_id == 2) {
            return view('salas/create', ['paciente' => Auth::user()->paciente, 'medicos' => $medicos]);
        }
        return view('salas/create', ['pacientes' => $pacientes, 'medicos' => $medicos]);
    }

    public function store(Request $request)
    {
        $reglas = [
            'fecha_hora_inicio' => 'required|date|after:yesterday',
            'planta' => 'required|string|max:255',
            'numero_sala' => 'required|string|max:255',
            'medico_id' => 'required|exists:medicos,id',
        ];
        if(Auth::user()->tipo_usuario_id == 2){
            $reglas_paciente = ['paciente_id' => ['required', 'exists:pacientes,id', Rule::in(Auth::user()->paciente->id)]];
            $reglas = array_merge($reglas_paciente, $reglas);
        }
        else{
            $reglas_generales = ['paciente_id' => ['required', 'exists:pacientes,id']];
            $reglas = array_merge($reglas_generales, $reglas);
        }
        $this->validate($request, $reglas);
        $sala = new Sala($request->all());
        $sala->save();
        session()->flash('success', 'Sala creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('salas.index');
    }

    public function show(Sala $sala)
    {
        return view('salas/show', ['sala' => $sala]);
    }

    public function edit(Sala $sala)
    {
        //Le paso a la vista los medicamentos porque permito añadir una prescripción desde esa misma vista
        $medicamentos = Medicamento::all();
        $medicos = Medico::all();
        $pacientes = Paciente::all();
        if(Auth::user()->tipo_usuario_id == 1){
            return view('salas/edit', ['sala' => $sala, 'medico' => Auth::user()->medico, 'pacientes' => $pacientes, 'medicamentos' => $medicamentos]);
        }
        elseif(Auth::user()->tipo_usuario_id == 2) {
            return view('salas/edit', ['sala' => $sala, 'paciente' => Auth::user()->paciente, 'medicos' => $medicos, 'medicamentos' => $medicamentos]);
        }
        return view('salas/edit', ['sala' => $sala, 'pacientes' => $pacientes, 'medicos' => $medicos, 'medicamentos' => $medicamentos]);
    }

    public function update(Request $request, Sala $sala)
    {
        $reglas = [
            'fecha_hora_inicio' => 'required|date|after:yesterday',
            'planta' => 'required|string|max:255',
            'numero_sala' => 'required|string|max:255',
            'medico_id' => 'required|exists:medicos,id',
        ];
        if(Auth::user()->tipo_usuario_id == 2){
            $reglas_paciente = ['paciente_id' => ['required', 'exists:pacientes,id', Rule::in(Auth::user()->paciente->id)]];
            $reglas = array_merge($reglas_paciente, $reglas);
        }
        else{
            $reglas_generales = ['paciente_id' => ['required', 'exists:pacientes,id']];
            $reglas = array_merge($reglas_generales, $reglas);
        }
        $this->validate($request, $reglas);
        $sala->fill($request->all());
        $sala->save();
        session()->flash('success', 'Sala modificada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('salas.index');
    }

    public function destroy(Sala $sala)
    {
        if($sala->delete()) {
            session()->flash('success', 'Sala borrado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'La sala no pudo borrarse. Es probable que se deba a que tenga asociada información como salas que dependen de él.');
        }
        return redirect()->route('salas.index');
    }

    public function attach_medicamento(Request $request, Sala $sala)
    {
        $this->validateWithBag('attach',$request, [
            'medicamento_id' => 'required|exists:medicos,id',
            'inicio' => 'required|date',
            'fin' => 'required|date|after:inicio',
            'comentarios' => 'nullable|string',
            'tomas_dia' => 'required|numeric|min:0',
        ]);
        $sala->medicamentos()->attach($request->medicamento_id, [
            'inicio' => $request->inicio,
            'fin' => $request->fin,
            'comentarios' => $request->comentarios,
            'tomas_dia' => $request->tomas_dia
        ]);
        return redirect()->route('salas.edit', $sala->id);
    }

    public function detach_medicamento(Sala $sala, Medicamento $medicamento)
    {
        $sala->medicamentos()->detach($medicamento->id);
        return redirect()->route('salas.edit', $sala->id);
    }
}
