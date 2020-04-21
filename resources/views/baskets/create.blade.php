@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/basket" enctype="multipart/form-data" method="POST">
        <div class="row">
            <div class="col-8 offset-2">
                @csrf

                <div class="row">
                    <h1>Add New Basket</h1>
                </div>
                <div class="row">
                    <label for="name" class="col-md-4 col-form-label">Name</label>
                        <input id="name"
                               type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') }}"
                               autocomplete="name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                </div>
                <div class="row">
                    <label for="weight" class="col-md-4 col-form-label">Weight</label>
                    <input id="weight"
                           type="text"
                           class="form-control @error('weight') is-invalid @enderror"
                           name="weight"
                           value="{{ old('weight') }}"
                           autocomplete="weight">

                    @error('weight')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="row">
                    <label for="price" class="col-md-4 col-form-label">Price</label>
                    <input id="price"
                           type="text"
                           class="form-control @error('price') is-invalid @enderror"
                           name="price"
                           value="{{ old('price') }}"
                           autocomplete="price">

                    @error('caption')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="row">
                    <label for="description" class="col-md-4 col-form-label">description</label>
                    <textarea id="description"
                    type="text"
                    class="form-control @error('caption') is-invalid @enderror"
                    name="description">
                        {{ old('description') }}
                    </textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">

                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror

                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Basket</button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
