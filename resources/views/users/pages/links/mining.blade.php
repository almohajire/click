@extends('users.layouts.app')
<link href="{{ asset('users/css2/test.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@section('content')


 @foreach($links as $link)

    <div id="blue-box">

        <div class="website_block" id="1">
            <a class="btn btn-primary btn-lg" href="{{ route('links.surf2', $link->id) }}">VISIT</a>
            <div class="website_title">AdFly 1</div>
                <span class="fa-stack fa-3x fa-lg"><i class="fa fa-square fa-stack-2x text-info"></i><i class="fa fa-money fa-stack-1x text-white"></i>
                </span>
                <div class="coins"><b>Reward</b>: <span>9 coins</span></div>
        <a href="http://127.0.0.1:8000/link/surf" onclick="ModulePopup('1','http://127.0.0.1:8000/link/surf','Skip Ad');" class="visit_button">Visit</a><div class="x-small-circle-or">or</div><a href="javascript:void(0);" onclick="skipuser('1');" class="skip_button">skip</a>
        <div class="website_bottom"><a href="javascript:void(0);" onclick="report_page('1','aHR0cDovL3N3aWZ0dG9waWEuY29tLzRIUHE=','ad_short');">Report</a></div>
         </div>
    </div>
    @endforeach

@endsection


{{ $link->links }}