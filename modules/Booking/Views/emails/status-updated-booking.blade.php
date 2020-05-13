@extends('Email::layout')
@section('content')

    <div class="b-container">
        <div class="b-panel">
            @switch($to)
                @case ('admin')
                <h3 class="email-headline"><strong>{{__('Hello Administrator')}}</strong></h3>
                <p>{{__('The booking status has been updated')}}</p>
                @break

                @case ('vendor')
                <h3 class="email-headline"><strong>{{__('Hello :name',['name'=>$booking->vendor->nameOrEmail ?? ''])}}</strong></h3>
                <p>{{__('The booking status has been updated')}}</p>
                @break


                @case ('customer')
                <h3 class="email-headline"><strong>{{__('Hello :name',['name'=>$booking->first_name ?? ''])}}</strong></h3>
                <p>{{__('Your booking status has been updated')}}</p>
                @break

            @endswitch

            @include($service->email_new_booking_file ?? '')
        </div>
    </div>
@endsection
