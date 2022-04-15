@extends('layouts.app')

@section('content')
<section id="login" class="py-4">
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
        AUTENTIKASI
      </h6>
      <h1 class="font-weight-bold text-secondary text-center spacing-2 text-type-secondary">
        MASUK
      </h1>
    </div>
    <div class="login-body pb-4 pb-md-5">
      <form action="{{ route('login.post') }}" method="post">
        @csrf
        <div class="row">
          <div class="col-12 col-md-3 d-none d-block"></div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="username" class="text-primary font-weight-bold text-left spacing-1 m-0">Username</label>
              <input type="text" class="form-control text-secondary" id="username" name="username" autocomplete="off" />
            </div>
            <div class="form-group">
              <label for="password" class="text-primary font-weight-bold text-left spacing-1 m-0">Password</label>
              <input type="password" class="form-control text-secondary" id="password" name="password"
                autocomplete="off" />
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 mt-md-5 mb-2 mb-md-3">
              MASUK
            </button>
            <p class="text-primary font-weight-bold">Belum punya akun? <a href="{{ route('register') }}"
                class="text-secondary border-bottom border-secondary">Daftar</a></p>
          </div>
          <div class="col-12 col-md-3 d-none d-block"></div>
      </form>
    </div>
  </div>
  </div>
</section>
@endsection