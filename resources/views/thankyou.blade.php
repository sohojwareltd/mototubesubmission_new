@extends('layouts.app')

@section('content')
<div class="landing-screen landing-screen-thankyou">
    <div class="container">
        <div class="landing-content">
            <div class="thankyou-check wow zoomIn" data-wow-delay="0.6s">
                <svg width="126" height="111" viewBox="0 0 126 111" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="55.5" cy="55.5" r="55.5" fill="#252525"/>
                    <path d="M116.842 0L62.5105 59.7355L46.7368 47.7592H37.9736L62.5105 87.6316L125.605 0H116.842Z" fill="white"/>
                </svg>
            </div>
            <h3 class="wow fadeInLeft" data-wow-delay="0.1s">thank you for</h3>
            <h1 class="wow fadeInRight" data-wow-delay="0.1s"><span>your submission</span></h1>
            <a href="{{route('submit.page')}}" class="page-btn page-btn-primary wow fadeInUp" data-wow-delay="0.1s"><span>submit another video</span></a>
        </div>
    </div>
    <div class="landing-right-graphics wow fadeInRight" data-wow-delay="0.6s">
        <svg width="334" height="1080" viewBox="0 0 334 1080" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="702" cy="582" r="702" fill="#C20000"/>
            <circle cx="694" cy="583" r="645" fill="#C20000" stroke="white" stroke-width="12"/>
            <circle cx="891" cy="554" r="702" fill="#AC0000"/>
        </svg>
        <svg width="96" height="1080" viewBox="0 0 96 1080" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="702" cy="613" r="702" fill="#C20000"/>
            <circle cx="684" cy="614" r="645" fill="#C20000" stroke="white" stroke-width="12"/>
            <circle cx="781" cy="585" r="702" fill="#AC0000"/>
        </svg>
        <div class="landing-right-logo wow fadeInRight" data-wow-delay="0.8s">
            <img src="{{asset('images/landing-right-logo.png')}}" alt="">
        </div>
    </div>
    <div class="landing-left-graphics wow fadeInLeft" data-wow-delay="0.4s">
        <img src="{{asset('images/left-graphics.png')}}" alt="">
    </div>
</div>
@stop
