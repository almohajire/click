@extends('users.layouts.app')
<link href="{{ asset('users/css2/test.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@section('content')

    @if($mine2points)

    <div class="alert alert-danger">
        <strong>Note that those links is just for collecting points </strong> Not for getting click.
        <br />
        You need {{ GetSetting::getConfig('points-to-activate') }} clicks !
    </div>

    @endif


    @foreach($links as $link)
        <a href="{{ route('links.surf2', $link->id) }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-{{ \App\Helpers\Common\Holder::template_colors(  array_rand( \App\Helpers\Common\Holder::template_colors() ,1 )  )['slug'] }} hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">link</i>
                    </div>
                    <div class="content">
                        <div class="text">Visite and get</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{ 1 * intval( GetSetting::getConfig('points-multiplication') )}}</div>
                    </div>
                </div>
            </div>
        </a>

    @endforeach

@endsection



