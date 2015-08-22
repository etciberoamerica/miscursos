@extends('layouts/default')

@section('content')
<div class="container">ssssssssss
    <div class="row">
        <br><br><br>
        <div class="well text-center">
           <button data-toggle="modal" data-target="#login-modal" type="button" class="btn btn-fresh text-uppercase btn-lg">
               <a href="#" >Crear Grupo</a>
           </button>
        </div>
    </div>
</div>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Crear Grupo </h1><br>
            <form>

                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('producto','Seleccione un producto') !!}:
                    {!!  Form::select('Producto', $productos, 0 ,array('id'=>'producto_id','class' => 'form-control')) !!}
                    {!! $errors->first('Producto','<p class="error-message">:message</p>') !!}
                </div>

                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('grado','Grado en la institución') !!}:
                    {!!  Form::select('Grado', $gra, 0 ,array('class' => 'form-control')) !!}
                    {!! $errors->first('Grado','<p class="error-message">:message</p>') !!}
                </div>

                <div class="form-group">
                    <span class="require">* </span>
                    {!! Form::label('grupo','Grupo en la institución') !!}:
                    {!! Form::text('Grupo','',['class'=>'form-control']) !!}
                    {!! $errors->first('Grado','<p class="error-message">:message</p>') !!}

                </div>
                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('descripcion','Descripción:') !!}
                    {!! Form::text('Descripción','',['class'=> 'form-control']) !!}
                    {!! $errors->first('Descripción','<p class="error-message">:message</p>') !!}
                </div>
                <div class="well text-center">
                    <table align="center" >
                        <thead>
                        <th> Producto(s)</th>
                        <th> Accion </th>
                        </thead>
                        <tbody id="body_pop" class="body_pop">

                        </tbody>
                    </table>

                </div>
                <input class="btn btn-lg btn-default btn-block" type="submit" value="Guardar">
            </form>


        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#producto_id').unbind().bind('change',function(){
            $.ajax({
                url:'find/product',
                data:{
                producto_id  :$(this).val()
                },
                type: 'GET',
                success:function(data){
                    concatProduct(data);
                },error:function(){
                    alert('Ocurrio un error intenta mas tarde');
                }
            });
        });






        function concatProduct(data){
            var html="";
            lon =1;
            if($('#body_pop tr').length >= 1){
                console.log($('#body_pop tr').length);
                $.each($('#body_pop'),function($f,$g){
                    console.log($(this).html());
                            html+=$(this).html();
                        });
                html+='<tr id=tr_data_'+lon+'><td>'+data['nombre_producto']+'</td>' +
                        '<td class="glyphicon glyphicon-trash"></td></tr>';
            }else{
                html+='<tr id=tr_data_'+lon+'><td>'+data['nombre_producto']+'</td>' +
                        '<td class="glyphicon glyphicon-trash"></td></tr>';
            }
            $('#body_pop').html(html);
        }
    });



</script>

@stop