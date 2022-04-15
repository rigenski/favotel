@extends('layouts.app')

@section('content')
<section id="checkout" class="py-4">
  @if(session('success'))
  <div class="container mb-4">
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  @elseif(session('error'))
  <div class="container mb-4">
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  @endif
  <div class="container py-5">
    <div class="checkout-header pb-4 pb-md-5">
      <h6 class="font-weight-bold text-primary text-center spacing-4">
        PESAN
      </h6>
      <h1 class="font-weight-bold text-secondary text-center spacing-2 text-type-secondary">
        RESERVASI
      </h1>
    </div>
    <div class="checkout-body pb-4 pb-md-5">
      <form action="{{ route('checkout.store') }}" method="post">
        @csrf
        <div class="row">
          <div class="col-12 col-md-2 d-none d-block"></div>
          <div class="col-12 col-md-8">
            <div class="row">
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="check_in" class="text-primary font-weight-bold text-left spacing-1 m-0">Check-in <span
                      class="text-danger">*</span></label>
                  <input type="date" class="form-control text-secondary" id="check_in" name="check_in"
                    autocomplete="off" required />
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="check_out" class="text-primary font-weight-bold text-left spacing-1 m-0">Check-out <span
                      class="text-danger">*</span></label>
                  <input type="date" class="form-control text-secondary" id="check_out" name="check_out"
                    autocomplete="off" required />
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="total_rooms" class="text-primary font-weight-bold text-left spacing-1 m-0">Total Kamar
                    <span class="text-danger">*</span></label>
                  <input type="number" class="form-control text-secondary" id="total_rooms" name="total_rooms"
                    autocomplete="off" required />
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-2 d-none d-block"></div>
        </div>
        <div class="row">
          <div class="col-12 col-md-1 d-none d-md-block"></div>
          <div class="col-12 col-md-10">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="guest_name" class="text-primary font-weight-bold text-left spacing-1 m-0">Nama Tamu <span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control text-secondary" id="guest_name" name="guest_name"
                    autocomplete="off" value="{{ $guest->name ? $guest->name : '' }}" required />
                </div>
                <div class="form-group">
                  <label for="phone" class="text-primary font-weight-bold text-left spacing-1 m-0">No. HP <span
                      class="text-danger">*</span></label>
                  <input type="number" class="form-control text-secondary" id="phone" name="phone" autocomplete="off"
                    value="{{ $guest->phone ? $guest->phone : '' }}" required />
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="email" class="text-primary font-weight-bold text-left spacing-1 m-0">Email <span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control text-secondary" id="email" name="email" autocomplete="off"
                    required value="{{ $guest->email ? $guest->email : '' }}" />
                </div>
                <div class="form-group">
                  <label for="room_type" class="text-primary font-weight-bold text-left spacing-1 m-0">Tipe Kamar <span
                      class="text-danger">*</span></label>
                  <select class="form-control text-secondary" id="room_type" name="room_type" required>
                    <option class="text-secondary font-weight-bold" value="">-- Pilih Tipe Kamar --</option>
                    @foreach($rooms as $room)
                    <option class="text-secondary font-weight-bold" value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-1 d-none d-md-block"></div>
        </div>
        <div class="row">
          <div class="col-12 col-md-1 d-none d-md-block"></div>
          <div class="col-12 col-md-10">
            <div class="row mt-4 mt-md-5">
              <div class="col-12 col-md-4 order-2 order-md-1">
                <a href="{{ route('guest') }}" type="button" class="btn btn-secondary btn-lg w-100">
                  KEMBALI
                </a>
              </div>
              <div class="col-12 col-md-8 order-1 order-md-2">
                <button type="submit" class="btn btn-primary btn-lg  w-100 mb-2 mb-md-0">
                  KONFIRMASI
                </button>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-1 d-none d-md-block"></div>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection