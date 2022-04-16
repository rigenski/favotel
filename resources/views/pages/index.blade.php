@extends('layouts.app')

@section('content')
{{-- <section id="hero">
  <div class="hero-top w-100"></div>
  <div class="hero-bottom">
    <div class="container position-relative">
      <div class="hero-image position-absolute w-100"></div>
      <div class="hero-box">
        <div class="container position-relative p-0">
          <div class="hero-list"></div>
        </div>
      </div>
    </div>
  </div>
</section> --}}
<section id="about" class="py-4">
  <div class="container py-4">
    <div class="about-header pb-4 pb-md-5">
      <h4 class="font-weight-normal text-success text-center spacing-1 text-type-secondary m-0 mx-auto"
        style="max-width: 768px;">
        Vivamus magna justo,
        lacinia eget
        consectetur sed,
        convallis at tellus lectus nibh.</h4>
    </div>
    <div class="about-body">

    </div>
  </div>
</section>
<section id="room" class="py-4 bg-success">
  <div class="container py-4">
    <div class="room-header pb-4 pb-md-5">
      <div class="row">
        <div class="col-12 col-md-8">
          <h6 class="font-weight-bold text-light spacing-4 mb-2">CATEGORY</h6>
          <h1 class="font-weight-bold text-light spacing-2 text-type-secondary m-0">KAMAR</h1>
        </div>
        <div class="col-12 col-md-4">
          <p class="text-light font-weight-semibold m-0">Praesent sapien massa, convallis a pellentesque nec, egestas
            non
            nisi ngoaeg.</p>
        </div>
      </div>
    </div>
    <div class="room-body">
      <div class="row">
        @foreach($rooms as $room)
        <div class="col-12 col-md-6 mb-4">
          <div class="w-100 mb-3 mb-md-4"
            style="background-image: url('{{ $room->image ? asset('images/uploads/rooms/' . $room->image ) : asset('images/app-not-found.svg' ) }}');height: 280px;background-position: center;">
          </div>
          <h4 class="font-weight-bold text-light text-type-secondary mb-1 mb-md-2">{{ ucfirst($room->name) }}</h4>
          <p class="text-light mb-2 mb-md-3">Fasilitas:
            @foreach($room->room_facility as
            $room_facility)
            {{ $room_facility->facility }},
            @endforeach </p>
          <div>
            <button class="btn btn-lg btn-primary">PESAN RESERVASI</button>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
<section id="facility" class="py-4">
  <div class="container py-4">
    <div class="facility-header pb-4 pb-md-5">
      <div class="row">
        <div class="col-12 col-md-8">
          <h6 class="font-weight-bold text-primary spacing-4 mb-2">CATEGORY</h6>
          <h1 class="font-weight-bold text-secondary spacing-2 text-type-secondary m-0">FASILITAS</h1>
        </div>
        <div class="col-12 col-md-4">
          <p class="text-primary font-weight-semibold">Praesent sapien massa, convallis a pellentesque nec, egestas non
            nisi ngoaeg.</p>
        </div>
      </div>
    </div>
    <div class="facility-body">
      <div class="row">
        @foreach($hotel_facilities as $hotel_facility)
        <div class="col-12 col-md-4 mb-5">
          <div class="w-100 mb-4"
            style="background-image: url({{ $hotel_facility->image ? asset('images/uploads/rooms/' . $hotel_facility->image ) : asset('images/app-not-found.svg' ) }});height: 420px;background-position: center;">
          </div>
          <p class="text-primary mb-1 mb-md-2">{{ $hotel_facility->description }}</p>
          <h4 class="font-weight-bold text-secondary text-type-secondary m-0">{{ $hotel_facility->name }}</h4>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection