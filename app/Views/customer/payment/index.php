<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pembayaran - ChickenSizzle</title>
  <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    // simple shipping calculation (client-side helper)
    function recalcShipping() {
      const method = document.querySelector('input[name="shipping_method"]:checked').value;
      const inArea = document.getElementById('is_in_area').value === '1';
      let cost = 0;
      if (method === 'pickup') cost = 0;
      if (method === 'delivery') cost = inArea ? 15000 : 0;
      if (method === 'cod') cost = inArea ? 20000 : 0; // cod fee maybe higher
      if (method === 'thirdparty') cost = 0; // thirdparty handled externally
      document.getElementById('shipping_cost').value = cost;
      document.getElementById('shippingCostText').innerText = cost ? 'Rp ' + new Intl.NumberFormat('id-ID').format(cost) : 'Rp 0';
      // show message if not allowed area & selected delivery/cod
      if (!inArea && (method === 'delivery' || method === 'cod')) {
        document.getElementById('notInAreaMsg').classList.remove('d-none');
      } else {
        document.getElementById('notInAreaMsg').classList.add('d-none');
      }
      // show payment method details for transfer
      const pm = document.querySelector('input[name="payment_method"]:checked').value;
      document.getElementById('transferInfo').style.display = (pm === 'transfer') ? 'block' : 'none';
    }

    function onPaymentMethodChange() {
      recalcShipping();
    }
  </script>
</head>
<body class="bg-light p-4">
<div class="container">
  <h3>Pembayaran & Pengiriman</h3>

  <form action="/customer/payment/process" method="post">
    <!-- order summary -->
    <div class="card mb-3">
      <div class="card-body">
        <h5>Ringkasan Pesanan</h5>
        <?php $subtotal = $subtotal ?? 0; ?>
        <?php foreach ($cart as $it): ?>
          <div class="d-flex justify-content-between">
            <div><?= esc($it['name']) ?> x<?= $it['qty'] ?></div>
            <div>Rp <?= number_format($it['price'] * $it['qty'],0,',','.') ?></div>
          </div>
        <?php endforeach; ?>
        <hr>
        <div class="d-flex justify-content-between">
          <strong>Subtotal</strong>
          <strong>Rp <?= number_format($subtotal,0,',','.') ?></strong>
        </div>
      </div>
    </div>

    <!-- alamat & shipping -->
<div class="card mb-3">
  <div class="card-body">
    <h5>Alamat Pengiriman</h5>

    <!-- alamat textarea -->
    <div id="addressBox" class="mb-2">
  <label>Alamat</label>
  <textarea name="shipping_address" id="shipping_address" class="form-control" required><?= esc($user['address'] ?? '') ?></textarea>

  <div class="d-flex gap-2 mt-2">
    <button type="button" class="btn btn-outline-primary btn-sm" onclick="shareLocation()">
      📍 Share Lokasi via Google Maps
    </button>
    <button type="button" class="btn btn-outline-success btn-sm" onclick="detectLocation()">
      📡 Gunakan Lokasi Saya
    </button>
  </div>

  <!-- hidden coordinate -->
  <input type="hidden" id="lat" name="latitude">
  <input type="hidden" id="lng" name="longitude">
</div>


    <small class="text-muted">Area layanan: <?= implode(', ', $service_area['cities']) ?></small>


    <div class="mt-3">
      <label class="form-label">Metode Pengiriman</label>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="shipping_method" id="ship_pickup" value="pickup" checked onchange="recalcShipping()">
        <label class="form-check-label" for="ship_pickup">Pickup (ambil sendiri) — gratis</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="shipping_method" id="ship_delivery" value="delivery" onchange="recalcShipping()">
        <label class="form-check-label" for="ship_delivery">Delivery (antar ChickenSizzle)</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="shipping_method" id="ship_cod" value="cod" onchange="recalcShipping()">
        <label class="form-check-label" for="ship_cod">Cash on Delivery (COD)</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="shipping_method" id="ship_third" value="thirdparty" onchange="recalcShipping()">
        <label class="form-check-label" for="ship_third">Pesan via GoFood / Partner</label>
      </div>

      <!-- Warning outside area -->
      <p id="notInAreaMsg" class="text-danger mt-2 d-none">
        Maaf, delivery/COD hanya tersedia dalam area layanan.
      </p>

      <!-- Link GoFood -->
      <div id="gofoodBox" class="mt-3 d-none">
        <a href="" target="_blank" class="btn btn-success w-100">
          🍔 Pesan via GoFood
        </a>
      </div>

      <div class="mt-2">
        <strong>Biaya pengiriman: </strong> <span id="shippingCostText">Rp 0</span>
      </div>
    </div>
  </div>
</div>


    <!-- payment -->
    <div class="card mb-3">
      <div class="card-body">
      <h5>metode pembayaran</h5>
      <div class="form-check">
  <input class="form-check-input" type="radio" name="payment_method" id="pay_transfer" value="transfer" checked onchange="onPaymentMethodChange()">
  <label class="form-check-label" for="pay_transfer">Transfer Bank</label>
</div>

<div class="form-check">
  <input class="form-check-input" type="radio" name="payment_method" id="pay_ewallet" value="ewallet" onchange="onPaymentMethodChange()">
  <label class="form-check-label" for="pay_ewallet">E-Wallet (OVO / GoPay / Dana / QRIS)</label>
</div>

<!-- INFO TRANSFER -->
<div id="transferInfo" class="mt-3" style="display:block;">
  <h6>Instruksi Transfer</h6>
  <p>Bank: <strong><?= esc($payment_info['bank']) ?></strong></p>
  <p>No Rekening: <strong><?= esc($payment_info['account_number']) ?></strong> a/n <strong><?= esc($payment_info['account_name']) ?></strong></p>
  <p class="small text-muted"><?= esc($payment_info['note']) ?></p>
</div>

<!-- INFO E-WALLET / QRIS -->
<div id="ewalletInfo" class="mt-3" style="display:none;">
  <h6>QRIS / E-Wallet</h6>
  <img src="/assets/qris/logo.jpg" alt="QRIS" class="img-fluid mb-2" style="max-width:250px; cursor:pointer;"
     onclick="window.open('/assets/logo.jpg', '_blank')">
  <p class="text-muted small">Scan QRIS untuk melakukan pembayaran melalui OVO/GoPay/Dana.</p>
</div>
</div>

</div>

    <input type="hidden" id="shipping_cost" name="shipping_cost" value="0">
    <div class="mb-3">
      <label class="form-label">Catatan (opsional)</label>
      <textarea name="notes" class="form-control"></textarea>
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-danger">Bayar / Buat Pesanan</button>
      <a href="/customer/cart" class="btn btn-secondary">Kembali ke Keranjang</a>
    </div>
  </form>
</div>

<script>
  // initialize (recalc on load)
  document.addEventListener('DOMContentLoaded', function() {
    recalcShipping();
    // update inArea when address changes (basic)
    document.getElementById('shipping_address').addEventListener('change', function() {
      // could do AJAX to server to validate area - for now page reload recommended or user can click recalcShipping manually
      // quick heuristic: mark as outside area (developer should implement AJAX endpoint to validate)
      // We'll just call recalcShipping() again (server-side validation is authoritative)
      recalcShipping();
    });
  });

  function onPaymentMethodChange() {
    const method = document.querySelector('input[name="payment_method"]:checked').value;

    const transferBox = document.getElementById('transferInfo');
    const ewalletBox = document.getElementById('ewalletInfo');

    if (method === 'transfer') {
      transferBox.style.display = 'block';
      ewalletBox.style.display = 'none';
    } 
    else if (method === 'ewallet') {
      transferBox.style.display = 'none';
      ewalletBox.style.display = 'block';
    } 
    else {
      transferBox.style.display = 'none';
      ewalletBox.style.display = 'none';
    }

    recalcShipping(); // tetap panggil biar shipping ikut update
  }

  // buka aplikasi gmaps utk share lokasi
  function shareLocation() {
    // buka google maps dengan mode "share location"
    window.open("https://www.google.com/maps/search/?api=1&query=my+location", "_blank");

    // note: user tinggal copy lokasi dari googlmaps dan paste ke textarea
  }

  function recalcShipping() {
    const method = document.querySelector('input[name="shipping_method"]:checked').value;
    const inArea = document.getElementById('is_in_area')?.value === '1';

    let cost = 0;

    // shipping logic
    if (method === 'pickup') cost = 0;
    if (method === 'delivery') cost = inArea ? 15000 : 0;
    if (method === 'cod') cost = inArea ? 20000 : 0;
    if (method === 'thirdparty') cost = 0;

    document.getElementById('shipping_cost').value = cost;
    document.getElementById('shippingCostText').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(cost);

    // tampilkan hide addressBox untuk pickup dan gofood
    if (method === 'pickup' || method === 'thirdparty') {
      document.getElementById('addressBox').style.display = 'none';
    } else {
      document.getElementById('addressBox').style.display = 'block';
    }

    // Warning area
    if (!inArea && (method === 'delivery' || method === 'cod')) {
      document.getElementById('notInAreaMsg').classList.remove('d-none');
    } else {
      document.getElementById('notInAreaMsg').classList.add('d-none');
    }

    // tampilkan tombol gofood
    document.getElementById('gofoodBox').classList.toggle('d-none', method !== 'thirdparty');
  }

  // Gunakan GPS perangkat
  function detectLocation() {
    if (!navigator.geolocation) {
      alert("Device kamu tidak mendukung GPS.");
      return;
    }

    navigator.geolocation.getCurrentPosition(
      async function(pos) {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;

        // simpan koordinat
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;

        // isi alamat dengan koordinat sementara
        document.getElementById('shipping_address').value = `Lokasi terdeteksi:\nLatitude: ${lat}\nLongitude: ${lng}\n(Mengambil alamat...)`;

        // reverse geocode
        try {
          const address = await getAddress(lat, lng);
          document.getElementById('shipping_address').value = address;
        } catch {
          document.getElementById('shipping_address').value = `Latitude: ${lat}\nLongitude: ${lng}\n(Alamat tidak ditemukan)`;
        }
      },

      function(err) {
        alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan izinkan akses lokasi.");
      }
    );
  }

  // Ambil alamat dari koordinat via Google Maps API
  async function getAddress(lat, lng) {
    // MASUKKAN API KEY KAMU DI SINI
    const API_KEY = "MASUKKAN_GOOGLE_MAPS_API_KEY";

    const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${API_KEY}`;
    const response = await fetch(url);
    const data = await response.json();

    if (data.status === "OK") {
      return data.results[0].formatted_address;
    } else {
      throw new Error("Alamat tidak ditemukan");
    }
  }
</script>
</body>
</html>
