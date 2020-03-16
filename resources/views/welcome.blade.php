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
            <p class="caption-supheading">MTS</p>
            <h1 class="caption-heading">mita tani sejahtera</h1>
            <p>Long Description</p>
            <a href="#" class="btn btn-secondary">MORE ABOUT US</a>
            <a href="#" class="btn btn-primary">HIRE US NOW</a>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="{{ asset('end/front/images/dummy-img-1920x900-2.jpg') }}" alt="Slider">
        <div class="overlay-bg"></div>
        <div class="container d-flex align-items-center text-center">
          <div class="wrap-caption">
            <p class="caption-supheading">Title</p>
            <h1 class="caption-heading">Description</h1>
            <p>Long Description</p>
            <a href="#" class="btn btn-secondary">MORE ABOUT US</a>
            <a href="#" class="btn btn-primary">HIRE US NOW</a>
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
              Why Choose Us?
            </h2>
            <p class="subheading text-center mb-5">
              Dengan adanya komunitas petani porang akan bisa menjadi sebuah satu kesatuan yang akan bisa meningkatkan
              kesejah teraan para petani.
            </p>
          </div>

        </div>

        <div class="row">
          <!-- Item 1 -->
          <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
            <div class="box-icon-1 text-center">
              <div class="icon">
                <i class="fa fa-globe"></i>
              </div>
              <div class="body-content">
                <h4>Title</h4>
                <p>Description</p>
              </div>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
            <div class="box-icon-1 text-center">
              <div class="icon">
                <i class="fa fa-certificate"></i>
              </div>
              <div class="body-content">
                <h4>Certified Expert</h4>
                <p>Dolor sit amet dolor gravida placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do
                  eiusmod.</p>
              </div>
            </div>
          </div>
          <!-- Item 3 -->
          <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
            <div class="box-icon-1 text-center">
              <div class="icon">
                <i class="fa fa-thumbs-up"></i>
              </div>
              <div class="body-content">
                <h4>Affordabel Pricing</h4>
                <p>Dolor sit amet dolor gravida placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do
                  eiusmod.</p>
              </div>
            </div>
          </div>
          <!-- Item 4 -->
          <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
            <div class="box-icon-1 text-center">
              <div class="icon">
                <i class="fa fa-star"></i>
              </div>
              <div class="body-content">
                <h4>High Quality Services</h4>
                <p>Dolor sit amet dolor gravida placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do
                  eiusmod.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="section bgi-cover-center" data-background="{{ asset('end/front/images/dummy-img-1920x900-3.jpg') }}">
    <div class="content-wrap py-0">
      <div class="container">
        <div class="row align-items-end">

          <div class="col-sm-12 col-md-12 col-lg-7">

            <div class="text-white mt-5">
              <h1 class="section-heading no-after text-primary">
                Have Problem with your Gardening?
              </h1>
              <p class="mb-5">Sed orci dolor, pulvinar nec luctus a, malesuada ac nisl. Aliquam eleifend et dui et
                suscipit. Nam semper accumsan ante, ac dapibus urna dapibus et.</p>

            </div>
            <a href="#" class="btn btn-primary">CONTACT NOW</a>
            <div class="spacer-content"></div>
          </div>

          <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="img-cta">
              <img src="{{ asset('end/front/images/dummy-img-400x400.jpg') }}" alt="" class="img-fluid">
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
              Our Services
            </h2>
            <p class="subheading text-center mb-5">Every case is very important to us and we always take care of them
              seriously.</p>
          </div>

        </div>

        <div class="row">
          <!-- Item 1 -->
          <div class="col-sm-12 col-md-12 col-lg-4 mb-4">
            <div class="box-image-1">
              <div class="media-box">
                <img src="{{ asset('end/front/images/dummy-img-600x400.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="body-content">
                <h4>Landscape Design</h4>
                <p>Dolor sit amet dolor gravida placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do
                  eiusmod.</p>
              </div>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="col-sm-12 col-md-12 col-lg-4 mb-4">
            <div class="box-image-1">
              <div class="media-box">
                <img src="{{ asset('end/front/images/dummy-img-600x400.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="body-content">
                <h4>Planting & Removal</h4>
                <p>Dolor sit amet dolor gravida placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do
                  eiusmod.</p>
              </div>
            </div>
          </div>
          <!-- Item 3 -->
          <div class="col-sm-12 col-md-12 col-lg-4 mb-4">
            <div class="box-image-1">
              <div class="media-box">
                <img src="{{ asset('end/front/images/dummy-img-600x400.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="body-content">
                <h4>Garden Care</h4>
                <p>Dolor sit amet dolor gravida placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do
                  eiusmod.</p>
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
              Recent Project
            </h2>
            <p class="subheading text-center mb-5">Start growing with Try Html Template</p>
          </div>

        </div>

        <div class="row popup-gallery gutter-5">
          <!-- Item 1 -->
          <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="box-gallery">
              <a href="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" title="Gallery #1">
                <img src="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" alt="" class="img-fluid">
                <div class="project-info">
                  <div class="project-icon">
                    <span class="fa fa-search"></span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="box-gallery">
              <a href="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" title="Gallery #2">
                <img src="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" alt="" class="img-fluid">
                <div class="project-info">
                  <div class="project-icon">
                    <span class="fa fa-search"></span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- Item 3 -->
          <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="box-gallery">
              <a href="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" title="Gallery #3">
                <img src="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" alt="" class="img-fluid">
                <div class="project-info">
                  <div class="project-icon">
                    <span class="fa fa-search"></span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- Item 4 -->
          <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="box-gallery">
              <a href="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" title="Gallery #4">
                <img src="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" alt="" class="img-fluid">
                <div class="project-info">
                  <div class="project-icon">
                    <span class="fa fa-search"></span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-sm-12 col-md-12">
            <div class="text-center mt-5">
              <a href="#" class="btn btn-primary">VIEW MORE</a>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <!-- OUR LATEST BLOG -->
  <div class="section">
    <div class="content-wrap">
      <div class="container">
        <div class="row">

          <div class="col-sm-12 col-md-12">
            <h2 class="section-heading text-center mb-4">
              OUR LATEST BLOG
            </h2>
            <p class="subheading text-center mb-5">Start growing with Try Html Template</p>
          </div>

        </div>
        <div class="row">

          <!-- Item 1 -->
          <div class="col-12 col-md-6 mb-3">
            <div class="rs-news-1">
              <div class="media-box">
                <a href="#">
                  <img src="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
              <div class="body-box">
                <div class="meta-date"><span>30</span>May</div>
                <div class="title"><a href="#">Why you have difficult to clean your lawn</a></div>
                <p>We provide high quality design at vero eos et accusamus et iusto odio dignissimos ducimus qui
                  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores...</p>
              </div>
            </div>
          </div>

          <!-- Item 2 -->
          <div class="col-12 col-md-6 mb-3">
            <div class="rs-news-1">
              <div class="media-box">
                <a href="#">
                  <img src="{{ asset('end/front/images/dummy-img-900x600.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
              <div class="body-box">
                <div class="meta-date"><span>02</span>Des</div>
                <div class="title"><a href="#">We Open Recruitment for Landscaping</a></div>
                <p>We provide high quality design at vero eos et accusamus et iusto odio dignissimos ducimus qui
                  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores...</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- OUR TESTIMONIALS -->
  <div class="section bgi-cover-center" data-background="{{ asset('end/front/images/dummy-img-1920x900-3.jpg') }}">
    <div class="content-wrap">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <h2 class="section-heading text-center text-white">
              Happy Costumers
            </h2>
            <p class="subheading text-center mb-5 text-white">Every case is very important to us and we always take care
              of them seriously.</p>
          </div>
        </div>
        <div class="row">

          <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
            <div id="testimonial" class="owl-carousel owl-theme owl-light">
              <!-- Item 1 -->
              <div class="item">
                <div class="rs-box-testimony">

                  <div class="media-box">
                    <img src="{{ asset('end/front/images/dummy-img-400x400.jpg') }}" alt="" class="rounded-circle">
                  </div>
                  <div class="quote-box">
                    <blockquote class="quote">
                      Teritatis et quasi architecto. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                      accusantium dolore mque laudantium, totam rem aperiam
                    </blockquote>
                    <div class="quote-name">
                      Johnathan Doel <span>Businessman</span>
                    </div>
                  </div>

                </div>
              </div>
              <!-- Item 2 -->
              <div class="item">
                <div class="rs-box-testimony">

                  <div class="media-box">
                    <img src="{{ asset('end/front/images/dummy-img-400x400.jpg') }}" alt="" class="rounded-circle">
                  </div>
                  <div class="quote-box">
                    <blockquote class="quote">
                      Teritatis et quasi architecto. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                      accusantium dolore mque laudantium, totam rem aperiam
                    </blockquote>
                    <div class="quote-name">
                      Alisha Doel <span>Businessman</span>
                    </div>
                  </div>

                </div>
              </div>
              <!-- Item 3 -->
              <div class="item">
                <div class="rs-box-testimony">

                  <div class="media-box">
                    <img src="{{ asset('end/front/images/dummy-img-400x400.jpg') }}" alt="" class="rounded-circle">
                  </div>
                  <div class="quote-box">
                    <blockquote class="quote">
                      Teritatis et quasi architecto. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                      accusantium dolore mque laudantium, totam rem aperiam
                    </blockquote>
                    <div class="quote-name">
                      Johny Doel <span>Businessman</span>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

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
              Our Pricing Plans
            </h2>
            <p class="subheading text-center mb-5">Start growing with Try Html Template</p>
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
                  <li>Mendapatkan sertifikat bukti kepemilikan pohon porang di lahan binaan koperasi</li>
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
                  <li>Mendapatkan sertifikat bukti kepemilikan pohon porang di lahan binaan koperasi</li>
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

  <!-- OUR PARTNERS -->
  <div class="section bg-gray-light">
    <div class="content-wrap py-5">
      <div class="container">

        <div class="row gutter-5">
          <div class="col-6 col-md-4 col-lg-2">
            <a href="#"><img src="{{ asset('end/front/images/client1.png') }}" alt="" class="img-fluid img-border"></a>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <a href="#"><img src="{{ asset('end/front/images/client2.png') }}" alt="" class="img-fluid img-border"></a>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <a href="#"><img src="{{ asset('end/front/images/client3.png') }}" alt="" class="img-fluid img-border"></a>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <a href="#"><img src="{{ asset('end/front/images/client4.png') }}" alt="" class="img-fluid img-border"></a>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <a href="#"><img src="{{ asset('end/front/images/client5.png') }}" alt="" class="img-fluid img-border"></a>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <a href="#"><img src="{{ asset('end/front/images/client6.png') }}" alt="" class="img-fluid img-border"></a>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
