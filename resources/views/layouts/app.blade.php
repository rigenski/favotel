<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Favotel</title>
  <link rel="icon" type="image/x-icon"
    href="{{ count($setting) ? asset('/images/uploads/setting/' . $setting[0]->short_logo ) : '' }}">
  <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>

<body>

  @include('layouts.app._navbar')

  <main>
    @yield('content')
  </main>

  @include('layouts.app._footer')

  @yield('modal')

  <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('/js/popper.min.js') }}">
  </script>
  <script src="{{ asset('/js/bootstrap.min.js') }}">
  </script>
  <script>
    const elList = document.getElementById("menu-list");
            const elMenuOpen = document.getElementById("nav-menu--open");
            const elMenuClose = document.getElementById("nav-menu--close");

            elMenuOpen.addEventListener("click", () => {
                elList;
                if (elList.classList[length - 1] == undefined) {
                    elList.classList.add("active");
                } else {
                    elList.classList.remove("active");
                }
            });

            elMenuClose.addEventListener("click", () => {
                if (elList.classList[length - 1] == undefined) {
                    elList.classList.remove("active");
                } else {
                    elList.classList.add("active");
                }
            });
  </script>

  @yield('script')
</body>

</html>