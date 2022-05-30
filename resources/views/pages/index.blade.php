@extends('layouts.app')

@section('content')
<section id="hero">
  <div class="hero-top w-100"></div>
  <div class="hero-bottom">
    <div class="container position-relative">
      <img src="{{ asset('images/background-home.png' ) }}" alt="" class="hero-image position-absolute w-100">
      <div class="hero-box">
        <div class="position-relative">
          <div class="hero-list px-3 py-4 px-md-4 px-lg-5 py-lg-4">
            <div class="h-100 d-flex align-center justify-content-between flex-column flex-md-row">
              <div class="d-flex align-items-center justify-content-center pb-3 pb-md-0">
                <div class="form-group w-100 m-0">
                  <label for="check_in" class="text-primary font-weight-bold text-left spacing-1 m-0">Check-in</label>
                  <input type="date" class="form-control text-secondary" id="check_in" name="check_in"
                    autocomplete="off" />
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-center pb-3 pb-md-0">
                <div class="form-group w-100 m-0">
                  <label for="check_out" class="text-primary font-weight-bold text-left spacing-1 m-0">Check-out</label>
                  <input type="date" class="form-control text-secondary" id="check_out" name="check_out"
                    autocomplete="off" />
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-end justify-content-md-center pb-3 pb-md-0">
                <a href="{{ route('checkout') }}" class="btn btn-success btn-lg">
                  PESAN
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="about" class="py-4">
  <div class="container py-4">
    <div class="about-header pb-4 pb-md-5">
      <h4 class="font-weight-normal text-success text-center spacing-1 text-type-secondary m-0 mx-auto"
        style="max-width: 768px;">
        Enjoy your day in comfort with an easy and quality reservation of your favorite hotel.</h4>
    </div>
    <div class="about-body">
      <div class="row">
        <div class="col-12 col-md-6">
          <img src="{{ asset('images/background-about.jpg' ) }}" alt="" class="w-100"
            style="object-fit: cover;height: 400px;">
        </div>
        <div class="col-12 col-md-6 pt-4 pt-md-0">
          <div class="mb-2">
            <h6 class="text-primary mb-2">About</h6>
            <h1 class="font-weight-bold text-secondary text-type-secondary mb-1">{{ count($setting) ? $setting[0]->name
              : 'Hotel
              Title' }}</h1>
            <p class="text-success font-weight-bold m-0">{{ count($setting) ? $setting[0]->description : 'This is hotel
              description' }}</p>
          </div>
          <div class="mb-2">
            <h6 class="text-primary mb-2">Email</h6>
            <h5 class="font-weight-bold text-secondary text-type-secondary m-0">{{ count($setting) ? $setting[0]->email
              :
              'hotel@email.com' }}</h5>
          </div>
          <div class="mb-2">
            <h6 class="text-primary mb-2">Phone</h6>
            <h5 class="font-weight-bold text-secondary text-type-secondary m-0">{{ count($setting) ? $setting[0]->phone
              :
              '081234567890' }}/h5>
          </div>
          <div class="mb-2">
            <h6 class="text-primary mb-2">Address</h6>
            <h5 class="font-weight-bold text-secondary text-type-secondary m-0">{{ count($setting) ?
              $setting[0]->address :
              'jl. hotel address' }}</h5>
          </div>
        </div>
      </div>
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
        <div class="col-12 col-md-4 pt-2 pt-md-0">
          <p class="text-light font-weight-semibold m-0">The room of your choice is determining the quality of your
            life.</p>
        </div>
      </div>
    </div>
    <div class="room-body">
      <div class="row">
        @foreach($rooms as $room)
        <div class="col-12 col-md-6 mb-4">
          <img
            src="{{ $room->image ? asset('images/uploads/rooms/' . $room->image ) : asset('images/app-dummy.svg' ) }}"
            alt="" class="w-100 mb-3 mb-md-4" style="height: 280px;object-fit: cover;">
          <h4 class="font-weight-bold text-light text-type-secondary mb-1 mb-md-2">{{ ucfirst($room->name) }}</h4>
          <p class="text-light mb-2 mb-md-3">Fasilitas:
            @foreach($room->room_facility as
            $room_facility)
            {{ $room_facility->name }},
            @endforeach </p>
          <div>
            <a href="{{ route('checkout') }}" class="btn btn-lg btn-primary">
              PESAN RESERVASI
            </a>
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
        <div class="col-12 col-md-4 pt-2 pt-md-0">
          <p class="text-primary font-weight-semibold">Relying on the best facilities makes activities more productive.
          </p>
        </div>
      </div>
    </div>
    <div class="facility-body">
      <div class="row">
        @foreach($hotel_facilities as $hotel_facility)
        <div class="col-12 col-md-4 mb-5">
          <img
            src="{{ $hotel_facility->image ? asset('images/uploads/hotel-facilities/' . $hotel_facility->image ) : asset('images/app-dummy.svg' ) }}"
            alt="" class="w-100 mb-3 mb-md-4" style="height: 420px;object-fit: cover;">
          <p class="text-primary mb-1 mb-md-2">{{ $hotel_facility->description }}</p>
          <h4 class="font-weight-bold text-secondary text-type-secondary m-0">{{ $hotel_facility->name }}</h4>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection