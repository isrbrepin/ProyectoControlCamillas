<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = ['telefono', 'fecha_nacimiento', 'fecha_contratacion', 'vacunado', 'sueldo', 'especialidad_id'];

    protected $casts = [
        'vacunado' => 'boolean',
        'fecha_nacimiento' => 'datetime:Y-m-d',
        'fecha_contratacion' => 'datetime:Y-m-d'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function especialidad(){
        return $this->belongsTo(Especialidad::class);
    }

    public function salas(){
        return $this->hasMany(Sala::class); // one to many
    }

    public function pacientes(){
        return $this->hasManyThrough(Paciente::class, Sala::class); // clase intermedia
    }

    public function getDiasContratadoAttribute(){
        return Carbon::now()->diffInDays($this->fecha_contratacion);
    }
}
