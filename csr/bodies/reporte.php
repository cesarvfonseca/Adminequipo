<?php
require('../fpdf/fpdf.php');
include("../conexion.php");
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
 //    $this->Image('imagenes/cecyte.jpg' , 45 ,13, 117 , 20,'JPG');
	// $this->Image('imagenes/letras.png' , 45 ,13, 117 , 20,'PNG');
	// $this->Image('imagenes/dgeti.jpg' , 20 ,33, 22 , 21,'JPG');
	$this->Image('imagenes/mexqlg.jpg' , 150 ,10, 40 , 20,'JPG');
	
	$this->SetFont('Arial','B',14);
	$this->Text(47,40,utf8_decode('CARTA RESPONSIVA DE EQUIPO DE COMPUTO'),0,'C', 0);
	$this->SetFont('Arial','',12);
	// $this->Text(120,73,utf8_decode('Asunto: Constancia de Terminación de Estudios'),0,'C', 0);
	$this->Ln(5);
}

}
	// $num = $_POST['clave'];
	$num = $_GET['clave'];
	$strConsulta = "SELECT * FROM personas where cPerDni =  '$num'";
	$alumno = mysql_query($strConsulta);
	$fila = mysql_fetch_array($alumno);
	
	
	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(30);

	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    $pdf->SetXY(10,45);
	$pdf->SetFont('Arial','',11);
    // $pdf->Cell(80,10,"Fecha: ".date('d')."/".$meses[date('n')-1]."/".date('Y')."					Hora: ".date('H:i:s')."					ID:	".utf8_decode($fila['nPerCodigo']),0,1);
    $pdf->Cell(80,10,"Fecha: ".date('d')."/".$meses[date('n')-1]."/".date('Y'),0,1);
	$pdf->Ln(25);

	$pdf->SetXY(95,45);
	$pdf->SetFont('Arial','',11);
    $pdf->Cell(80,10,"Hora: ".date('H:i:s'),0,1);
	$pdf->Ln(25);

	$pdf->SetXY(175,45);
	$pdf->SetFont('Arial','',11);
    $pdf->Cell(80,10,"ID: ".utf8_decode($fila['nPerCodigo']),0,1);
	$pdf->Ln(25);

	$pdf->SetXY(10,45);
	$pdf->SetFont('Arial','',11);
    $pdf->Cell(80,25,"Nombre: ".utf8_decode($fila['cPerNombre'])." ".utf8_decode($fila['cPerApellido']),0,1);
	$pdf->Ln(25);

	$pdf->SetXY(10,45);
	$pdf->SetFont('Arial','',11);
    $pdf->Cell(80,55,"Dispositivo / accesorio: ".utf8_decode($fila['cPerDni']),0,1);
	$pdf->Ln(25);

	$pdf->SetXY(95,45);
	$pdf->SetFont('Arial','',11);
    $pdf->Cell(80,55,"Otros: ____________________________________",0,1);
	$pdf->Ln(25);

	// $pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');

	$pdf->SetFont('Arial','',11);
	$pdf->MultiCell(177,6, utf8_decode('El que suscribe, Encargado(a) del Departamento de Titulación del CECyTEA. Hace constar que el (a) C. '.utf8_decode($fila['cPerNombre']).', con Clave ').utf8_decode($fila['nPerCodigo']). utf8_decode('; concluyó sus actividades con el DNI ').utf8_decode($fila['cPerDni'].', con correo '.$fila['cPerEmail']). utf8_decode('; con telefono ').utf8_decode($fila['cPerTelefono']) ,0,'J');
	
	
	$pdf->MultiCell(177,6,utf8_decode('A petición del interesado, se expide la presente en la H. ciudad de Juchitán de Zaragoza, Oaxaca. A los '." ".date('d')." dias del mes de ".$meses[date('n')-1]. " de ".date('Y')."." ),0,'J');
    $pdf->Ln(50);
	
	$pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255); 
    
	$pdf->SetXY(20, 205);
    $pdf->Cell(70, 15, 'ELABORO:', 0, 0, 'C', 1);
	
	$pdf->SetXY(20, 230);
    $pdf->Cell(70, 5, '______________________', 0, 0, 'C', 1);     
    
	$pdf->SetXY(145, 205);
    $pdf->Cell(10, 15, 'Vo. Bo.', 0, 0, 'C', 1);
	
	$pdf->SetXY(145, 230);
    $pdf->Cell(10, 5, '_______________________________________', 0, 0, 'C', 1);
	
	$pdf->SetXY(20, 235);
    $pdf->Cell(70, 5, 'Nombre del Encargado', 0, 0, 'C', 1);     
	
	$pdf->SetXY(110, 235);
    $pdf->Cell(80, 5, 'Nombre del Direc', 0, 0, 'C', 1);
	
	$pdf->SetXY(20, 240);
    $pdf->Cell(70, 5, 'Encargado del Departamento..', 0, 0, 'C', 1);  
	
	$pdf->SetXY(110, 240);
    $pdf->Cell(80, 5, 'Director de la Escuela', 0, 0, 'C', 1);             
    $y      =   130;
    
	$pdf->Ln(40);
	$pdf->Image('imagenes/banerinferior_cecyte.jpg' , 2 ,273, 206 , 23,'JPG');
ob_end_clean();
$pdf->Output();
?>