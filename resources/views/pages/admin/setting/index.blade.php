@extends('layouts.admin')
@section('setting', 'active')

@section('title', 'Pengaturan Hotel')

@section('content')
<form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data" class="card mb-4">
  @csrf
  <div class="card-header row">
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-start">
        <h4>Pengaturan Hotel</h4>
      </div>
    </div>
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-end flex-column">
        <div>
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
  </div>
  <div class="card-body">
    @if($setting)
    <div class="form-group row">
      <label for="name" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" value="{{ $setting->name }}" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="description" name="description" value="{{ $setting->description }}"
          required>
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="email" name="email" value="{{ $setting->email }}" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="phone" class="col-sm-3 col-form-label">No. HP <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $setting->phone }}" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="address" class="col-sm-3 col-form-label">Alamat <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="address" name="address" value="{{ $setting->address }}" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="logo" class="col-sm-3 col-form-label">Logo</label>
      <div class="col-sm-9">
        <div class="custom-file">
          <input type="file" class="custom-file-input" accept="image/png, image/jpeg, image/svg+xml" id="logo"
            name="logo">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        @if($setting->logo)
        <div class="d-flex flex-column mt-4">
          <label for="logo_sekarang" class="mb-4 ml-2 text-primary"><b>[ Logo Sekarang
              ]</b></label>
          <img src="{{ asset('./images/uploads/setting/' . $setting->logo ) }}" alt="Logo Hotel"
            style="max-width: 140px">
        </div>
        @endif
      </div>
    </div>
    @else
    <div class="form-group row">
      <label for="name" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="description" name="description" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="email" name="email" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="phone" class="col-sm-3 col-form-label">No. HP <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="phone" name="phone" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="address" class="col-sm-3 col-form-label">Alamat <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="logo" class="col-sm-3 col-form-label">Logo</label>
      <div class="col-sm-9">
        <div class="custom-file">
          <input type="file" class="custom-file-input" accept="image/png, image/jpeg" id="logo" name="logo">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
      </div>
    </div>
    @endif
  </div>
  <div class="card-footer bg-whitesmoke text-md-right">
    <button type="submit" class="btn btn-primary" id="save-btn">Simpan</button>
  </div>
</form>
@endsection