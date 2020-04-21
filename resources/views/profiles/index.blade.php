@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileLogo() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-2">
                    <div class="h4">
                        {{ $user->username }}
                    </div>

                    {{-- <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button> --}}

                </div>


            @can('update', $user->profile)
                    <a href="/basket/create">Add new basket</a>
                @endcan

            </div>

            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit profile</a>
            @endcan

            <div class="pt-4 font-weight-bold">{{ $user->profile->location }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
         @foreach($user->baskets as $basket)
            <div class="col-4 pb-4">
                <a href="/p/{{ $basket->id }}">
                    <img src="/storage/{{ $basket->image }}" class="w-100">
                </a>
            </div>
        @endforeach
</div>
</div>
@endsection
