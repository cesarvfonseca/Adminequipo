<?php
require('../fpdf/fpdf.php');
include("../conexion.php");
// require_once('../libs/QrCode-master/src/QrCode.php');
include('../libs/qrcode-lib/qrlib.php');

// require('../fpdf/WriteHTML.php');
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

	//Checklist
	$this->SetDrawColor(0,0,0);	
	$this->SetLineWidth(1);	
	$this->Rect(30,50,150,70,"A");

	$this->SetDrawColor(0,0,0);	
	$this->SetLineWidth(.5);	
	$this->Rect(30,64,40,56,"A");

	$this->SetDrawColor(0,0,0);	
	$this->SetLineWidth(.4);	
	$this->Rect(110,78,20,7,"A");

	$cnt=7;
	while ( $cnt < 70) {
		$cnt = $cnt+7;
		$this->SetDrawColor(0,0,0);	
		$this->SetLineWidth(.4);	
		$this->Rect(30,50,150,$cnt,"A");
	}
	//Checklist

	/*CUADRICULA*/
}

}
	$num = $_GET['clave'];
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

    //CODIGO QR 
	$codeContents = $qrnSerie;
	$fileName = $qrName.".png";
    $tempDir = "QR/";
	$pngAbsoluteFilePath = $tempDir.$fileName;
	$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;

	QRcode::png($codeContents, $pngAbsoluteFilePath); 
	$pdf->Image("QR/$qrName".".png",160,11,33);
	//CODIGO QR

    //CHECKLIST INFO
 	$pdf->Image('imagenes/mexqlg.jpg' , 35 ,51, 35 , 12,'JPG');
 	$pdf->SetFont('Arial','',10);
   	$pdf->SetXY(70,52);
    $pdf->Write(5,utf8_decode("Propiedad de Servicios de Aseguramiento de Calidad Muñing S.C."));
 	$pdf->SetFont('Arial','B',14);
   	$pdf->SetXY(95,58);
    $pdf->Write(5,utf8_decode("RESPALDO DE EQUIPO"));
    $pdf->SetFont('Arial','',14);
   	$pdf->SetXY(30,65);
    $pdf->Write(5,"Responsable        ".utf8_decode($fila['nombre'])." ".utf8_encode($fila['apellido']),0,1);
   	$pdf->SetXY(30,72);
    $pdf->Write(5,"Equipo                  ".utf8_decode($fila['tipo']));
    $pdf->SetXY(30,79);
    $pdf->Write(5,"Marca                   ".utf8_decode($fila['marca']));
    $pdf->SetXY(110,79);
    $pdf->Write(5,"Modelo   ".utf8_decode($fila['modelo']));
    $pdf->SetXY(30,86);
    $pdf->Write(5,"No. de Serie         ".utf8_decode($fila['numero_serie']));
    $pdf->SetXY(30,93);
    $pdf->Write(5,"No. de Producto   ".utf8_decode($fila['numero_producto']));
    $pdf->SetXY(30,100);
    $pdf->Write(5,"Sucursal / Planta  ".utf8_decode($fila['sucursal'])." / ".utf8_decode($fila['planta_depto']));
    $pdf->SetXY(30,107);
    $pdf->Write(5,"Fecha                   ".utf8_decode($fila['fecha']));
    $pdf->SetXY(30,114);
    $pdf->Write(5,"Codigo                  ".utf8_decode($fila['cod_equipo']));
    $pdf->Image("QR/$qrName".".png",146.5,86,33);
    //CHECKLIST INFO

	$pdf->Image('imagenes/mexq_ban1.jpg' , 2 ,273, 206 , 23,'JPG');
	
	ob_end_clean();
	$pdf->Output();
?>