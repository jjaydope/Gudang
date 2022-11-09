<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <title>Barang</title>
  <style type="text/css">
    body {
      padding: 20px
    }

    .content {
      padding: 40px 20px;
      background: lightblue;
      border-radius: 10px;
    }

    .table_content tr td:nth-child(1) {
      width: 110px;
    }

    .table_content tr td:nth-child(2) {
      width: 50px;
    }

    .table_content tr td:nth-child(3) {
      width: 440px;
    }

    .table_content tr td {
      padding: 7px;
    }

    input[type=text] {
      width: 100%;
      height: 33px;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <div align="center">
      <h3>Tambah Barang</h3>
    </div>
    Kode Barcode : <input type='text' id="input_scanner">
    Nama Item : <input type='text' id="nama_barang">
    stok : <input type='text' id="stok">
  </div>
  </div>
  <br>
  <a href="tampil_barang.php" class="btn btn-danger">Kembali</a>
  <button type="button" id="btn_simpan" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
  <p id="message_info"></p>

  <script>
    $(document).ready(function() {
      $('#input_scanner').val("").focus();
      $('#input_scanner').keyup(function(e) {
        var tex = $(this).val();
        if (tex !== "" && e.keyCode === 13) {
          $('#input_scanner').val(tex).focus();
        }
        e.preventDefault();
      });
      $('#btn_simpan').click(function() {
        let input_scanner = $('#input_scanner').val();
        let nama_barang = $('#nama_barang').val();
        let stok = $('#stok').val();
        if (input_scanner !== "" & nama_barang !== "" & stok !== "") {
          $.ajax({
            type: 'POST',
            url: 'zummy5.php',
            data: {
              "input_scanner": input_scanner,
              "nama_barang": nama_barang,
              "stok": stok
            },
            beforeSend: function(response) {
              $('#message_info').html("Sedang memproses data, silahkan tunggu...");
            },
            success: function(response) {
              $('#message_info').html("");
              alert(response);
              $('#input_scanner,#nama_barang,#stok').val("");
              $('#input_scanner').focus();
            }
          });
        } else {
          alert("input tidak boleh kosong..");
          $('#input_scanner').focus();
        }
      });
      $('#btn_batal').click(function() {
        $('#input_scanner,#nama_barang,#stok').val("");
        $('#input_scanner').focus();
      });
    });
  </script>
</body>

</html>