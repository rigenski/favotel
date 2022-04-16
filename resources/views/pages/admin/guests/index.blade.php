@extends('layouts.admin')
@section('guests', 'active')

@section('title', 'Daftar Tamu')

@section('content')
<div class="card mb-4">
  <div class="card-header row">
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-start">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-filter">
          Filter
        </button>
      </div>
    </div>
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-end flex-column">
        @if(session('success'))
        <div class="alert alert-success p-1 px-4 m-0">
          {{ session('success') }}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger p-1 px-4 m-0">
          {{ session('error') }}
        </div>
        @endif
      </div>
    </div>
  </div>
  <div class="card-body">
    @if(!count($guests))
    <div class="alert alert-danger">
      * <b>DATA TAMU</b> TIDAK ADA / BELUM DITAMBAHKAN
    </div>
    @endif
    <div class="table-responsive mb-2">
      <table class="table table-striped table-bordered data">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($guests as $key => $guest)
          <tr>
            <td>{{ $guests->firstItem() + $key }}</td>
            <td>{{ $guest->name }}</td>
            <td>{{ $guest->email }}</td>
            <td>
              <a href="#modal-detail" data-toggle="modal" class="btn btn-primary m-1"
                onclick="$('#modal-detail #detail-name').text('{{ $guest->name }}');$('#modal-detail #detail-email').text('{{ $guest->email }}');$('#modal-detail #detail-phone').text('{{ $guest->phone }}');$('#modal-detail #detail-address').text('{{ $guest->address }}');">Detail</a>
              <a href=" #" class="btn btn-success m-1">Histori</a>
              <div class="dropdown d-inline mr-2">
                <button class="btn btn-info dropdown-toggle m-1" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Lainya
                </button>
                <div class="dropdown-menu">
                  <a href="#modal-delete" data-toggle="modal" class="dropdown-item text-danger font-weight-bold"
                    onclick="$('#modal-delete #form-delete').attr('action', '/admin/guests/{{ $guest->id }}/destroy');$('#modal-delete #delete-name').text('{{ $guest->name }}');$('#modal-delete #delete-email').text('{{ $guest->email }}');$('#modal-delete #delete-phone').text('{{ $guest->phone }}');$('#modal-delete #delete-address').text('{{ $guest->address }}');">Hapus</a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="pagination">
      {{ $guests->appends(['keyword' => $filter->keyword ? $filter->keyword : ''])->links() }}
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- MODAL FILTER -->
<div class="modal fade" id="modal-filter" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-create" class="modal-content" action="{{ route('admin.guests') }}" method="get">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Filter Data <span class="text-primary">Tamu</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class=" form-group">
          <label for="guest">Keyword</label>
          <input type="text" class="form-control @error('guest') is-invalid @enderror" id="keyword" name="keyword"
            value="{{ $filter->keyword ? $filter->keyword : '' }}">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <a href="{{ route('admin.guests') }}" class="btn btn-warning m-0"><i class="fas fa-retweet"></i></a>
        <div>
          <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary">Cari</button>
        </div>
      </div>
    </form>
  </div>
</div>
{{-- MODAL DETAIL --}}
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Data <span class="text-primary">
            Tamu</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table>
          <tr class="align-top">
            <td>Nama</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-name"></b></td>
          </tr>
          <tr class="align-top">
            <td>Email</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-email"></b></td>
          </tr>
          <tr class="align-top">
            <td>No. HP</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-phone"></b></td>
          </tr>
          <tr class="align-top">
            <td>Alamat</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-address"></b></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
{{-- MODAL DELETE --}}
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-delete" class="modal-content" action="" method="get">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin Hapus Data <span class="text-primary">
            Tamu</span> Ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table>
          <tr class="align-top">
            <td>Nama</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-name"></b></td>
          </tr>
          <tr class="align-top">
            <td>Email</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-email"></b></td>
          </tr>
          <tr class="align-top">
            <td>No. HP</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-phone"></b></td>
          </tr>
          <tr class="align-top">
            <td>Alamat</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-address"></b></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>
@endsection