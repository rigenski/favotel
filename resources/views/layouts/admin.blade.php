<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> {{ count($setting) ? strtoupper($setting[0]->name) . ' - ADMIN' : 'HOTEL RESERVATION - ADMIN' }}</title>
  <link rel="icon" type="image/x-icon"
    href="{{ count($setting) ? asset('/images/uploads/setting/' . $setting[0]->short_logo ) :  asset('/images/short-logo-dummy.svg') }}">

  <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/all.css')}}">
  <link rel="stylesheet" href="{{asset('/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('/css/components.css')}}">
  <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      @include('layouts.admin._navbar')
      <div class="main-sidebar">
        @include('layouts.admin._sidebar')
      </div>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>@yield('title')</h1>
          </div>
          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          {{ count($setting) ? strtoupper($setting[0]->name) . ' MANAGER' : 'HOTEL TITLE MANAGER' }}
        </div>
      </footer>
    </div>
  </div>

  @yield('modal')

  <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('/js/popper.min.js') }}">
  </script>
  <script src="{{ asset('/js/bootstrap.min.js') }}">
  </script>
  <script src="{{ asset('/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('/js/moment.min.js') }}"></script>
  <script src="{{ asset('/js/stisla.js') }}"></script>
  <script src="{{ asset('/js/scripts.js') }}"></script>
  <script src="{{ asset('/js/custom.js') }}"></script>
  <script src="{{ asset('/js/bootstrap-multiselect.js')}}"></script>
  <script>
    $(document).ready(function(){
            $('.multi-select').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: true
            });
      });
  </script>

  @yield('script')

</body>

</html>