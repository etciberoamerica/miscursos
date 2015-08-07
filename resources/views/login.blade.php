@extends('layouts/default')

@section('title')
    Bienvenidos a mis cursos ::...
@endsection

@section('scripts')
{!! Html::script('static/assets/js/particles.js') !!}
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="account-wall">
                    <div id="my-tab-content" class="tab-content">
                        <div class="tab-pane active" id="login">
                           
                            {!!   Html::image("static/assets/img/avatar_2x.png", "Logo",array('class'=>'profile-img')) !!}
                          
                            {!! Form::open(array('route' => 'auth/login','class'=>'form-signin form','autocomplete'=>'off')) !!}
                                {!! Form::email('email', '',array('class' => 'form-control','placeholder' => 'Username','required' => 'required','autofocus'=> 'autofocus')) !!} 
                                {!! Form::password('password', array('class' => 'form-control','placeholder' => 'Password','required' => 'required')); !!}
                                {!! Form::submit('Ingresa',array('class' => 'btn btn-lg btn-default btn-block')); !!}
                            {!! Form::close() !!}
                       
                            <div id="tabs" data-tabs="tabs">
                                <p class="text-center">
                                    {!! link_to_route('auth/register','Registrate?') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

