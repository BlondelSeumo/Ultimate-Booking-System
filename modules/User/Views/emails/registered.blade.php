@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            @switch($to)
                @case ('admin')
                <h3 class="email-headline"><strong>{{__('Hello Administrator')}}</strong></h3>
                @break
                @case ('customer')
                <h3 class="email-headline"><strong>{{__('Hello :name',['name'=>$user->getDisplayName() ?? ''])}}</strong></h3>
                @break

            @endswitch
            {!! $content !!}
        </div>
    </div>
@endsection
