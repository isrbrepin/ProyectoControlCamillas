<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_hora_inicio', 'planta', 'numero_sala', 'medico_id', 'paciente_id'];

    protected $casts = [
        'fecha_hora_inicio' => 'datetime:Y-m-d H:i',
    ];

    public function medico(){
        return $this->belongsTo(Medico::class);
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function medicamentos(){
        return $this->belongsToMany(Medicamento::class)->using(CitaMedicamentoPivot::class)->withPivot('tomas_dia', 'comentarios', 'inicio', 'fin');
    }

    //public function getTiempoHospitalizadoAttribute(){
    //    return Carbon::now()->diffInDays($this->fecha_hora_inicio);
    //}

    public function getPlantaNumeroAttribute()
    {
        return 'Planta: ' . $this->planta . ', Numero: ' . $this->numeroSala;
    }
}
