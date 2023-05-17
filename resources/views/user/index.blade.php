<!DOCTYPE html>
<html>
<head>
  <title>Pemesanan Tiket Konser</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/user.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
    <div class="note">
      Silahkan beli tiket yang tersedia sebelum habis! <br>
      TIKET TERSEDIA SAAT INI: <br>
      <table class="table table-bordered">
        <tr>
          <th>Tipe </th>
          <th>Harga </th>
          <th>Tersedia </th>
        </tr>
        @foreach($tiket as $t)
        <tr>
          <td>{{ $t->type }}</td>
          <td>Rp.{{ number_format($t->price) }}</td>
          <td>{{ $t->jml_tiket }} Tiket</td>
        </tr>
        @endforeach
      </table>
    </div>
    <form class="form-tiket" action="{{ route('buyTiket') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ auth()->user()->name }}" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" value="{{ auth()->user()->email }}" name="email" required>
      </div>
      <div class="form-group">
        <label for="tipe">Tipe Tiket:</label>
        <select name="tipe" id="tipe">
          <option value=""></option>
          @foreach($tiket as $t)
            <option value="{{ $t->type }}">{{ $t->type }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group jumlah-tiket">
        <div>
            <label for="jumlah-tiket">Jumlah Tiket:</label>
            <input type="number" id="jumlah-tiket" value="1" name="jml_tiket" required>
        </div>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
        $('#metode-pembayaran').select2({
          placeholder: 'Pilih metode pembayaran'
        });
        $('#tipe').select2({
          placeholder: 'Pilih tipe tiket'
        });
        $('#logout').click(function(e) {
            e.preventDefault();
            $('#logout-form').submit();
        });
    });
  </script>
</body>
</html>