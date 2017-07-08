<?php
require('../fpdf/fpdf.php');
include("../conexion.php");
include('../libs/qrcode-lib/qrlib.php');

$conexion=conectar();

class PDF extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		
		$this->Rect($x,$y,$w,$h);

		$this->MultiCell($w,5,$data[$i],0,$a,'true');
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}


function Header()
{
 	$this->Image('imagenes/mexqlg.jpg' , 15 ,18, 40 , 20,'JPG');
	$this->SetFont('Arial','B',12);
	$this->Text(67,18,utf8_decode('SERVICIOS DE ASEGURAMIENTO DE'),0,'C', 0);
	$this->Text(82,23,utf8_decode('CALIDAD MUÑING S.C.'),0,'C', 0);
	$this->SetFont('Arial','',12);
	$this->Text(71,35,utf8_decode('CARTA RESPONSIVA DE EQUIPO'),0,'C', 0);
	$this->Text(89,39,utf8_decode('DE COMPUTO'),0,'C', 0);

	// $this->Ln(5);

	/*CUADRICULA*/
	//HLSQR
	$this->SetDrawColor(0,0,0);	
	$this->SetLineWidth(.5);	
	$this->Rect(10,10,50,35,"A");
	//HCSQR
	$this->SetDrawColor(0,0,0);	
	$this->SetLineWidth(.5);	
	$this->Rect(60,10,90,35,"A");
	//HLSQR
	$this->SetDrawColor(0,0,0);	
	$this->SetLineWidth(.5);	
	$this->Rect(150,10,50,35,"A");

	/*CUADRICULA*/

}

}
	$num = $_GET['clave'];
	// $strConsulta = "SELECT * FROM equipos where cod_equipo =  '$num'";
	$strConsulta = "SELECT * FROM equipos e INNER JOIN responsables r ON e.RESPONSABLES_cod_resp=r.cod_resp AND e.cod_equipo='$num';";
	$datos = mysql_query($strConsulta);
	$fila = mysql_fetch_array($datos);

	$qrnSerie="NS: ".$fila['numero_serie']."| NP: ".$fila['numero_producto']."| Marca: ".$fila['marca'];
	$qrName=$fila['numero_serie'];

	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);

	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    //DATOS EMPLEADO
	$pdf->SetDrawColor(0,0,0);	
	$pdf->SetLineWidth(.5);	
	$pdf->Rect(25,50,160,14,"A");

	$pdf->SetDrawColor(0,0,0);	
	$pdf->SetLineWidth(.5);	
	$pdf->Rect(25,50,160,7.2,"A");

	$pdf->SetDrawColor(0,0,0);	
	$pdf->SetLineWidth(.5);	
	$pdf->Rect(25,50,90,14,"A");
	//DATOS EMPLEADO

    //CODIGO QR 
	$codeContents = $qrnSerie;
	$fileName = $qrName.".png";
    $tempDir = "QR/";
	$pngAbsoluteFilePath = $tempDir.$fileName;
	$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;

	QRcode::png($codeContents, $pngAbsoluteFilePath); 
	$pdf->Image("QR/$qrName".".png",160,11,33);
	//CODIGO QR
	$pdf->SetXY(165,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,55,"Fecha: ".date('d')."/".$meses[date('n')-1]."/".date('Y'),0,1);

	$pdf->SetXY(165,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,65,"Hora: ".date('G:i:s',time()),0,1);

	// DATOS TRABAJADOR
	$pdf->SetXY(25,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,20,"Nombre: ".utf8_decode($fila['nombre'])." ".utf8_encode($fila['apellido']),0,1);

	$pdf->SetXY(25,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,30,"Sucursal: ".utf8_decode($fila['sucursal']),0,1);

	$pdf->SetXY(115,40);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,30,"Puesto: ".utf8_decode($fila['puesto']),0,1);

    $pdf->SetXY(115,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,30,"Planta / Depto: ".utf8_decode($fila['sucursal'])." / ".utf8_decode($fila['planta_depto']));

	$pdf->SetXY(25,45);
	$pdf->SetFont('Arial','B',10);
    $pdf->Cell(80,55,"Codigo: ".utf8_decode($fila['cod_equipo']),0,1);

    $pdf->SetXY(165,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,75,"Tipo: ".utf8_decode($fila['tipo']),0,1);

    $pdf->SetXY(25,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,65,"Marca: ".utf8_decode($fila['marca']),0,1);

    $pdf->SetXY(25,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,75,"Modelo: ".utf8_decode($fila['modelo']),0,1);

    $pdf->SetXY(25,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,85,"No. Serie: ".utf8_decode($fila['numero_serie']),0,1);

    $pdf->SetXY(25,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,95,"No. Producto: ".utf8_decode($fila['numero_producto']),0,1);

    $pdf->SetXY(100,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,55,"No. Factura: ".utf8_decode($fila['numero_factura']),0,1);

    $pdf->SetXY(100,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,65,"Proveedor: ".utf8_decode($fila['proveedor']),0,1);

    $pdf->SetXY(100,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,75,"Fecha Factura: ".utf8_decode($fila['fecha_factura']),0,1);

    $pdf->SetXY(100,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,85,"Status: ".utf8_decode($fila['status']),0,1);

    $pdf->SetXY(100,45);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,95,"Comentarios: ".utf8_decode($fila['comentarios']),0,1);


    $pdf->SetXY(90,50);
	$pdf->SetFont('Arial','',12);
    $pdf->Cell(80,112,"Especificaciones",0,1);

    $pdf->SetXY(60,55);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,112,"Disco Duro: ".utf8_decode($fila['disco_duro']),0,1);

    $pdf->SetXY(120,55);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,112,"Memoria RAM: ".utf8_decode($fila['ram']),0,1);

    $pdf->SetXY(120,55);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,125,"Procesador: ".utf8_decode($fila['procesador']),0,1);

    $pdf->SetXY(60,55);
	$pdf->SetFont('Arial','',10);
    $pdf->Cell(80,125,"Sistema Operativo: ".utf8_decode($fila['sistema_operativo']),0,1);+


    $pdf->SetXY(30,125);
    $pdf->Write(8,utf8_decode("Equipo de Computo Portatil Servicios de Aseguramiento de Calidad Muñing S.C."));
    $pdf->SetXY(20,135);
    $pdf->Write(5,utf8_decode("Me hago responsable del equipo, el cual me fue asignado como herramienta de trabajo para el "));
    $pdf->Write(5,utf8_decode("desempeño de mis funciones. Me comprometo a respetar, aplicar y cumplir las políticas de uso,"));
    $pdf->Write(5,utf8_decode("manejo de información, seguridad, asignación y recuperación de equipo así como todas aquellas que MEXQ establezca."));
    $pdf->SetXY(20,152);
    $pdf->Write(5,utf8_decode("Al no requerir el equipo y/o programas instalados por razón de termino de mi relación laboral con"));
    $pdf->Write(5,utf8_decode("la empresa Servicios de Aseguramiento de Calidad Muñing S.C., reasignación de actividades, etc. "));
    $pdf->Write(5,utf8_decode("Soy responsable de regresar el equipo al Departamento de TI para la cancelación de este"));
    $pdf->Write(5,utf8_decode("documento. En caso de no devolverlo total o parcialmente se me descontara de mi sueldo el costo"));
    $pdf->Write(5,utf8_decode("de reposición según la factura de compra, en caso de robo es mi responsabilidad levantar una "));
    $pdf->Write(5,utf8_decode("denuncia ante el Ministerio Publico y entregar una copia e informar al Departamento de TI para que se hagan los tramites correspondientes."));
    
    $pdf->SetXY(20,230);
    $pdf->Write(5,utf8_decode("__________________________________"));
    $pdf->SetXY(33,235);
    $pdf->Write(5,utf8_decode("Nombre y Firma de Usuario"));

    $pdf->SetXY(120,230);
    $pdf->Write(5,utf8_decode("__________________________________"));
    $pdf->SetXY(133,235);
    $pdf->Write(5,utf8_decode("Nombre y Firma de entrega"));

    $pdf->SetXY(20,250);
    $pdf->Write(5,utf8_decode("Observaciones: __________________________________________________________________________________________________________________________________________________________________________"));

	$pdf->Image('imagenes/mexq_ban1.jpg' , 2 ,273, 206 , 23,'JPG');

	ob_end_clean();
	$pdf->Output();
?>