@extends('layouts/default')


@section('content')
    <br><br><br>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-body" style=" padding: 20px 423px;">
                <div class="col-xs-8">
                    {!!  Form::text('code','',['id'=>'code_id','class'=>'form-control'])    !!}
                </div>
            </div>
        </div>
     </div>


    <br><br><br>
    <div id="tbody">
    <table class="table">
        <thead>
            <tr class="filters">
                <td>Orden </td>
                <td>Licencia</td>
                <td>Idioma</td>
                <td>Fecha Creación</td>
                <td>Fecha Limite</td>
                <td>Cantidad</td>
                <td>activo</td>
                <td>Jasper</td>
                <td>Cargar</td>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $pag)
                <tr>
                    <td>{!! $pag->id !!}</td>
                    <td>{!! $pag->name !!}</td>
                    <td>{!! $pag->idioma !!}</td>
                    <td>{!! $pag->dateadd  !!}</td>
                    <td>{!! $pag->date_limit !!}</td>
                    <td>{!! $pag->quantity !!}</td>
                    <td>{!! $pag->active !!}</td>
                    @if($pag->exis_jsp != $pag->quantity)
                    <td >
                        @if($pag->quantity >= 20)
                            <span data-toggle="modal" data-target="#login-modal" onclick="masive()" style="cursor:pointer;color: red;margin: 10px;" class="glyphicon glyphicon-remove"></span>
                        @else
                            <span data-toggle="modal" data-target="#login-modal" onclick="clickd({!! $pag->id !!})" style="cursor:pointer;color: red;margin: 10px;" class="glyphicon glyphicon-remove"></span>
                        @endif
                    </td>
                    <td>
                        <span class="glyphicon glyphicon-upload" onclick="uploadorder({!! $pag->id !!})" style="cursor:pointer;color: green;margin: 10px;"></span>
                    </td>
                    @else

                        <td>
                            <span  style="cursor:pointer;color: green;margin: 10px;" class="glyphicon glyphicon-ok"></span>
                        </td>
                        <td>
                            <span  style="cursor:pointer;color: green;margin: 10px;" class="glyphicon glyphicon-ok"></span>
                        </td>
                    @endif



                </tr>

            @endforeach
        </tbody>
    </table>
    <br>

    {!! $data->render()  !!}
    </div>




    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog">
            <div class="loginmodal-container">
                <div id="errores" class="alert alert-danger none">
                    La Carga debe de ser masiva.
                </div>
                <div id="remove">
                    <h1>Codigos no existentes</h1><br>
                    <div class="well text-center">
                        {!! Form::open(['route' => 'action/insert', 'class' => 'form','id'=>'form-group','autocomplete'=>'off']) !!}


                        <table align="center" id="mytable" >
                            <thead>
                            <th > Identificador</th>
                            <th > Código </th>
                            <th > Jasper </th>
                            <th>Selecciona <input type="checkbox" id="checkall" /></th>
                            </thead>
                            <tbody id="body_pop" class="body_pop">

                            </tbody>
                        </table>
                        <input type="submit" value="Ingresar" class="btn btn-lg btn-default btn-block">

                        {!! Form::close() !!}

                    </div>

                </div>


            </div>
        </div>
    </div>



    <script>
        $(document).ready(function(){
            $('#form-group').submit(function(event){
                $.ajax({
                    url:'action/insert',
                    data:{
                      valores:$(this).serializeArray()
                    },
                    type:'GET',
                    success:function(data){
                        location.reload();
                    },
                    error:function(){
                        alert('opsssss lo sentimos ocurrio un error  intenta mas tarde');
                    }
                });

                return false;
            });

            $("#mytable #checkall").click(function () {
                if ($("#mytable #checkall").is(':checked')) {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });


            $('#code_id').change(function(){
                var d = $(this).val().trim();
                if(d != ''){
                    $.ajax({
                        url:'find/code',
                        data:{
                            code:d
                        },
                        type:'GET',
                        success:function(data){
                            $('#tbody').html(data);
                        },
                        error:function(){
                            alert('opsssss lo sentimos ocurrio un error  intenta mas tarde');
                        }
                    });
                }
            });
        });

        function uploadorder(id){
            $.ajax({
                url:'order/upload',
                data:{
                    order_id  :id
                },
                type: 'GET',
                success:function(data){
                    location.reload();
                },error:function(){
                    alert('Ocurrio un error intenta mas tarde');
                }
            });
        }

        function masive(){
            $('#errores').removeClass('none');
            $('#remove').empty()
        }

        function clickd(id){
            $('#errores').addClass('none');
            $('#body_pop').empty();
            $.ajax({
                url:'find/order',
                data:{
                   order_id  :id
                },
                type: 'GET',
                success:function(data){
                    var html=''
                    $.each(data,function(index,elemento){
                        html +='<tr>';
                        html +='<td>';
                        html +=elemento.id;
                        html +='</td>';
                        html +='<td>';
                        html +=elemento.key_activation;
                        html +='</td>';
                        html +='<td>'
                        if(!elemento.exist){
                            html += "<span class='glyphicon glyphicon-remove' style='color: red;margin: 10px;'></span>";
                        }else{
                            html +="<span class='glyphicon glyphicon-ok' style='color: green;margin: 10px;'></span>";
                        }
                        html +='</td>' +
                                '<td>';
                        html+=" <input type='checkbox' class='checkthis' name='code[]' id='code[]' value="+elemento.id+" >" +
                                "</td>";
                        html +='</tr>';
                    });
                    $('#body_pop').html(html);
                },error:function(){
                    alert('Ocurrio un error intenta mas tarde');
                }
            });
        }

    </script>


@stop