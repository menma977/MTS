<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>MTS</title>
</head>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    background: #EEA;
  }

  #sertifikat {
    width: 100vw;
    height: 65.665083135392vw;
    background-size: 100% 100%;
  }
</style>

<body>
<canvas id="sertifikat">
</canvas>
<img src="data:image/png;base64, {!! base64_encode($qr) !!} " style="display:none" id="hiddenQR" alt="imageQR"/>

<script>
    function buatCert(data, bg, qr) {
        const canvas = document.querySelector("#sertifikat");
        const ctx = canvas.getContext('2d');
        canvas.width = 842;
        canvas.height = 595;
        let hh = 242.5;
        let hhgap = 14;

        ctx.drawImage(bg, 0, 0, 842, 595);
        ctx.drawImage(qr, 680, 460, 100, 100);
        ctx.font = "11px Serif";
        ctx.fillText(data.nama, 470, hh);
        hh += hhgap;
        ctx.fillText(data.alamat, 470, hh);
        hh += hhgap;
        ctx.fillText(data.hp, 470, hh);
        hh += hhgap;
        ctx.fillText(data.jumlah_kav, 470, hh);
        hh += hhgap;
        ctx.fillText(data.no_kav, 470, hh);
        hh += hhgap;
        ctx.fillText(data.gabung, 470, hh)
    }

    window.addEventListener("load", async e => {
        const bg = await loadImage("{{ $tree->type == 0 ? asset('img/porang.jpg') : asset('img/talas.jpg') }}");
        const qr = document.querySelector("#hiddenQR");
        buatCert({
            nama: "{{ $tree->user->name }}",
            alamat: "{{ $tree->user->address }}",
            hp: "{{ $tree->user->phone }}",
            jumlah_kav: "1",
            no_kav: "{{ str_replace('code-','Kafling-',$tree->code) }}",
            gabung: "{{ \Carbon\Carbon::parse($tree->user->created_at)->format('d-m-Y') }}"
        }, bg, qr);

        function loadImage(src) {
            return new Promise((resolve, reject) => {
                const image = new Image();
                image.src = src;
                image.addEventListener("load", e => resolve(image));
                image.addEventListener("error", e => reject(e));
            });
        }
    });
</script>
</body>

</html>
