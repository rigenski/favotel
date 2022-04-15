<nav class="py-3 py-md-4">
  <div class="container d-flex justify-content-between align-items-center">
    <ul class="nav-list m-0 list-unstyled order-lg-1 order-2 d-none d-md-flex">
      <li class="nav-item mr-4">
        <a href="{{ route('home') }}" class="font-weight-bold text-primary">Beranda</a>
      </li>
      <li class="nav-item mr-4">
        <a href="{{ route('rooms') }}" class="font-weight-bold text-primary">Tipe Kamar</a>
      </li>
      <li class="nav-item mr-4">
        <a href="{{ route('hotel-facilities') }}" class="font-weight-bold text-primary">Fasilitas Hotel</a>
      </li>
    </ul>
    <div class="nav-brand order-lg-2 order-1">
      <a href="{{ route('home') }}">
        <img src="{{asset('/images/long-logo.svg')}}" alt="Logo Hotel" />
      </a>
    </div>
    <div class="nav-btn text-right order-lg-3 order-3 d-none d-md-block">
      @if(auth()->user())
      @if(auth()->user()->role == 'admin')
      <a href="{{ route('guest') }}" class="btn btn-success spacing-2">ADMIN AREA</a>
      @elseif(auth()->user()->role == 'receptionist')
      <a href="{{ route('guest') }}" class="btn btn-success spacing-2">RESEPSIONIS AREA</a>
      @elseif(auth()->user()->role == 'guest')
      <a href="{{ route('guest') }}" class="btn btn-success spacing-2">TAMU AREA</a>
      @endif
      @else
      <a href="{{ route('login') }}" class="btn btn-primary spacing-2">MASUK</a>
      @endif
    </div>
    <button id="nav-menu--open" class="order-2 border-0 bg-transparent p-2 d-block d-md-none">
      <img src="{{asset('/images/menu.svg')}}" alt="" />
    </button>
  </div>
  <ul id="menu-list" class="position-fixed flex-column list-unstyled bg-primary pt-3 pr-3 pb-4 pl-4 d-flex d-md-none">
    <li class="menu-item mb-5 text-right">
      <button id="nav-menu--close" class="border-0 bg-transparent p-2">
        <img src="{{asset('/images/close.svg')}}" alt="" />
      </button>
    </li>
    <li class="menu-item mb-3">
      <a href="{{ route('home') }}" class="font-weight-bold text-primary">Beranda</a>
    </li>
    <li class="menu-item mb-3">
      <a href="{{ route('rooms') }}" class="font-weight-bold text-primary">Tipe Kamar</a>
    </li>
    <li class="menu-item mb-5">
      <a href="{{ route('hotel-facilities') }}" class="font-weight-bold text-primary">Fasilitas Hotel</a>
    </li>
    <li class="menu-item mb-3">
      @if(auth()->user())
      @if(auth()->user()->role == 'admin')
      <a href="{{ route('guest') }}" class="btn btn-success spacing-2">ADMIN AREA</a>
      @elseif(auth()->user()->role == 'receptionist')
      <a href="{{ route('guest') }}" class="btn btn-success spacing-2">RESEPSIONIS AREA</a>
      @elseif(auth()->user()->role == 'guest')
      <a href="{{ route('guest') }}" class="btn btn-success spacing-2">TAMU AREA</a>
      @endif
      @else
      <a href="{{ route('login') }}" class="btn btn-primary spacing-2">MASUK</a>
      @endif
    </li>
  </ul>
</nav>