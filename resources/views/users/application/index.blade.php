@extends('users.layouts.app')

@section('content')

{!! Form::open(['route' => 'configs.store-config', 'method' => 'post' ,'class' => 'form-horizontal']) !!}

@component('back.components.plain')

  @slot('titlePlain')

The Main Configuration Of the web application

  @endslot


  @slot('sectionPlain')

      {!! Form::token() !!}

          @php
            $name = 'name-setting';
            $textLabel = 'Name setting';
            $required = true;
            $class = 'form-control';
          @endphp


				@include('back.partials.formGopen', compact('name', 'required', 'textLabel'))

          {!! Form::text($name, null , ['class' => $class, 'placeholder' => $textLabel ]) !!}

        @include('back.partials.formGend')


          @php
            $name = 'value';
            $textLabel = 'Value';
            $required = true;
            $class = 'form-control';
          @endphp


        @include('back.partials.formGopen', compact('name', 'required', 'textLabel'))

          {!! Form::text($name, null , ['class' => $class, 'placeholder' => $textLabel ]) !!}

        @include('back.partials.formGend')




          @php
            $name = 'type';
            $textLabel = 'Type';
            $required = true;
            $class = 'form-control';
          @endphp


        @include('back.partials.formGopen', compact('name', 'required', 'textLabel'))

          {!! Form::select($name, App\Helpers\Config\Holder::configTypes() , [ 'class' => $class ], App\Helpers\Config\Holder::configTypes(0)) !!}

        @include('back.partials.formGend')


{{--
                        {!! Form::number($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}
                        {!! Form::text($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}
                        {!! Form::tel($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}
                        {!! Form::email($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}
                        {!! Form::textarea($config->slug, $config->value, ['class' => $class, 'placeholder' => $config->nameSetting ]) !!}
                    	{!! Form::file($config->slug, null , ['class' => 'form-control']) !!}
--}}






  

  @endslot


  @slot('footerPlain')

            @include('back.components.button')

  @endslot


@endcomponent

        {!! Form::close() !!}


@endsection