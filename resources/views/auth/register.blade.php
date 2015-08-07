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
    <div class="panel panel-default col-md-6 col-lg-6 ">
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-list-alt">
                                                        </span> Datos del Asegurado y Contratante</a>
                    </h4>
                </div>

                <div class="panel-body">

                    <div class="form-group">
                        * {!! Form::label('institucion','Institución') !!}:

                    </div>
                </div>
            </div>


        </div>
    </div>


    <div class="panel panel-default col-md-6 col-lg-6 ">
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-list-alt">
                                                        </span> Datos del Asegurado y Contratante</a>
                    </h4>
                </div>

                <div class="panel-body">

                    <div class="form-group">
                        * {!! Form::label('prod','Producto') !!}

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection