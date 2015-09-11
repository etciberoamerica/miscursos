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

            <table class="table">
                <thead>
                <tr class="filters">
                    <th>#</th>
                    <th>Key Group</th>
                    <th>Nombre del grupo</th>
                    <th>Fecha</th>
                    <th>Productos</th>
                    <th>Alumnos</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach($group as $g)
                    <tr>
                        <td>{!! $i !!}</td>
                        <td>{!! $g->key !!}</td>
                        <td>{!! $g->gruop_institution !!}</td>
                        <td>{!! $g->created_at->format('Y/m/d H:ia') !!}</td>
                        <td></td>
                        <td></td>
                        <td>

                            <span class='glyphicon glyphicon-eye-open' style="margin-right: 15px;"></span>

                            <span class='glyphicon glyphicon-plus'></span>

                        </td>
                    </tr>
                    <?php $i++;?>
                @endforeach
                </tbody>
            </table>
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
                <div id="errores" class="alert alert-danger none">
                </div>
                <h1>Crear Grupo </h1><br>
                {!! Form::open(['route' => 'teacher', 'class' => 'form','id'=>'form-group','autocomplete'=>'off']) !!}
                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('producto','Seleccione un producto') !!}:
                    {!!  Form::select('Producto', $productos, 0 ,array('id'=>'producto_id','class' => 'form-control')) !!}
                    {!! $errors->first('Producto','<p class="error-message">:message</p>') !!}
                </div>
                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('grado','Grado en la institución') !!}:
                    {!!  Form::select('Grado', $gra, 0 ,array('class' => 'form-control','id'=>'grado_id')) !!}
                    {!! $errors->first('Grado','<p class="error-message">:message</p>') !!}
                </div>
                <div class="form-group">
                    <span class="require">* </span>
                    {!! Form::label('grupo','Grupo en la institución') !!}:
                    {!! Form::text('Grupo','',['class'=>'form-control','id'=>'grupo_id']) !!}
                    {!! $errors->first('Grupo','<p class="error-message">:message</p>') !!}
                </div>
                <div class="form-group">
                    <span class="require">*</span>
                    {!! Form::label('descripcion','Descripción:') !!}
                    {!! Form::text('Descripción','',['class'=> 'form-control','id'=>'descripción_id']) !!}
                    {!! $errors->first('Descripción','<p class="error-message">:message</p>') !!}
                </div>
                <div class="well text-center">
                    <table align="center" >
                        <thead>
                        <th width="35%"> Producto(s)</th>
                        <th width="1%"> Accion </th>
                        </thead>
                        <tbody id="body_pop" class="body_pop">
                        @if(Session::has('table'))
                            {!! Session::get('table') !!}
                        @endif
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
            $('#form-group').submit(function(){
                var ar =$(this).serializeArray();
                var dataSpace = removeSpaceArray(ar);
                var mensajes = [];
                if($('#body_pop tr').length == 0){
                    mensajes.push("Seleciona al menso un producto");
                }
                $.each(dataSpace,function($i,$value){
                    if($value.name != '_token'){
                        if(mensajes.length == 0){
                            $re = checkVacu($value.value , $value.name);
                            if($re != ""){
                                mensajes.push($re);
                                $("#"+$value.name.toLowerCase()+"_id").focus();
                            }
                            $re2 = matchCadena($value.value , $value.name);
                            if($re2 != "") {
                                mensajes.push($re2);
                                $("#" + $value.name.toLowerCase() + "_id").focus();
                            }
                        }
                    }
                });
                var html ="";
                html += "<ul>";
                for (var i = 0, errorLength = mensajes.length; i < errorLength; i++) {
                    html +="<li>"+mensajes[i]+"</li>"
                }
                html += "</ul>";
                $('#errores').html(html);
                if(mensajes.length >=1){
                    $('#errores').removeClass('none');
                    return false;
                }
                $('#errores').addClass('none');
                return true;
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