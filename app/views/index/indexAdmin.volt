{% extends "layouts\base.volt" %}

{% block title %}
Area Pustakawan
{% endblock %}

{% block content %}
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <div class="ui huge header">
            Selamat datang di Area Pustakawan, {{ session.get('auth')['nama'] }}!
        </div>
    </div>
</div>
<div class="feature alternate ui stripe vertical segment">
  <div class="ui three column center aligned divided relaxed stackable grid container">
    <div class="row">
      <div class="column">
        <h2 class="ui icon header">
            <i class="user icon"></i>
            Kelola Anggota
        </h2>
        <div>
            <a class="ui large brown button" href="daftar-anggota">Lihat Daftar Anggota</a>
        </div>
{#
        <a class="ui large button" href="tambah-anggota">Daftarkan Anggota Baru</a>
#}
      </div>
      <div class="column">
        <h2 class="ui icon header">
            <i class="book icon"></i>
            Kelola Buku
        </h2>
        <div>
            <a class="ui large brown button" href="daftar-buku">Lihat Daftar Buku</a>
        </div>
{#
        <a class="ui large button" href="tambah-buku">Tambahkan Buku Baru</a>
#}
      </div>
      <div class="column">
        <h2 class="ui icon header">
            <i class="tasks icon"></i>
            Kelola Peminjaman
        </h2>
        <div>
            <a class="ui large brown button" href="daftar-peminjaman">Lihat Daftar Peminjaman</a>
        </div>
{#
        <a class="ui large button" href="pinjam">Pinjamkan Buku kepada Anggota</a>
#}
      </div>
    </div>
  </div>
</div>
{% endblock %}