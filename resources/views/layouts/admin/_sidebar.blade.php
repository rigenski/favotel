<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="{{ route('admin') }}">FAVOTEL</a>
  </div>
  <ul class="sidebar-menu">
    @if(auth()->user()->role == 'admin')
    <li class="menu-header">HOME</li>
    <li class="@yield('dashboard')"><a class="nav-link" href="{{ route('admin') }}"><i class="fas fa-home"></i>
        <span>Dashboard</span></a></li>
    <li class="menu-header">MAIN</li>
    <li class="@yield('rooms')"><a class="nav-link" href=" {{ route('admin.rooms') }}"><i
          class="fas fa-door-closed"></i>
        <span>Kamar</span></a></li>
    <li class="@yield('room-facilities')"><a class="nav-link" href=" {{ route('admin.room-facilities') }}"><i
          class="fas fa-bed"></i>
        <span>Fasilitas Kamar</span></a></li>
    <li class="@yield('hotel-facilities')"><a class="nav-link" href=" {{ route('admin.hotel-facilities') }}"><i
          class="fas fa-hotel"></i>
        <span>Fasilitas Hotel</span></a></li>
    <li class="@yield('guests')"><a class="nav-link" href="{{ route('admin.guests') }}"><i class="fas fa-users"></i>
        <span>Tamu</span></a></li>
    <li class="menu-header">SETTING</li>
    <li class="@yield('receptionists')"><a class="nav-link" href="{{ route('admin.receptionists') }}"><i
          class="fas fa-users"></i>
        <span>Resepsionis</span></a></li>
    <li class="@yield('setting')"><a class="nav-link" href="{{ route('admin.setting') }}"><i class="fas fa-cog"></i>
        <span>Pengaturan</span></a></li>
    @elseif(auth()->user()->role == 'receptionist')
    <li class="menu-header">HOME</li>
    <li class="@yield('dashboard')"><a class="nav-link" href="{{ route('admin') }}"><i class="fas fa-home"></i>
        <span>Dashboard</span></a></li>
    <li class="menu-header">MAIN</li>
    <li class="@yield('reservations')"><a class="nav-link" href=" {{ route('admin.reservations') }}"><i
          class="fas fa-calendar"></i>
        <span>Reservasi</span></a></li>
    @endif
  </ul>
</aside>