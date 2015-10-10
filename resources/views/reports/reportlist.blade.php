
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
