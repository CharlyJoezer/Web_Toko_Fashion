<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/css/dashboard/{{ $css }}">
</head>
<body>
    <div class="sidebar">
      <div class="website_profile">
        <img class="logo" src="/assets/image/Lofinz_transparent.png" alt="Lofinz">
        <div class="text">Dashboard Administrator</div>
      </div>
      <div class="admin_profile">
        <div class="profile">
          <img src="/assets/image/profil_default.jpg" alt="">
          <div class="username_and_role">
              <div class="username">{{ auth()->guard('administrator')->user()->username }}</div>
              <div class="role">Admin</div>
          </div>
        </div>
        <a href="/dashboard/logout" class="logout-button" title="Logout">
          Logout
        </a>
      </div>


      <ul class="list_link">
        <li class="link_item">
          <div class="list_link_header">
              <i class='bx bxs-home'></i>
              <span>Dashboard</span>
          </div>
          <a href="">Beranda</a>
        </li>

        <li class="link_item">
          <div class="list_link_header">
              <i class='bx bxs-inbox'></i>
              <span>Pesanan</span>
          </div>
          <a href="">Riwayat Pesanan</a>
          <a href="">Ulasan Pembeli</a>
        </li>
        
        <li class="link_item">
          <div class="list_link_header">
              <i class='bx bxs-box' ></i>
              <span>Produk</span>
          </div>
          <a href="">Tambah Produk</a>
          <a href="">Edit Produk</a>
        </li>
      </ul>
    </div>
</body>
</html>