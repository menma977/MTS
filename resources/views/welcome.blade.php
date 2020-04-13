@extends('layouts.frontEnd')

@section('content')
  <!-- BANNER -->
  <div id="oc-fullslider" class="banner">
    <div class="owl-carousel owl-theme full-screen">
      <div class="item">
        <img src="{{ asset('end/front/images/dummy-img-1920x900.jpg') }}" alt="Slider">
        <div class="overlay-bg"></div>
        <div class="container d-flex align-items-center text-center">
          <div class="wrap-caption">
            <h1 class="caption-heading">MTS</h1>
            <p>Mita Tani Sejahtera</p>
            <a href="#" class="btn btn-primary">Dapatkan Aplikasinya Sekarang</a>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="{{ asset('end/front/images/dummy-img-1920x900-2.png') }}" alt="Slider">
        <div class="overlay-bg"></div>
        <div class="container d-flex align-items-center text-center">
          <div class="wrap-caption">
            <h1 class="caption-heading">MTS</h1>
            <p>Mita Tani Sejahtera</p>
            <a href="#" class="btn btn-primary">Dapatkan Aplikasinya Sekarang</a>
          </div>
        </div>
      </div>
    </div>
    <div class="custom-nav owl-nav"></div>
  </div>

  <!-- WHY CHOOSE US? -->
  <div class="section">
    <div class="content-wrap">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <h2 class="section-heading text-center mb-4">
              Mengapa Memilih Kami?
            </h2>
            <p class="subheading text-center mb-5">
              Dengan adanya komunitas para mitra petani akan bisa menjadi satu kesatuan yang bisa meningkatkan
              kesejahteraan petani milineal ,adanya syistem mitra tani sejahtera ini akan memudahkan para mitra untuk
              bertani secara mdern sistem yang di rancang untuk kesejahteraan bersama
            </p>
            <p class="subheading text-center mb-5">
              Dengan bergabung bersama Mitra Tani Sejahtera, anda dapat memilih beberapa system kemitraan
              dengan
              keuntungan luar biasa di antaranya
            </p>
          </div>
        </div>
        <div class="row">
          <!-- Item 1 -->
          <div class="col-md-4 mb-4">
            <div class="box-icon-1 text-center">
              <div class="icon">
                <i class="fa fa-globe"></i>
              </div>
              <div class="body-content">
                <h4>Tersyistem</h4>
                <p>
                  bentuk kemitraan yang sudah tersyistem online memudahkan bagi mitra untuk selalu update lahan dan
                  tanamanya
                </p>
              </div>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="col-md-4 mb-4">
            <div class="box-icon-1 text-center">
              <div class="icon">
                <i class="fa fa-certificate"></i>
              </div>
              <div class="body-content">
                <h4>Tenaga Ahli</h4>
                <p>
                  sebagai mitra tdk perlu kawatir lagi karena semua jenis tanaman yg kita tanam akan di tangani oleh
                  para tenaga ahli yg sudah berpengalaman menangani bidangnya seperti cara penanaman,pengolahan
                  lahan,pemupukan,pengendalian hama,pemanenan, semua akan di tangani secara profesional
                </p>
              </div>
            </div>
          </div>
          <!-- Item 3 -->
          <div class="col-md-4 mb-4">
            <div class="box-icon-1 text-center">
              <div class="icon">
                <i class="fa fa-thumbs-up"></i>
              </div>
              <div class="body-content">
                <h4>Pemasaran</h4>
                <p>
                  kami di bawah naungan koperasi bumi rahayu yang sudah bejerjasama ke beberapa perusahaan exportir
                  untuk menjual hasil panen jadi mitra akan lbh tenang tinggal mengawasi pertumbuhanya dan mendapat
                  hasilnya
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="section bgi-cover-center" style="background: #222222">
    <div class="content-wrap py-0">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-sm-12 col-md-12 col-lg-7">
            <div class="text-white mt-5">
              <h1 class="section-heading no-after text-primary">
                FUN FACT
              </h1>
              <p class="mb-5">
                Banyak orang menyamakan porang dengan suweg karena tampilannya yang nyaris
                serupa.Keduanya sama-sama
                memiliki batang tunggal bercorak belang hijau putih.Batang memiliki cabang-cabang
                sebagai tangkai daun.

                Mengutip situs Tanobat, yang membedakan porang dengan suweg adalah adanya tonjolan
                cokelat kehitaman
                pada pertemuan cabang dan daun pada porang.Tonjolan ini merupakan perkembangbiakan
                vegetatif porang.

                Porang tersebar mulai dari Kepulauan Andaman, India, kemudian ke Myanmar, Thailand, dan
                Indonesia.Porang
                bisa tumbuh di sembarang lokasi seperti pinggir hutan jati, bawah rumpun bambu, tepi
                sungai, semak
                belukar, atau di bawah aneka pohon rindang.

                Berat umbi porang bisa mencapai 12 kilogram.Umbi umumnya berwarna kuning cerah, berbeda
                dengan suweg
                yang berwarna putih.

              </p>
            </div>
            <div class="spacer-content"></div>
          </div>

          <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="img-cta">
              <img src="{{ asset('end/front/images/dummy-img-400x400.png') }}" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- WHY CHOOSE -->
  <div class="section">
    <div class="content-wrap">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <h2 class="section-heading text-center mb-4">
              Beragam manfaat tanaman porang
            </h2>
            <p class="subheading text-center mb-5">
              Tanaman umbi satu ini termasuk ke dalam jenis tanaman obat. Glukomanan yang terkandung dalam
              tanaman
              porang menjadi salah satu nutrisi penting yang dibutuhkan tubuh.Setiap 100 gram porang hanya
              mengandung 3
              kalori.
            </p>
          </div>
        </div>

        <div class="row">
          <!-- Item 1 -->
          <div class="col-sm-12 col-md-12 col-lg-4 mb-4">
            <div class="box-image-1">
              <div class="media-box">
                <img src="{{ asset('end/front/images/dummy-img-600x400.png') }}" class="img-fluid"
                     alt="">
              </div>
              <div class="body-content">
                {{--                <h4>Landscape Design</h4>--}}
                <p>
                  Glukomanan pada porang mampu mengurangi kadar kolesterol dan memberikan rasa kenyang
                  lebih lama di
                  perut. Karena rendah kalori, porang tidak akan mengganggu Anda yang tengah
                  menjalankan program
                  diet.
                </p>
                <p>
                  Tepung porang rendah kadar indeks glikemik sehingga aman dikonsumsi bagi penderita
                  diabetes.
                </p>
              </div>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="col-sm-12 col-md-12 col-lg-4 mb-4">
            <div class="box-image-1">
              <div class="media-box">
                <img src="{{ asset('end/front/images/dummy-img-600x400-2.png') }}" class="img-fluid"
                     alt="">
              </div>
              <div class="body-content">
                {{--                <h4>Planting & Removal</h4>--}}
                <p>
                  Dengan kandungan serat pangan yang tinggi, porang bisa membantu meningkatkan daya
                  tahan tubuh dari
                  berbagai penyakit seperti kanker usus besar, penyakit kardiovaskular, dan kencing
                  manis.
                </p>
                <p>
                  Di Filipina, tepung porang digunakan untuk pengganti terigu dan bahan baku roti.
                  Rasanya yang netral
                  membuatnya muda dipadupadankan dengan bahan makanan lain.
                </p>
              </div>
            </div>
          </div>
          <!-- Item 3 -->
          <div class="col-sm-12 col-md-12 col-lg-4 mb-4">
            <div class="box-image-1">
              <div class="media-box">
                <img src="{{ asset('end/front/images/dummy-img-600x400-3.png') }}" class="img-fluid"
                     alt="">
              </div>
              <div class="body-content">
                {{--                <h4>Garden Care</h4>--}}
                <p>
                  Di Jepang, porang dimanfaatkan untuk campuran makanan mi shirataki dan konnyaku.
                </p>
                <p>
                  Di industri obat-obatan, glukomanan dimanfaatkan untuk pembentuk kapsul pada obat.
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- FUN FACT -->
  <div class="section bg-secondary">
    <div class="content-wrap">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <h2 class="section-heading text-center text-white mb-4">
              Gallery
            </h2>
            <p class="subheading text-center mb-5">Start growing with Try Html Template</p>
          </div>
        </div>
        <div class="row popup-gallery gutter-5">
          @foreach($imageName as $item)
            <div class="col-xs-12 col-md-6 col-lg-3">
              <div class="box-gallery">
                <a href="{{ asset('gallery/'.$item) }}" title="Gallery #1">
                  <img src="{{ asset('gallery/'.$item) }}" alt="" class="img-fluid">
                  <div class="project-info">
                    <div class="project-icon">
                      <span class="fa fa-search"></span>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <!-- OUR PRICING PLANS -->
  <div class="section">
    <div class="content-wrap">
      <div class="container">
        <div class="row">

          <div class="col-sm-12 col-md-12">
            <h2 class="section-heading text-center mb-4">
              Kemitraan
            </h2>
            <p class="subheading text-center mb-5">
              Dengan menjadi anggota koperasi membayar simpanan wajib sebesar 300.000,- dan ikut program
              kemitraan tanam
              porang di koprasi BUMI RAHAYU minimal 2 paket (Rp.1.500.000,- X 2 = Rp.3.000.000 )maka
              secara otomatis
              anda sudah terdaftar jadi agen mitra kami dan bisa menjual produk koperasi .ada beberapa
              system kemitraan
              di sini di antaranya
            </p>
          </div>
        </div>
        <div class="row">
          <!-- Item 1 -->
          <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="rs-pricing-1 bg-primary-1 mb-5">
              <div class="price">
                Mitra Mandiri
              </div>
              <div class="features m-1">
                <ul>
                  <li>Bibit bisa beli di koperasi (bibit super)</li>
                  <li>Team pendamping lapangan</li>
                  <li>Jaminan pembelian hasil panen oleh koperasi</li>
                  <li>Hasil panen 100% milik mitra</li>
                </ul>
              </div>
              <div class="action">
                <a href="#" class="btn btn-primary">Learn More</a>
              </div>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="rs-pricing-1 bg-primary-1 mb-5">
              <div class="price">
                Mitra luar biasa
              </div>
              <div class="features m-1">
                <ul>
                  <li>Harga paket untuk mitra biasa Rp.1.500.000,-/paket</li>
                  <li>Mendapatkan sertifikat bukti kepemilikan pohon porang di lahan binaan koperasi
                  </li>
                  <li>Jaminan pembelian hasil panen porang</li>
                  <li>Lahan di sediakan koperasi</li>
                  <li>Bebas tenaga kerja tanam</li>
                  <li>Bebas perawatan</li>
                  <li>Bebas pupuk</li>
                  <li>Bebas tenaga kerja panen</li>
                  <li>Papan Barcode di lahan mitra atas nama mitra</li>
                </ul>
              </div>
              <div class="action">
                <a href="#" class="btn btn-primary">Learn More</a>
              </div>
            </div>
          </div>
          <!-- Item 3 -->
          <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="rs-pricing-1 bg-primary-1 mb-5">
              <div class="price">
                Mitra agen
              </div>
              <div class="features m-1">
                <ul>
                  <li>Harga paket untuk mitra biasa Rp.1.500.000,-/paket</li>
                  <li>Mendapatkan sertifikat bukti kepemilikan pohon porang di lahan binaan koperasi
                  </li>
                  <li>Jaminan pembelian hasil panen porang</li>
                  <li>Lahan di sediakan koperasi</li>
                  <li>Bebas tenaga kerja tanam</li>
                  <li>Bebas perawatan</li>
                  <li>Bebas pupuk</li>
                  <li>Bebas tenaga kerja panen</li>
                  <li>Papan Barcode di lahan mitra atas nama mitra</li>
                  <li>Bonus Sponsor</li>
                  <li>Bonus Level</li>
                  <li>Bonus Royalty</li>
                </ul>
              </div>
              <div class="action">
                <a href="#" class="btn btn-primary">Learn More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
