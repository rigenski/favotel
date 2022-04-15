@extends('layouts.app')

@section('content')
<section id="login" class="py-5">
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
    <div class="login-header pb-4 pb-md-5">
      <h6 class="font-weight-bold text-primary text-center spacing-4">
        BUKTI
      </h6>
      <h1 class="font-weight-bold text-secondary text-center spacing-2 text-type-secondary">
        RESERVASI
      </h1>
    </div>
    <div class="login-body pb-4 pb-md-5">
      <div class="row">
        <div class="col-12 col-md-2 d-none d-block"></div>
        <div class="col-12 col-md-8">
          <div class="mb-4">
            <h4 class="font-weight-bold text-secondary mb-3">DETAIL TAMU</h4>
            <table class="table table-borderless table-responsive">
              <tr class="pb-2">
                <td class="px-0 py-0">
                  Nama
                </td>
                <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                  : {{ $reservation->guest_name }}
                </td>
              </tr>
              <tr class="pb-2">
                <td class="px-0 py-0">
                  Email
                </td>
                <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                  : {{ $reservation->email }}
                </td>
              </tr>
              <tr class="pb-2">
                <td class="px-0 py-0">
                  Phone
                </td>
                <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                  : {{ $reservation->phone }}
                </td>
              </tr>
            </table>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6">
              <div class="mb-4">
                <h4 class="font-weight-bold text-secondary mb-3">DETAIL RESERVASI</h4>
                <table class="table table-borderless table-responsive">
                  <tr class="pb-2">
                    <td class="px-0 py-0">
                      Check-In
                    </td>
                    <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                      : {{ $reservation->check_in }}
                    </td>
                  </tr>
                  <tr class="pb-2">
                    <td class="px-0 py-0">
                      Check-Out
                    </td>
                    <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                      : {{ $reservation->check_out }}
                    </td>
                  </tr>
                  <tr class="pb-2">
                    <td class="px-0 py-0">
                      Tipe Kamar
                    </td>
                    <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                      : {{ $reservation->room->name }}
                    </td>
                  </tr>
                  <tr class="pb-2">
                    <td class="px-0 py-0">
                      Total Kamar
                    </td>
                    <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                      : {{ $reservation->total_rooms }}
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="mb-4">
                <h4 class="font-weight-bold text-secondary mb-3">DETAIL PEMBELIAN</h4>
                <table class="table table-borderless table-responsive">
                  <tr class="pb-2">
                    <td class="px-0 py-0">
                      Harga
                    </td>
                    <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                      : Rp. {{ $reservation->room->cost }}
                    </td>
                  </tr>
                  <tr class="pb-2">
                    <td class="px-0 py-0">
                      Total Kamar
                    </td>
                    <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                      : {{ $reservation->total_rooms }}
                    </td>
                  </tr>
                  <tr class="pb-2">
                    <td class="px-0 py-0">
                      Total Hari
                    </td>
                    <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                      : {{ $total_days }}
                    </td>
                  </tr>
                  <tr class="pb-2">
                    <td class="px-0 py-0">
                      Jumlah Pembayaran
                    </td>
                    <td class="px-0 py-0 pl-3 font-weight-semibold text-secondary">
                      : Rp. {{ $reservation->total_cost }}
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="row mt-4 mt-md-5">
            <div class="col-12 col-md-4 order-2 order-md-1">
              <a href="{{ route('guest') }}" class="btn btn-secondary btn-lg w-100">
                KEMBALI
              </a>
            </div>
            <div class="col-12 col-md-8 order-1 order-md-2">
              <a href="#" class="btn btn-success btn-lg w-100 mb-2 mb-md-0">
                CETAK BUKTI
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-2 d-none d-block"></div>
      </div>
    </div>
  </div>
</section>
@endsection

{{-- <tr>
  <td class="font-weight-bold text-primary">Status :</td>
  <td class="font-weight-bold text-success">SUKSES</td>
</tr>
<tr>
  <td class="font-weight-bold text-primary">Nama :</td>
  <td class="font-weight-bold text-secondary">{{ $reservation->guest_name }}</td>
</tr>
<tr>
  <td class="font-weight-bold text-primary">Tipe Kamar :</td>
  <td class="font-weight-bold text-secondary">{{ $reservation->room->name }}</td>
</tr>
<tr>
  <td class="font-weight-bold text-primary">Total Kamar :</td>
  <td class="font-weight-bold text-secondary">{{ $reservation->total_rooms }}</td>
</tr>
<tr>
  <td class="font-weight-bold text-primary">Total Harga :</td>
  <td class="font-weight-bold text-danger">Rp, {{ $reservation->total_cost }}</td>
</tr> --}}