<?php

//LLAMAMOS A LA CONEXION BASE DE DATOS.
require_once '../../config/conexion.php';

//LLAMAMOS AL MODELO DE ACTIVACIONCLIENTES
require_once 'sellin_modelo.php';

//INSTANCIAMOS EL MODELO
$sellin = new sellin();

//VALIDAMOS LOS CASOS QUE VIENEN POR GET DEL CONTROLADOR.
switch ($_GET['op']) {
    case 'buscar_sellin':
        $datos = $sellin->getsellin(
            $_POST['fechai'],
            $_POST['fechaf'],
            $_POST['marca']
        );

        //DECLARAMOS UN ARRAY PARA EL RESULTADO DEL MODELO.
        $data = [];
        $suma_compras = 0;
        $suma_devol = 0;
        foreach ($datos as $row) {
            //DECLARAMOS UN SUB ARRAY Y LO LLENAMOS POR CADA REGISTRO EXISTENTE.
            $sub_array = [];

            $sub_array[] = $row['coditem'];
            $sub_array[] = $row['producto'];
            $sub_array[] = $row['marca'];
            $sub_array[] = Strings::rdecimal($row['compras'], 2);
            $sub_array[] = Strings::rdecimal($row['devol'], 2);
            $sub_array[] = Strings::rdecimal($row['total'], 2);
            $suma_compras += $row['compras'];
            $suma_devol += $row['devol'];
            $data[] = $sub_array;
        }

        //RETORNAMOS EL JSON CON EL RESULTADO DEL MODELO.
        $results = [
            'sEcho' => 1, //INFORMACION PARA EL DATATABLE
            'iTotalRecords' => count($data), //ENVIAMOS EL TOTAL DE REGISTROS AL DATATABLE.
            'Mtototal' => Strings::rdecimal($suma_compras, 2),
            'totalDevol' => Strings::rdecimal($suma_devol, 2),
            'iTotalDisplayRecords' => count($data), //ENVIAMOS EL TOTAL DE REGISTROS A VISUALIZAR.
            'aaData' => $data,
        ];

        echo json_encode($results);
        break;

    case 'listar_marcas':
        $output['lista_marcas'] = Marcas::todos();

        echo json_encode($output);
        break;
}
