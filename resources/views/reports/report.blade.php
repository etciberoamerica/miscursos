@extends('layouts/default')

@section('title')
    Bienvenidos a mis cursos ::...
@endsection


@section('content')
    <br><br><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style=" padding: 20px 423px;" class="panel-body">
                {!! Form::select('producto',[0=>'-- Seleciona producto --'],'', ['id'=>'producto_id']) !!}
                <br><br>
                {!! Form::select('isntitucion',[0=>'-- Seleciona institución --'],'', ['id'=>'inst_id']) !!}
                <br><br>

                {!! link_to('reports/general/get', $title ='', ['class' =>'glyphicon glyphicon-list-alt','style'=>'color:black'], $secure = null)!!}

            </div>
        </div>
    </div>



    producto_id
    inst_id

    <table class="table">
        <thead>
            <tr class="filters">
                <td  width="10%">Nombre alumno</td>
                <td>Apellido alumno</td>
                <td>Correo Alumno</td>
                <td>Fecha de registro</td>
                <td>Código</td>
                <td>Colegio</td>
                <td>Correo Profesor</td>
            </tr>
        </thead>
        <tbody>
            @foreach($pagination as $p)
                <tr>
                    <td>{!! $p->sName !!}</td>
                    <td>{!! $p->sLastName !!}</td>
                    <td>{!! $p->EmailUsuario !!}</td>
                    <td>{!! $p->dUTCRegistrationDate !!}</td>
                    <td>{!! $p->sCode !!}</td>
                    <td>{!! $p->sTradeName !!}</td>
                    <td>{!! $p->EmailProfesor !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $pagination->render()  !!}
    <script>
            $(document).ready(function(){

                $('#producto_id').change(function(){
                    var val = $(this).val(), inst = $('#inst_id').val();
                    console.log(inst);

                    if(inst != 0){
                        $data = {
                            producto : val,
                            institu  : inst
                        }
                    }else{
                        $data = {
                            producto : val
                        }
                    }
                    $.ajax({
                        url:'general/pagination',
                        type:'GET',
                        data: $data,
                        success:function(data){
                            console.log(data);

                        },error:function(){

                        }
                    });


                });


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

                var data2 =<?php echo  $data2 ?>;
                html2="";
                html2 +='<option value=0>- - Seleciona institución - -</option>';
                $.each(data2,function($i,$data2){
                    html2 +='<option value='+$data2.idPartner+'>';
                    html2 += $data2.sTradeName;
                    html2 +='</option>';
                });
                $('#inst_id').empty();
                $('#inst_id').html(html2);


        });
    </script>

@stop