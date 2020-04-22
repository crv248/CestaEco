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
            <script>
                var latOld = JSON.parse("{{ $user->profile->getLatLong(0) }}");
                var longOld = JSON.parse("{{ $user->profile->getLatLong(1) }}");
            </script>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
<div style="width: 100%; height: 400px;">
    <div style="width: 100%; height: 100%" id="mapIndex"></div>
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
@section('scripts')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMapIndex" async defer></script>
    <script src="/js/mapInput.js"></script>
@stop
