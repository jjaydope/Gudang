<!DOCTYPE html>
<html>

<head>
    <title>City Girls</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        /* reset */
        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        /* content editable */

        *[] {
            border-radius: 0.25em;
            min-width: 1em;
            outline: 0;
        }

        *[] {
            cursor: pointer;
        }

        *[]:hover,
        *[]:focus,
        td:hover *[],
        td:focus *[],
        img.hover {
            background: #DEF;
            box-shadow: 0 0 1em 0.5em #DEF;
        }

        span[] {
            display: inline-block;
        }

        /* heading */

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th,
        td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #DDA0DD;
            border-color: #8A2BE2;
        }

        td {
            border-color: #BA55D3;
        }

        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        html {
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 8.5in;
        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        /* header */

        header {
            margin: 0 0 3em;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #800080;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
        }

        header span,
        header img {
            display: block;
            float: right;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        header img {
            max-height: 100%;
            max-width: 100%;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 26%;
        }

        table.inventory td:nth-child(2) {
            width: 38%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(5) {
            text-align: right;
            width: 12%;
        }

        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */

        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }



        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut {
                display: none;
            }
        }

        @page {
            margin: 0;
        }
    </style>
</head>

<body>
    <?php
    include 'koneksi.php';
    $tr_id = $_GET['id_transaksi'];
    $qry_transaksi = mysqli_query($conn, "SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl, p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas AND t.id_transaksi =  $tr_id");
    // echo "SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl, t.batas_waktu, t.tgl_bayar, t.status, t.dibayar, u.nama as nama_kasir FROM transaksi t, member m, user u WHERE t.id_member = m.id_member AND t.id_user = u.id_user";
    $no = 0;
    while ($data_transaksi = mysqli_fetch_array($qry_transaksi)) {
        $qry_dtl_transaksi = mysqli_query($conn, "SELECT *, qty  FROM detail_transaksi, barang WHERE id_transaksi = " . $data_transaksi['t_id'] . " AND barang.id_barang = detail_transaksi.id_barang");
        //    echo "SELECT *, qty * harga as total FROM detail_transaksi, paket WHERE id_transaksi = ".$data_transaksi['t_id']." AND paket.id_paket = detil_transaksi.id_paket";
        $no++;

        $i = 0;
        while ($data_dtl_transaksi = mysqli_fetch_assoc($qry_dtl_transaksi)) {
            //echo $sql;

            // var_dump($data); die();

            $i++;
            if ($i == 1) {
    ?>
                <header>
                    <h1>FORM PENGAMBILAN BARANG</h1>
                    <address>
                        <h7>Officer Name :<?php echo $data_transaksi['nama_kasir']; ?></h7 <span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
                </header>
                <article>
                    <h1>Recipient</h1>
                    <address>
                        <p>DETAIL PENGAMBILAN BARANG</p>
                    </address>
                    <table class="meta">
                        <tr>
                            <th><span>ID transaksi</span></th>
                            <td><span><?php echo $data_transaksi['t_id']; ?></span></td>
                        </tr>
                        <tr>
                            <th><span>Tanggal</span></th>
                            <td><span><?php echo date('d F Y', strtotime($data_transaksi['tgl'])); ?></span></td>
                        </tr>
                        <!-- <tr>
					<th><span >Total</span></th>
					<td><span ><//?php echo $data['qty']; ?></span></td> 
				</tr> -->
                    </table>
                    <table class="inventory">
                        <thead>
                            <tr>
                                <th><span>Member</span></th>
                                <th><span>Barang</span></th>
                                <th><span>Quantity</span></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td><a class="cut"></a><span><?php echo $data_transaksi['nama_member']; ?></span></td>
                                <td><span><?php
                                            include "koneksi.php";
                                            $qry_get_barang = mysqli_query($conn, "select * from barang where id_barang='" . $data_dtl_transaksi['id_barang'] . "'");
                                            $data_barang = mysqli_fetch_array($qry_get_barang);
                                            echo $data_barang['nama_barang'];
                                            ?>
                                        <!-- <?php echo $data_barang['id_barang'] ?> -->
                                    </span></td>
                                <td><span><?php echo $data_dtl_transaksi['qty']; ?></span></td>
                            </tr>
                        <?php
                    } else {
                        ?>
                            <tr>
                                <td></td>
                                <td><?php
                                    include "koneksi.php";
                                    $qry_get_barang = mysqli_query($conn, "select * from barang where id_barang='" . $data_dtl_transaksi['id_barang'] . "'");
                                    $data_barang = mysqli_fetch_array($qry_get_barang);
                                    echo $data_barang['nama_barang'];
                                    ?>
                                    <!-- <?= $data_barang['id_barang'] ?> -->
                                </td>
                                <td><?= $data_dtl_transaksi['qty'] ?></td>


                            </tr>
                    <?php
                    }
                }
                    ?>
                        </tbody>
                    </table>

                    <table class="balance">
                    </table>
                    <br /> <br />
                    <th style='border:1px solid black; padding:5px; text-align:left; width:30%'></th>
                    <td><span>
                            <h2>Penerima:</h2> <br /> <?php echo $data_transaksi['nama_member']; ?>
                        </span></td> </br></br><br /> <u>(...........)</u>

                <?php


            }
                ?>
                </article>

                <!-- <script>window.print();</script> -->
</body>

</html>