@extends('users.layouts.app')

@section('content')

{!! Form::open(['route' => 'configs.store', 'files' => true, 'method' => 'post' ,'class' => 'form-horizontal']) !!}

@component('components.plain')

  @slot('titlePlain')

The Main Configuration Of the web application

  @endslot


  @slot('sectionPlain')






      {!! Form::token() !!}

      @php
        $count = 0;
      @endphp


      @foreach($configs as $config)

          @php
            $name = $config->slug;
                    $for = $config->slug;
            $textLabel = $config->nameSetting;
            $required = false;
                    $class = 'form-control'
            
          @endphp


        @include('partials.formGopen', compact('name', 'required', 'for', 'textLabel'))












                    @if( $config->type == 'number' )


                        {!! Form::number($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}

                    @elseif( $config->type == 'text' )


                        {!! Form::text($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}

                    @elseif( $config->type == 'tel' )


                        {!! Form::tel($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}



                    @elseif( $config->type == 'email' )


                        {!! Form::email($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}


                    @elseif( $config->type == 'textarea' )


                        {!! Form::textarea($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}

                    @elseif( $config->type == 'file' )

                      {!! Form::file($config->slug, null , ['class' => 'form-control']) !!}

                        <div class="text-center">

                                <img src="{{ \App\Helpers\Config\Setting::ifImg( $config->slug ) }}" class="img-responsive" width="30%"/>


                        </div>

                        

                    @endif



                        

                    @if ($errors->has($config->slug))
                        <span class="help-block">
                            <strong>{{ $errors->first( $siteSetting->slug ) }}</strong>
                        </span>
                    @endif





        @include('partials.formGend')


        @php
          $count++;
        @endphp


      @endforeach
      








      

  @endslot


  @slot('footerPlain')

            @component('components.button')

              @slot('value')

                enregistrer

              @endslot

            @endcomponent

  @endslot


@endcomponent

        {!! Form::close() !!}


@endsection