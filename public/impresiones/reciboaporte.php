<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RECIBO</title>
    <style>
        * {
            font-family: Consolas, monaco, monospace;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
    $data = $_GET['data'];
    // echo $data;
    $datos = explode('|', $data);

    $cuerpo = explode('~', $datos[2]);

    // foreach ($recibos as $recibo) {
    //     $venta = explode('|', $recibo);

    //     echo "<br>
    //             <h3>";
    //     if ($venta[1] != 'EXTRA') {
    //         echo $venta[1];
    //     } else {
    //         echo $venta[4];
    //     }
    //     echo "</h3>";
    //     echo "Nro.:" . str_pad($venta[0], 6, "0", STR_PAD_LEFT);
    //     echo "<br> ";
    //     echo "CLIENTE : $venta[2] <br>USUARIO : $venta[5] <br><b>$venta[3]</b><br><br><br><br> -------------------<br>";
    // }

    // 
    ?>

    <div style="width: 100%;text-align: center;">
        <img src="logoP.png" style="width: 100px;">
        <p><b><span style="font-size: 24px;">Fraternidad Puchachej</span></b> <br>
            <small>Fund. 24 De Febrero de 2004</small> <br>
            *********************************
        </p>

    </div>

    <h1 style="text-align: center;">RECIBO</h1>
    <p style="text-align: center;"><?php echo "<b>Fecha: </b>" . $datos[1];  ?></p>


    <p>
        <b>Miembro: </b>
        <?php
        echo $datos[0];
        ?>
    </p>

    <table style="width: 100%;border:1px;text-align: center;padding: 1;">
        <thead>
            <tr>
                <th>ID</th>
                <th>DETALLE</th>
                <th>CODIGO</th>
                <th>IMPORTE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($cuerpo as $fila) {
                $fila = explode('^', $fila);
                echo "<tr><td>$fila[0]</td>";
                echo "<td>$fila[1]</td>";
                echo "<td>$fila[2]</td>";
                echo "<td>" . number_format($fila[3], 2, '.') . "</td></tr>";
            }
            echo "<tr><td colspan=3 align=right><b>Total Bs. </b></td><td><b>" . number_format($datos[3], 2, '.') . "</b></td><tr>"
            ?>
        </tbody>
    </table>

    <p style="text-align: center;">
        Muchas Gracias! <br>
        *********************************
    </p>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            window.print();
            setTimeout(function() {
                // window.close();
            }, 3000);
        });
    </script>

</body>

</html>