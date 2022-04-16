@extends('layouts.app')

@section('content')
<section id="room" class="py-4">
  <div class="container py-4">
    <div class="room-header pb-4 pb-md-5">
      <div class="d-flex justify-content-between flex-column flex-md-row">
        <div class="mb-2 mb-md-0">
          <h6 class="font-weight-bold text-primary spacing-4 mb-2">CATEGORY</h6>
          <h1 class="font-weight-bold text-secondary spacing-2 text-type-secondary m-0">TIPE KAMAR</h1>
        </div>
        <div>
          <a href="{{ route('checkout') }}" class="btn btn-lg btn-success spacing-2">PESAN SEKARANG</a>
        </div>
      </div>
    </div>
    <div class="room-body">
      <div class="row">
        @foreach ($rooms as $room)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
          <div class="w-100 mb-3 mb-md-4"
            style="background-image: url('{{ $room->image ? asset('images/uploads/rooms/' . $room->image ) : asset('images/app-not-found.svg' ) }}');height: 240px;background-position: center;">
          </div>
          <h4 class="font-weight-bold text-secondary text-type-secondary mb-1 mb-md-2">{{ ucfirst($room->name) }}</h4>
          <p class="text-primary m-0"><b class="text-secondary">Fasilitas:</b>
            @foreach($room->room_facility as $room_facility)
            {{ $room_facility->facility }},
            @endforeach
          </p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection