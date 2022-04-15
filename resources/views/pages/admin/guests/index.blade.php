@extends('layouts.admin')
@section('guests', 'active')

@section('title', 'Daftar Tamu')

@section('content')
<div class="card mb-4">
  <div class="card-body">
    @if(!count($guests))
    <div class="alert alert-danger">
      * <b>DATA TAMU</b> TIDAK ADA / BELUM DITAMBAHKAN
    </div>
    @endif
    <div class="table-responsive">
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
          <?php $count = 1; ?>
          @foreach ($guests as $data)
          <tr>
            <td>{{ $count }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>
              <a href="#modal-detail" data-toggle="modal" class="btn btn-primary m-1"
                onclick="$('#modal-detail #detail-name').text('{{ $data->name }}');$('#modal-detail #detail-email').text('{{ $data->email }}');$('#modal-detail #detail-phone').text('{{ $data->phone }}');$('#modal-detail #detail-address').text('{{ $data->address }}');">Detail</a>
              <a href=" #" class="btn btn-success m-1">Histori</a>
              <div class="dropdown d-inline mr-2">
                <button class="btn btn-info dropdown-toggle m-1" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Lainya
                </button>
                <div class="dropdown-menu">
                  <a href="#modal-delete" data-toggle="modal" class="dropdown-item text-danger font-weight-bold"
                    onclick="$('#modal-delete #form-delete').attr('action', '/admin/guests/{{ $data->id }}/destroy');$('#modal-delete #delete-name').text('{{ $data->name }}');$('#modal-delete #delete-email').text('{{ $data->email }}');$('#modal-delete #delete-phone').text('{{ $data->phone }}');$('#modal-delete #delete-address').text('{{ $data->address }}');">Hapus</a>
                </div>
              </div>
            </td>
          </tr>
          <?php $count++ ?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('modal')
{{-- MODAL EXPORT --}}
<div class="modal fade" id="modal-export" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Export Excel Data <span class="text-primary">
            Tamu</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table>
          <tr class="align-top">
            <td>Total Data</td>
            <td class="px-2">:</td>
            <td><b class="text-primary">100</b></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <form id="form-delete" action="" method="get">
          <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">Export</button>
        </form>
      </div>
    </div>
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