
<?php
//LLAMAMOS A LA CONEXION.
require_once '../../config/conexion.php';

class ClientesNoActivos extends Conectar
{
    public function getClientesNoactivos($edv, $fechai, $fechaf)
    {
        $i = 0;
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar = parent::conexion2();
        parent::set_names();

        //QUERY

        $sql = "SELECT cli.codclie as codclie, cli.descrip as descrip, cli.id3 as id3 , cli01.diasvisitas as visita, cli.Direc1 ,cli.Direc2 , cli.EsCredito    from SACLIE as CLI inner join saclie_01 as CLI01 ON CLI.codclie = CLI01.codclie where CLI.codclie not in
(SELECT distinct(SAFACT.CodClie) AS CODCLIE FROM SAFACT WHERE SAFACT.CodVend = '$edv' AND TipoFac = 'A' AND SAFACT.CodClie IN (SELECT SACLIE.CodClie FROM SACLIE INNER JOIN SACLIE_01 ON SACLIE.CodClie = SACLIE_01.CodClie
WHERE ACTIVO = 1 AND (SACLIE.CodVend = '$edv' or SACLIE_01.Ruta_Alternativa = '$edv' OR SACLIE_01.Ruta_Alternativa_2 = '$edv')) AND DATEADD(dd, 0, DATEDIFF(dd, 0, SAFACT.FechaE)) between '$fechai' and '$fechaf' AND NumeroD NOT IN (SELECT X.NumeroD FROM SAFACT AS X WHERE X.TipoFac = 'A' AND x.NumeroR is not NULL AND cast(X.Monto as int) = cast((select Z.Monto from SAFACT AS Z where Z.NumeroD = x.NumeroR and Z.TipoFac = 'B')as int)))
and CLI.activo = 1 and (CLI.CodVend = '$edv' or CLI01.Ruta_Alternativa = '$edv' OR CLI01.Ruta_Alternativa_2 = '$edv') order by cli.Descrip";

        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        /*$sql->bindValue($i+=1,$edv);
		$sql->bindValue($i+=1,$edv);
		$sql->bindValue($i+=1,$edv);
		$sql->bindValue($i+=1,$edv);
		$sql->bindValue($i+=1,$fechai);
		$sql->bindValue($i+=1,$fechaf);

        $sql->bindValue($i+=1,$edv);
        $sql->bindValue($i+=1,$edv);
        $sql->bindValue($i+=1,$edv);
        $sql->bindValue($i+=1,$edv);
        $sql->bindValue($i+=1,$fechai);
        $sql->bindValue($i+=1,$fechaf);

		$sql->bindValue($i+=1,$edv);
		$sql->bindValue($i+=1,$edv);
		$sql->bindValue($i+=1,$edv);*/
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientesNoactivosTODOS($edv)
    {
        $i = 0;
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar = parent::conexion2();
        parent::set_names();

        //QUERY

        $sql = " SELECT (select count(CodClie) FROM SACLIE INNER JOIN savend on savend.CodVend = SACLIE.CodVend WHERE SACLIE.activo = '1' AND savend.CodVend = '$edv') as cliente_activo , 
			(select count(CodClie) FROM SACLIE INNER JOIN savend on .savend.CodVend = SACLIE.CodVend WHERE SACLIE.activo = '0' AND savend.CodVend = '$edv') as cliente_inactivo FROM savend WHERE activo = '1' ORDER BY CodVend ASC ";

        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /*public function getTotalClientesnoActivos($fechai,$fechaf,$vendedor){

        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
		$conectar= parent::conexion2();
		parent::set_names();

        //QUERY
		$sql= "SELECT count(cli.codclie) AS cuenta from SACLIE AS CLI inner join saclie_01 AS CLI01 ON CLI.codclie = CLI01.codclie WHERE CLI.codclie not IN
		(SELECT distinct(SAFACT.CodClie) AS CODCLIE FROM SAFACT WHERE SAFACT.CodVend = ? AND TipoFac = 'A' AND SAFACT.CodClie IN (SELECT SACLIE.CodClie FROM SACLIE INNER JOIN SACLIE_01 ON SACLIE.CodClie = SACLIE_01.CodClie
		WHERE ACTIVO = 1 AND (SACLIE.CodVend = ? or SACLIE_01.Ruta_Alternativa = ? OR SACLIE_01.Ruta_Alternativa_2 = ?)) AND DATEADD(dd, 0, DATEDIFF(dd, 0, SAFACT.FechaE)) BETWEEN ? AND ? AND NumeroD NOT IN (SELECT X.NumeroD FROM SAFACT AS X WHERE X.TipoFac = 'A' AND x.NumeroR IS NOT NULL AND cast(X.Monto AS int) = cast((SELECT Z.Monto FROM SAFACT AS Z WHERE Z.NumeroD = x.NumeroR AND Z.TipoFac = 'B') AS int)))
		AND CLI.activo = 1 AND (CLI.CodVend = ? OR CLI01.Ruta_Alternativa = ? OR CLI01.Ruta_Alternativa_2 = ?)  ";

        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
		$sql = $conectar->prepare($sql);
		$sql->bindValue(1,$vendedor);
		$sql->bindValue(2,$vendedor);
		$sql->bindValue(3,$vendedor);
		$sql->bindValue(4,$vendedor);
		$sql->bindValue(5,$fechai);
		$sql->bindValue(6,$fechaf);
		$sql->bindValue(7,$vendedor);
		$sql->bindValue(8,$vendedor);
		$sql->bindValue(9,$vendedor);
		$sql->execute();
		return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

	}*/
}

