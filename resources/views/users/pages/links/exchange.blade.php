@extends('users.layouts.app')







@section('content')




    @forelse($links as $link)
        <a href="{{ route('links.surf2', $link->id) }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-{{ \App\Helpers\Common\Holder::template_colors(  array_rand( \App\Helpers\Common\Holder::template_colors() ,1 )  )['slug'] }} hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">{{ \App\Helpers\Common\Holder::linkLevel( $link->level )['icon'] }}</i>
                    </div>
                    <div class="content">
                        <div class="text">[ {{ \App\Helpers\Common\Holder::linkLevel( $link->level )['name'] . ' level link'  }} ]</div>
                        
                        <div class="number">
                            <span  class="count-to" data-from="0" data-to="{{ 1 * intval( GetSetting::getConfig('points-multiplication') )}}" data-speed="{{ (1 * intval( GetSetting::getConfig('points-multiplication') )  )/100 }}" data-fresh-interval="{{ (1 * intval( GetSetting::getConfig('points-multiplication') )  )/100 }}">{{ 1 * intval( GetSetting::getConfig('points-multiplication') )}}</span>
                        </div>

                    </div>
                </div>
            </div>
        </a>

    @empty

            <div class="alert alert-warning">



                <div class="clearfix"></div>
            </div>

    @endforelse

@endsection


@section('scripts')

<script>








</script>

@endsection



