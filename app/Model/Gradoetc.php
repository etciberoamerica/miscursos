<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Gradoetc extends Model
{
    protected $connection = 'mysql_one';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'etclearning_grupos';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'usuario_id',
        'instgrado_id',
        'nombre_moodle_grupo',
        'descripcion_moodle_grupo',
        'enrolmentkey_moodle_grupo',
        'activado_moodle_grupo',
        'fecha_activado_moodle_grupo',
        'keygroup_grupo',
        'instgrupo_grupo',
        'created',
        'modified',
        'estatus_grupo'
    ];





}
