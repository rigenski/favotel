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
          <img
            src="{{ count($setting) ? asset('/images/uploads/setting/' . $setting[0]->short_logo ) :  asset('/images/short-logo-dummy.svg') }}"
            alt="Logo Favotel" style="width: 100px;">
        </div>
      </div>
    </div>
    <div class="facility-body">
      <div class="row">
        @foreach($hotel_facilities as $hotel_facility)
        <div class="col-12 col-md-4 col-lg-3 mb-4">
          <img
            src="{{ $hotel_facility->image ? asset('images/uploads/hotel-facilities/' . $hotel_facility->image ) : asset('images/app-dummy.svg' ) }}"
            alt="" class="w-100 mb-3 mb-md-4" style="height: 320px;object-fit: cover;">
          <p class="text-primary mb-1 mb-md-2">{{ $hotel_facility->description }}</p>
          <h5 class="font-weight-bold text-secondary text-type-secondary m-0">{{ $hotel_facility->name }}</h5>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection