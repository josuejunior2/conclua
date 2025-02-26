<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use HasFactory,  SoftDeletes;

    protected $fillable = ['texto', 'atividade_id', 'comentario_id', 'academico_id', 'orientador_id'];

    public function Atividade()
    {
        return $this->belongsTo(Atividade::class, 'atividade_id');
    }
    
    public function Respondido()
    {
        return $this->belongsTo(Comentario::class, 'comentario_id');
    }

    public function respondidoWithTrashed()
    {
        return $this->belongsTo(Comentario::class, 'comentario_id')->withTrashed();
    }

    public function Orientador()
    {
        return $this->belongsTo(Orientador::class, 'orientador_id');
    }

    public function OrientadorTrashed()
    {
        return $this->belongsTo(Orientador::class, 'orientador_id')->withTrashed();
    }
    
    public function Academico()
    {
        return $this->belongsTo(Academico::class, 'academico_id');
    }

    public function AcademicoTrashed(){
        return $this->belongsTo(Academico::class, 'academico_id')->withTrashed();
    }

    public function Autor()
    {
        if($this->OrientadorTrashed) return $this->OrientadorTrashed->AdminTrashed;
        if($this->AcademicoTrashed) return $this->AcademicoTrashed->UserTrashed;
    }
    
    public function Resposta()
    {
        return $this->hasOne(Comentario::class, 'comentario_id');
    }
    
    public function respostaWithTrashed()
    {
        return $this->hasOne(Comentario::class, 'comentario_id')->withTrashed();
    }

    public function comentarioDoUsuario()
    {
        if(auth()->guard('web')->check()){
            if(!empty($this->Academico->user_id) && auth()->guard('web')->user()->id == $this->Academico->user_id) return true;
        } else if (auth()->guard('admin')->check()) {
            if(!empty($this->Orientador->admin_id) && auth()->guard('admin')->user()->id == $this->Orientador->admin_id) return true;
        }
        return false;
    }
}
