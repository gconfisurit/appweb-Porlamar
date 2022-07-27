<?php
//LLAMAMOS A LA CONEXION BASE DE DATOS.
require_once '../../config/conexion.php';

//LLAMAMOS AL MODELO DE ACTIVACIONCLIENTES
require_once 'clientescodnestle_modelo.php';

//INSTANCIAMOS EL MODELO
$clientescodnestle = new ClientesCodNestle();

//VALIDAMOS LOS CASOS QUE VIENEN POR GET DEL CONTROLADOR.
switch ($_GET['op']) {
    case 'buscar_clientescodnestle':
        $datos = $clientescodnestle->getClientes_cnestle(
            $_POST['opc'],
            $_POST['vendedor']
        );

        //DECLARAMOS UN ARRAY PARA EL RESULTADO DEL MODELO.
        $data = [];

        foreach ($datos as $row) {
            //DECLARAMOS UN SUB ARRAY Y LO LLENAMOS POR CADA REGISTRO EXISTENTE.
            $sub_array = [];

            $sub_array[] = $row['CodVend'];
            $sub_array[] = $row['CodClie'];
            $sub_array[] = $row['Descrip'];
            $sub_array[] = $row['ID3'];
            $sub_array[] = date(FORMAT_DATE, strtotime($row['FechaE']));
            $sub_array[] = $row['DiasVisitas'];
            $sub_array[] = $row['Clasificacion'];
            $data[] = $sub_array;
        }

        //RETORNAMOS EL JSON CON EL RESULTADO DEL MODELO.
        $results = [
            'sEcho' => 1, //INFORMACION PARA EL DATATABLE
            'iTotalRecords' => count($data), //ENVIAMOS EL TOTAL DE REGISTROS AL DATATABLE.
            'iTotalDisplayRecords' => count($data), //ENVIAMOS EL TOTAL DE REGISTROS A VISUALIZAR.
            'aaData' => $data,
        ];

        echo json_encode($results);
        break;

    case 'listar_vendedores':
        $output['lista_vendedores'] = Vendedores::todos();

        echo json_encode($output);
        break;
}
