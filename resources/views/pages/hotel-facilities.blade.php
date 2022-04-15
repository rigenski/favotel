@extends('layouts.app')

@section('content')
<section id="facility" class="py-4">
  <div class="container py-4">
    <div class="room-header pb-4 pb-md-5">
      <div class="d-flex justify-content-between flex-column flex-md-row">
        <div>
          <h6 class="font-weight-bold text-primary spacing-4 mb-2">CATEGORY</h6>
          <h1 class="font-weight-bold text-secondary spacing-2 text-type-secondary m-0">FASILITAS HOTEL</h1>
        </div>
        <div class="d-none d-md-block">
          <img src="{{ asset('/images/short-logo.svg') }}" alt="Logo Favotel" style="width: 100px;">
        </div>
      </div>
    </div>
    <div class="facility-body">
      <div class="row">
        @foreach($hotel_facilities as $hotel_facility)
        <div class="col-12 col-md-4 col-lg-3 mb-4">
          <div class="w-100 mb-3 mb-md-4"
            style="background-image: url({{ $hotel_facility->image ? asset('images/uploads/rooms/' . $hotel_facility->image ) : asset('images/app-not-found.svg' ) }});height: 320px;background-position: center;">
          </div>
          <p class="text-primary mb-1 mb-md-2">{{ $hotel_facility->name }}</p>
          <h4 class="font-weight-bold text-secondary text-type-secondary m-0">{{ $hotel_facility->description }}</h4>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection