@extends('users.layouts.app')
<link href="{{ asset('users/css2/test.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@section('content')

    @if($mine2points)

    <div class="alert alert-danger">
        <strong>Note that those links is just for collecting points </strong> Not for getting click.
        <br />
        You need just <strong>{{ GetSetting::getConfig('points-to-activate') - Auth::user()->points }}</strong>clicks !
    </div>

    @endif


    @forelse($links as $link)
        <a href="{{ route('links.surf2', $link->id) }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-{{ \App\Helpers\Common\Holder::template_colors(  array_rand( \App\Helpers\Common\Holder::template_colors() ,1 )  )['slug'] }} hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">link</i>
                    </div>
                    <div class="content">
                        <div class="text">[ {{ \App\Helpers\Common\Holder::linkLevel( $link->level )['name'] . ' class level link'  }} ]</div>
                        
                        <div class="number">
                            <span  class="count-to" data-from="0" data-to="{{ 1 * intval( GetSetting::getConfig('points-multiplication') )}}" data-speed="{{ (1 * intval( GetSetting::getConfig('points-multiplication') )  )/100 }}" data-fresh-interval="{{ (1 * intval( GetSetting::getConfig('points-multiplication') )  )/100 }}">{{ 1 * intval( GetSetting::getConfig('points-multiplication') )}}</span>
                        </div>

                    </div>
                </div>
            </div>
        </a>

    @empty

            <div class="alert alert-warning">

                @if($mine2points && $from == 'mining')


                        <strong>There is no links , sorry for that, we will give you  FREE points to add your link if you report here :</strong>
                        <br/>
                        <button class="btn btn-lg bg-{{ \App\Helpers\Common\Holder::template_colors(  array_rand( \App\Helpers\Common\Holder::template_colors() ,1 )  )['slug'] }} send pull-right" data-path="lake-admin-links">Report</button>




                @elseif($mine2points && $from == 'miningPoints')


                        <strong>There is no links , sorry for that, please report here :</strong>
                        <br/>
                        <button class="btn btn-lg bg-{{ \App\Helpers\Common\Holder::template_colors(  array_rand( \App\Helpers\Common\Holder::template_colors() ,1 )  )['slug'] }} send pull-right" data-path="lake-admin-links-2">Report</button>



                @else

                    <div class="alert alert-warning">
                        <strong>There is no links , sorry for that, please report here :</strong>
                        <br/>
                        <button class="btn btn-lg bg-{{ \App\Helpers\Common\Holder::template_colors(  array_rand( \App\Helpers\Common\Holder::template_colors() ,1 )  )['slug'] }} send pull-right" data-path="lake-of-links">Report</button>

                        <br />

                        <a href="{{ route('links.points_mining')}}">You may like Go mining for some points to be from the best users</a>




                @endif

                <div class="clearfix"></div>
            </div>

    @endforelse

@endsection


@section('scripts')

<script>


    @if( count($links) == 0 )









    $('.send').on('click', function(e){

        $this = $(this);

        $this.attr('disabled', true);

        axios.post('/report/' + $this.data('path'),{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(function(success){

            var data = success.data;

            swal(
                'Good',
                data.message,
                'success'

            );

            window.location = '{{ route('links.mining') }}';



        })
        .catch(function(error){
            console.log(error);

            var data = error.data;

            swal('No',
                data.message,
                'error'

            );

            $this.attr('disabled', false);


        });




    });












    @endif







</script>

@endsection



