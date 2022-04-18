@extends('layouts.admin')
@section('dashboard', 'active')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-lg-4 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Reservasi</h4>
        </div>
        <div class="card-body">
          {{ count($reservations) }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Kamar</h4>
        </div>
        <div class="card-body">
          {{ count($rooms) }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-info">
        <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Tamu</h4>
        </div>
        <div class="card-body">
          {{ count($guests) }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection