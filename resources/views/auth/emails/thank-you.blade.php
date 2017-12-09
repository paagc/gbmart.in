@extends('layouts.main')
@section('content')
    <style>
        br{
            display: none;
        }
    </style>
    <div class="page">
        <div class="thankPanel">
            <div class="thankPanelIn">

                <div class="thankTitle">Your Quote request succesfully generated</div>
                <div class="thankBanner"><img src="{{url('images/thanku-banner.jpg')}}"
                                              alt="thank"/>
                    <div class="thankuText"><span>Thank You !</span>
                    <p>Branding @ Central</p>
                    </div>
                </div>
                <div class="thnakBtm">
                    <div class="thanBtns" align="center">
                        <a href="{{url('contact-us')}}" class="btn redBtn">Feedback</a>
                        {{--{{url("download/mou-templates")}}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection