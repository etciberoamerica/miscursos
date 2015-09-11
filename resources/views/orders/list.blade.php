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
            <td>{!! $pag->date_limit !!}</td>
            @if($pag->exis_jsp == false)
                <td >
                    <span data-toggle="modal" data-target="#login-modal" onclick="clickd({!! $pag->id !!})" style="color: red;margin: 10px;" class="glyphicon glyphicon-remove"></span>
                </td>
            @else
                <td >
                    <span data-toggle="modal" data-target="#login-modal" onclick="clickd({!! $pag->id !!})" style="color: green;margin: 10px;" class="glyphicon glyphicon-ok"></span>
                </td>
            @endif
        </tr>

    @endforeach
    </tbody>
</table>
<br>

{!! $data->render()  !!}