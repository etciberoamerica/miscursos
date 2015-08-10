
@extends('layouts/default')
 
@section('content')
    <!--
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
 
                <div class="panel-body">
                    {!! Form::open(['route' => 'auth/register', 'class' => 'form']) !!}
 
                        <div class="form-group">
                            <label>name</label>
                            {!! Form::input('text', 'name', '', ['class'=> 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            {!! Form::email('email', '', ['class'=> 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            {!! Form::password('password', ['class'=> 'form-control']) !!}
                        </div>
 
                        <div class="form-group">
                            <label>Password confirmation</label>
                            {!! Form::password('password_confirmation', ['class'=> 'form-control']) !!}
                        </div>
                        <div>
                            {!! Form::submit('send',['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
    -->

<div class="container">
    <br><br><br>
    <div class="panel panel-default col-md-12 col-lg-12 ">
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-user">
                                                        </span> Datos de Registro</a>
                    </h4>
                </div>

                {!! Form::open(['route' => 'auth/register', 'class' => 'form']) !!}
                <div class="panel-body">
                    <div class="form-group">
                        * {!! Form::label('institucion',utf8_encode('Institución')) !!}:
                          {!!  Form::select('institucion', $data, 0 ,array('id'=>'id_institucion','class' => 'form-control')) !!}

                    </div>
                    <div class="form-group">
                        * {!! Form::label('nombre','Nombre') !!}:
                        {!! Form::text('nombre','',['class'=>'form-control','placeholder'=>'Nombre']) !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('ap1','Apellido Paterno') !!}:
                          {!! Form::text('apellido_paterno','',['class'=>'form-control','placeholder'=>'Apellido Paterno']) !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('ap2','Aopellido Materno') !!}:
                        {!! Form::text('apellido_materno','',['class'=>'form-control','placeholder'=>'Apellido Materno']) !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('pais',utf8_encode('País')) !!}:
                        {!!  Form::select('pais', $dataIns, 0 ,array('id'=>'id_pais','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group none" id="div-state">
                        * {!! Form::label('estado',utf8_encode('Estado')) !!}:
                        {!!  Form::select('pais', array(0=>'-- Selecciona Estado --'), 0 ,array('id'=>'id_estado','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('ciudad',utf8_encode('Ciudad')) !!}:
                        {!! Form::text('ciudad','',['class'=>'form-control','placeholder'=>'Ciudad']) !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('localidad',utf8_encode('Localidad')) !!}:
                        {!! Form::text('localidad','',['class'=>'form-control','placeholder'=>'Localidad']) !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('Genero',utf8_encode('Genero')) !!}:
                        {!!  Form::radio('Genero', 'M',true) !!}Masculino |
                        {!! Form::radio('Genero', 'F') !!}Femenino
                    </div>
                    <div class="form-group">
                        * {!! Form::label('fecha nacimiento','Fecha nacimiento') !!}
                        {!! Form::text('Fecha nacimiento','',['class'=>'form-control','id'=>'datapicker','readonly'=>'readonly']) !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('email','Email:') !!}
                        {!! Form::email('email','',['class'=>'form-control','id'=>'id_correo','placeholder'=>'ejemplo@dominio.com']) !!}
                    </div>
                    <div class="form-group">
                        *{!! Form::label('pasword','Password') !!}
                        {!! Form::password('Password',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        *{!! Form::label('pasword','Confirmacion Password') !!}
                        {!! Form::password('Password_dos',['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! app('captcha')->display() !!}

                    </div>
                    <div class="form-group-sm">
                        {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!}
                    </div>

                </div>
                {!! Form::close() !!}
            </div>


        </div>
    </div>



</div>
<script>
    $(document).ready(function(){

        $('#datapicker').datepicker({
            format: "dd/mm/yyyy",
            startView: 2,
            language: "es",
            endDate:"{!! date('d/m/Y') !!}}"
        });

        $('#id_pais').unbind().bind('change',function(){
            if($(this).val() != 0){
                $('#div-state').removeClass('none');
                $.ajax({
                    url : 'state',
                    method:'GET',
                    data:{
                        'id' :$(this).val()
                    },
                    success: function(data){
                        $('#id_estado').empty();
                        $.each(data, function(key, element){
                            $('#id_estado').append("<option value='" + key + "'>" + element + "</option>");
                        });
                    },
                    error: function(){
                        alert('Uppsss ocurrio un error intenta mas tarde');
                    }
                });
            }else{
                $('#div-state').addClass('none');
            }
        });
    });
</script>
@endsection