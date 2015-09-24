@extends('layouts/default')

@section('title')
    Bienvenidos a mis cursos ::...
@endsection


@section('content')
    <br><br><br><br><br><br><br><br><br>
    {!! Form::select('producto',[0=>'-- Seleciona producto --'],'', ['id'=>'producto_id']) !!}





        <script>
            $(document).ready(function(){
              var data =<?php echo  $data ?>;
                html="";
                html +='<option value=0>- - Seleciona producto - -</option>';
               $.each(data,function($i,$data){
                   html +='<option value='+$data.idVersion+'>';
                    html += $data.sVersion +' '+$data.sApp
                   html +='</option>';
            });
                $('#producto_id').empty();
                $('#producto_id').html(html);


        });
    </script>

@stop