
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
                        * {!! Form::label('institucion','Institución') !!}:
                          {!! Form::select('Institución', $data, 0 ,array('id'=>'id_institucion','class' => 'form-control')) !!}
                          {!! $errors->first('Institución','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('nombre','Nombre') !!}:
                        {!! Form::text('Nombre','',['class'=>'form-control','placeholder'=>'Nombre']) !!}
                        {!! $errors->first('Nombre','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('ap1','Apellido Paterno') !!}:
                          {!! Form::text('Apellido_Paterno','',['class'=>'form-control','placeholder'=>'Apellido Paterno']) !!}
                          {!! $errors->first('Apellido_Paterno','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('ap2','Apellido Materno') !!}:
                        {!! Form::text('Apellido_Materno','',['class'=>'form-control','placeholder'=>'Apellido Materno']) !!}
                        {!! $errors->first('Apellido_Materno','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('pais','País') !!}:
                        {!!  Form::select('País', $dataIns, 0 ,array('id'=>'id_pais','class' => 'form-control')) !!}
                        {!! $errors->first('País','<p class="error-message">:message</p>') !!}

                    </div>
                    <div class="form-group none" id="div-state">
                        * {!! Form::label('estado','Estado') !!}:
                        {!!  Form::select('Estado', array(0=>'-- Selecciona Estado --'), 0 ,array('id'=>'id_estado','class' => 'form-control')) !!}
                        {!! $errors->first('Estado','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('ciudad','Ciudad') !!}:
                        {!! Form::text('Ciudad','',['class'=>'form-control','placeholder'=>'Ciudad']) !!}
                        {!! $errors->first('Ciudad','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('localidad','Localidad') !!}:
                        {!! Form::text('Localidad','',['class'=>'form-control','placeholder'=>'Localidad']) !!}
                        {!! $errors->first('Localidad','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('Genero','Genero') !!}:
                        {!!  Form::radio('Genero', 'M',true) !!}Masculino |
                        {!! Form::radio('Genero', 'F') !!}Femenino
                        {!! $errors->first('Genero','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('fecha nacimiento','Fecha nacimiento') !!}
                        {!! Form::text('Fecha_nacimiento','',['class'=>'form-control','id'=>'datapicker','readonly'=>'readonly']) !!}
                        {!! $errors->first('Fecha_nacimiento','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        * {!! Form::label('email','Email:') !!}
                        {!! Form::email('Email','',['class'=>'form-control','id'=>'id_correo','placeholder'=>'ejemplo@dominio.com']) !!}
                        {!! $errors->first('Email','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        *{!! Form::label('pasword','Password') !!}
                        {!! Form::password('Password',['class'=>'form-control']) !!}
                        {!! $errors->first('Password','<p class="error-message">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        *{!! Form::label('pasword','Confirmacion Password') !!}
                        {!! Form::password('Confirmacion_password',['class'=>'form-control']) !!}
                        {!! $errors->first('Confirmacion_password','<p class="error-message">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        {!! app('captcha')->display() !!}
                        {!! $errors->first('Captcha','<p class="error-message">:message</p>') !!}


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
            format: "dd-mm-yyyy",
            startView: 2,
            language: "es",
            endDate:"{!! date('d-m-Y') !!}}"
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