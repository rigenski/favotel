<footer class="bg-success py-4 py-md-5">
  <div class="container">
    <div class="d-flex justify-content-between mb-4">
      <div class="">
        <a href="{{ route('home') }}">
          <h4 class="font-weight-bold text-white text-type-secondary">Favotel</h4>
        </a>
        <p class="text-white">Vestibulum ante ipsum primis in faucibus
          orci luctus et ultrices posuere cubilia.</p>
      </div>
      <div>
        <ul class="m-0 list-unstyled d-none d-lg-flex">
          <li class="ml-4">
            <a href="{{ route('home') }}" class="font-weight-bold text-white">Beranda</a>
          </li>
          <li class="ml-4">
            <a href="{{ route('rooms') }}" class="font-weight-bold text-white">Tipe Kamar</a>
          </li>
          <li class="ml-4">
            <a href="{{ route('hotel-facilities') }}" class="font-weight-bold text-white">Fasilitas Hotel</a>
          </li>
        </ul>
      </div>
    </div>
    <p class="text-white text-center m-0">All right reserved &copy;favotel 2022</p>
  </div>
</footer>