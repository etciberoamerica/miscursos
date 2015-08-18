@extends('layouts/default')
@section('content')
    <style>
        .error-template {padding: 40px 15px;text-align: center;}
        .error-actions {margin-top:15px;margin-bottom:15px;}
        .error-actions .btn { margin-right:10px; }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        408 Error Register moac User</h2>
                    <div class="error-details">
                        lo sentimos ocurrio un error, contacte al administrador con el numerod e error <b>408</b>!
                    </div>
                    <div class="error-actions">
                        <a href="#" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                            Take Me Home </a><a href="http://www.jquery2dotnet.com" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop