<!DOCTYPE html>
<html>
<head>
  <title>Pemesanan Tiket Konser</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/user.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="header-container">
          <h1 class="logo">Pemesanan Tiket Konser</h1>
          <nav>
            <ul class="menu">
              <li><a href="#">Beranda</a></li>
              <li><a href="#">Konser</a></li>
              <li><a href="#">Tentang</a></li>
              <li><a href="#">Kontak</a></li>
            </ul>
          </nav>
          <span id="logout">logout</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
      </header>

  <main>
    <form>
      <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ auth()->user()->name }}" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" value="{{ auth()->user()->email }}" name="email" required>
      </div>
      <div class="form-group jumlah-tiket">
        <div>
            <label for="jumlah-tiket">Jumlah Tiket:</label>
            <input type="number" id="jumlah-tiket" value="1" name="jumlah-tiket" required>
        </div>
        <span class="available-ticket">
            Tiket tersedia: <strong>24</strong> <br>
            Silahkan pesan sebelum tiket habis!
        </span>
      </div>
      <div class="form-group">
        <label for="metode-pembayaran">Metode Pembayaran:</label>
        <select id="metode-pembayaran" name="metode-pembayaran" required>
          <option value="">Pilih Metode Pembayaran</option>
          <option value="transfer">Transfer Bank</option>
          <option value="kartu-kredit">Kartu Kredit</option>
          <option value="e-wallet">E-Wallet</option>
        </select>
      </div>
      <button type="submit">Pesan Tiket</button>
    </form>
  </main>

  <footer>
    <p>&copy; 2023 Pemesanan Tiket Konser. All rights reserved.</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#metode-pembayaran').select2();
        $('#logout').click(function(e) {
            e.preventDefault();
            $('#logout-form').submit();
        });
    });
  </script>
</body>
</html>