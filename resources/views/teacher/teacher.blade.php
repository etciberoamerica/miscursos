@extends('layouts/default')
@section('content')
<div class="container">
    <div class="row">
        <br><br><br>
        <div class="well text-center">
           <button data-toggle="modal" data-target="#login-modal" type="button" class="btn btn-fresh text-uppercase btn-lg">
               <a href="#" >Crear Grupo</a>
           </button>
        </div>
    </div>
</div>
@if(count($errors)>0)
    <script>
        $(document).ready(function(){
            $('#login-modal').css('display', 'block');
            $('#login-modal').css('padding-left', '17px');
            $('#login-modal').addClass('in');
            $('body').addClass('modal-open');
            $('#conten').addClass('modal-backdrop fade in');
        });
    </script>
@endif
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Crear Grupo </h1><br>
            {!! Form::open(['route' => 'group', 'class' => 'form','id'=>'form-group']) !!}
                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('producto','Seleccione un producto') !!}:
                    {!!  Form::select('Producto', $productos, 0 ,array('id'=>'producto_id','class' => 'form-control')) !!}
                    {!! $errors->first('Producto','<p class="error-message">:message</p>') !!}
                </div>
                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('grado','Grado en la institución') !!}:
                    {!!  Form::select('Grado', $gra, 0 ,array('class' => 'form-control','id'=>'institucion_id')) !!}
                    {!! $errors->first('Grado','<p class="error-message">:message</p>') !!}
                </div>
                <div class="form-group">
                    <span class="require">* </span>
                    {!! Form::label('grupo','Grupo en la institución') !!}:
                    {!! Form::text('Grupo','',['class'=>'form-control','id'=>'grupo_institucion']) !!}
                    {!! $errors->first('Grado','<p class="error-message">:message</p>') !!}
                </div>
                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('descripcion','Descripción:') !!}
                    {!! Form::text('Descripción','',['class'=> 'form-control','id'=>'descripcion']) !!}
                    {!! $errors->first('Descripción','<p class="error-message">:message</p>') !!}
                </div>
                <div class="well text-center">
                    <table align="center" >
                        <thead>
                        <th width="35%"> Producto(s)</th>
                        <th width="1%"> Accion </th>
                        </thead>
                        <tbody id="body_pop" class="body_pop">
                        </tbody>
                    </table>
                </div>
                <input class="btn btn-lg btn-default btn-block" type="submit" value="Guardar">
            {!! Form::close() !!}
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

        console.log($('#body_pop tr').length);

        $('#form-group').submit(function(){
            if($('#body_pop tr').length < 1){
                
            }
            console.log();
            var producto = $.each($('#body_pop'),function($f,$g){

            });
         return false
        });






        function concatProduct(data){
            var html="";
                $.each($('#body_pop'),function($f,$g){
                        html+=$(this).html();
                        });
                html+='<tr id=tr_data_'+data['id']+'>' +
                        '<td align="left">'+data['nombre_producto']+'</td>' +
                        '<td id="eliminar">' +
                        '<span onclick="removeData('+data['id']+')" ' +
                        'style="cursor: pointer" class="glyphicon glyphicon-trash eliminar">' +
                        '</span>'+
                        '<input type="hidden" value='+data['id']+' name="Products[]"></td></tr>';
            $('#body_pop').html(html);
        }
    });
    function removeData(valor){
        $('#tr_data_'+valor).remove()
    }

</script>
    <div id="conten"></div>
@stop