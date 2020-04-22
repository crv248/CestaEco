@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="POST">
        <div class="row">
            <div class="col-8 offset-2">
                @csrf
                @method('PATCH')

                <div class="row">
                    <h1>Edit Profile</h1>
                </div>
                <div class="row">
                    <label for="name" class="col-md-4 col-form-label">Name</label>
                    <input id="name"
                           type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') ?? $user->name }}"
                           autocomplete="location">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="address_address">Address</label>
                    <input type="text" id="address-input" name="address_address" class="form-control map-input">
                    <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                    <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                </div>
                <script>
                    var latOld = JSON.parse("{{ $user->profile->getLatLong(0) }}");
                    var longOld = JSON.parse("{{ $user->profile->getLatLong(1) }}");
                </script>

                <div id="address-map-container" style="width:100%;height:400px; ">
                    <div style="width: 100%; height: 100%" id="mapEdit"></div>
                </div>
                <div class="row">
                    <label for="location" class="col-md-4 col-form-label">Location</label>
                    <input id="location"
                           type="text"
                           class="form-control @error('location') is-invalid @enderror"
                           name="location"
                           value="{{ old('location') ?? $user->profile->location }}"
                           autocomplete="location">

                    @error('location')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>
                    <input id="description"
                           type="text"
                           class="form-control @error('description') is-invalid @enderror"
                           name="description"
                           value="{{ old('description') ?? $user->profile->description }}"
                           autocomplete="description">

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <label for="url" class="col-md-4 col-form-label">Url</label>
                    <input id="url"
                           type="text"
                           class="form-control @error('url') is-invalid @enderror"
                           name="url"
                           value="{{ old('url') ?? $user->profile->url }}"
                           autocomplete="url">

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Profile image</label>
                    <input type="file" class="form-control-file" id="image" name="logo">

                    @error('image')
                    <strong>{{ $message }}</strong>
                    @enderror

                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save profile</button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
@section('scripts')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMapEdit" async defer></script>
    <script src="/js/mapInput.js"></script>
@stop
