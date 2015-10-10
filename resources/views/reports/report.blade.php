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
                {!! Form::select('isntitucion',$partner,'', ['id'=>'inst_id']) !!}
                <br><br>
                {!! Html::link(route('reports/general/get'), '',['id'=>'reporte','class' =>'glyphicon glyphicon-list-alt','style'=>'color:black']) !!}
            </div>
        </div>
    </div>



    producto_id
    inst_id

    <table class="table" id="table_id">
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
        <tbody id="tbody_id">
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
        <tfoot>
            <tr>
                <td colspan="7">
                    {!! $pagination->render()  !!}
                </td>
            </tr>
        </tfoot>
    </table>

    <script>

        $(window).on('hashchange',function(){
            page = window.location.hash.replace('#','');
            getProducts(page);
        });

        function getProducts(page){
            $.ajax({
                url: 'general/pagination?page=' + page+'&institu='+$('#inst_id').val()+'&producto='+$('#producto_id').val()
            }).done(function(data){
                $('#table_id').empty();
                $('#table_id').html(data);
            });
        }

        $(document).on('click','.pagination a', function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            // getProducts(page);
            location.hash = page;
        });

            $(document).ready(function(){
                var href = $('#reporte').attr('href')+'?institu='+$('#inst_id').val()+'&producto='+$('#producto_id').val();
                $('#reporte').attr('href',href);
                $('#producto_id').change(function(){

                    var val = $(this).val(), inst = $('#inst_id').val();
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
                        success:function(dato){
                            $('#table_id').empty();
                            $('#table_id').html(dato);
                        },error:function(){

                        }
                    });


                });


              var data ={!! $data !!};
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