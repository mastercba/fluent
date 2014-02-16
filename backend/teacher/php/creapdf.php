<?php
	session_start();

	require('fpdf.php');

	//Recupero variables
	$mes_ano = $_GET['mesyano'];

	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];
	$tname = $_SESSION['nombre'];
	$tlast = $_SESSION['apellido'];

	//separa las variable
	$month = strtok($mes_ano," ");
	$year = strtok(" "); 


/////////////////////////////////////////////////////////////////////////////////////////////empieza a crear pdf///

class myPDF extends FPDF {

// Header
function Header()
{
    if($pdf->PageNo()==1)
    {
        //First page
        
    }
    else
    {
        //Other pages
        // Insert a logo in the top-left corner at 300 dpi
	$pdf->Image('logo2.png',150,10,60,15);
    }
}

}

	$pdf = new FPDF('P', 'mm', 'Letter' );
	
	//Add first page
	$pdf->AddPage();
	//margins
	$pdf->SetMargins(19,1,1);	 
	//set initial y axis position per page
	$h = 5;		//5:	
	$y = 23;	//30;
	$x = 19;	//19;
	$pdf->SetXY($x,$y);
	//initialize counter
	//Set maximum rows per page
	//Set Row Height

// Insert Title
	$pdf->SetFont('courier','',14);
	$pdf->Cell(185,$h,'TRAINER`s REPORT', 0,0,'C');

	$y = $y + 7;
	$pdf->SetXY($x,$y);

// Insert a logo in the top-left corner at 300 dpi
	$pdf->Image('logo2.png',150,10,60,15);

//trainer's name
	$pdf->SetFont('courier','',10);
	$pdf->Cell($x,$h,'Trainer: ', 0,0,'L');
	$pdf->SetFont('courier','',14);
	$pdf->Cell(20,$h,"$tname", 0,0,'L');
	$pdf->Cell(22,$h,"$tlast", 0,0,'L');

//month's report
	$pdf->ln();
	//$y = 11; $x = 18;
	$pdf->SetFont('courier','',10);
	//$pdf->SetMargins(30,1,1);
	$pdf->Cell($x,$h,'Period: ', 0,0,'L');
	$pdf->SetFont('courier','',12);
	$pdf->Cell(8,$h,"$month", 0,0,'C');
	$pdf->Cell(5,$h,'/', 0,0,'C');
	$pdf->Cell(20,$h,"$year", 0,0,'L');
//date reported
	//lee la fecha 
	$data = date("d/m/Y");
	$pdf->ln();
	//$y = 11; $x = 18;
	$pdf->SetFont('courier','',10);
	//$pdf->SetMargins(30,1,1);
	$pdf->Cell($x,$h,'Date: ', 0,0,'L');
	$pdf->SetFont('courier','',12);
	$pdf->Cell(8,$h,"$data", 0,0,'L');

	$pdf->ln();	$pdf->ln(); 
//cabecera de la tabla
		$y = 50;
	    $pdf->SetFont('courier','B','10');
	    $pdf->SetFillColor(128,128,128);
	    $pdf->SetTextColor(255);
	    $pdf->SetDrawColor(92,92,92);
	    $pdf->SetLineWidth(.3);

	    $pdf->Cell(30,7,"DATE",1,0,'C',true);
	    $pdf->Cell(95,7," STUDENT",1,0,'L',true);
	    $pdf->Cell(30,7,"HOURS",1,0,'C',true);
	    $pdf->Cell(30,7,"STATUS",1,0,'C',true);
	    //$pdf->Ln();

	    $pdf->SetFillColor(224,235,255);
	    $pdf->SetTextColor(0);
	    $pdf->SetFont('');
	    $fill = false;

	//inicia tabla
	$pdf->SetFont('courier','',10);
	$pdf->SetXY($x,$y);
	
	$page = -1;

//lee base de datos e imprime tabla
	
		//connect to database
		//conexion
			$conexion = mysql_connect("localhost","quantid0_marco","~marco");
			if(!$conexion){
			die ("No he podido conectar por la siguiente razon: ".mysql_error());
			}	
			mysql_select_db("quantid0_fluent",$conexion); 
		//muestra el detalle del mes
			$result = mysql_query("SELECT * FROM events order by event_date", $conexion);
			$row = mysql_fetch_array($result);

		// build the data array from the database records.

			do{
				//tranforma la fecha del evento de la db para ver el mes
				$str_db = $row['event_date'];                //'2012/11/4';   //$row['event_date'];
				$str = date("d-m-Y",strtotime($str_db));
				$fecha_db = (explode('-', $str, 3));
				//valido dia
				$dia_db = $fecha_db[0];
				$mes_db = $fecha_db[1];
				$ano_db = $fecha_db[2];

			   if($row['idteacher'] == $teacherid AND $month == $mes_db AND $year == $ano_db){	

				$date= $row['event_date'];
						$result1 = mysql_query("SELECT * FROM students", $conexion);
						$who = mysql_fetch_array($result1);		
							do{
								if($row['idstudent']== $who['id']){
									$student = " ".$who['nombre']." ".$who['apellido']." ";
									$company = $who['awork'];
								}else{}
				   			}while($who = mysql_fetch_array($result1));

				$min = $row['hrs'];
				$stat = $row['idstatus'];
						//paginacion
						$page = $page + 1;
							if($page == 28){
								$page = -1;
								$y = 10;
								//ultima linea
								$pdf->Cell(185,0,'','T');
								//text
							        $pdf->Ln();
								$pdf->Cell(185,$h,'Continue..', 0,0,'R');
								$pdf->AddPage();

								//cabecera de la 2da tabla
										$y = 30;
									    $pdf->SetXY(19,$y);
									    $pdf->SetFont('courier','B','10');
									    $pdf->SetFillColor(128,128,128);
									    $pdf->SetTextColor(255);
									    $pdf->SetDrawColor(92,92,92);
									    $pdf->SetLineWidth(.3);

									    $pdf->Cell(30,7,"DATE",1,0,'C',true);
									    $pdf->Cell(95,7," STUDENT",1,0,'L',true);
									    $pdf->Cell(30,7,"HOURS",1,0,'C',true);
									    $pdf->Cell(30,7,"STATUS",1,0,'C',true);
									    //$pdf->Ln();
									    $pdf->SetFillColor(224,235,255);
									    $pdf->SetTextColor(0);
									    $pdf->SetFont('');
									    $fill = false;

										//inicia tabla
										$pdf->SetFont('courier','',10);

							}else{}
						//imprime tabla
						$y = $y + 7;
						$pdf->SetXY($x,$y);
		
//        $pdf->SetFont('Times',((int)$game['score1']>(int)$game['score2'])?'BI':'');
        $pdf->Cell(30,7,$date,'LR',0,'C',$fill);
        $pdf->Cell(95,7,$student,'LR',0,'L',$fill);
//        $pdf->SetFont('Times',((int)$game['score1']<(int)$game['score2'])?'BI':'');
        $pdf->Cell(30,7,$min,'LR',0,'C',$fill);
        $pdf->Cell(30,7,$stat,'LR',0,'C',$fill);

        $pdf->Ln();
        $fill =! $fill;

			   }else{}
			}while($row = mysql_fetch_array($result));
	//close db
	mysql_close($conexion);

	//ultima linea
	$pdf->Cell(185,0,'','T');

//LINEA DE TOTALES
	//leemos la base de datos!
		//
		//conexion
			$conexion = mysql_connect("localhost","quantid0_marco","~marco");
			if(!$conexion){
			die ("No he podido conectar por la siguiente razon: ".mysql_error());
			}	
			mysql_select_db("quantid0_fluent",$conexion); 
		//muestra el detalle del mes
			$result09 = mysql_query("SELECT * FROM teacher_account", $conexion);
			$row09 = mysql_fetch_array($result09);		

			do{
			   if($row09['idteacher'] == $teacherid AND $month == $row09['month'] AND $year == $row09['year']){	

				$totalmin = $row09['min'];
				$totalhrs = $totalmin/60;
				$total = $row09['total_event'];
				$done = $row09['done'];
				$schedule = $row09['schedule'];
				$cot = $row09['cot'];
				$ccl = $row09['ccl'];

			   }else{}
			}while($row09 = mysql_fetch_array($result09));
	
		//cerrar		   
				mysql_close($conexion);
	//imprimimos
	$pdf->ln();
		//hrs
		$pdf->SetFont('courier','',10);
		$pdf->Cell(25,$h,'Total Hrs.: ', 0,0,'L');
		$pdf->SetFont('courier','',14);
		$pdf->Cell(18,$h,"$totalhrs", 0,0,'L');
		//total events
		$pdf->SetFont('courier','',10);
		$pdf->Cell(16,$h,'EVENTs: ', 0,0,'L');
		$pdf->SetFont('courier','',14);
		$pdf->Cell(10,$h,"$total", 0,0,'L');
		//done
		$pdf->SetFont('courier','',10);
		$pdf->Cell(12,$h,'DONE: ', 0,0,'L');
		$pdf->SetFont('courier','',14);
		$pdf->Cell(18,$h,"$done", 0,0,'L');
		//schedule
		$pdf->SetFont('courier','',10);
		$pdf->Cell(20,$h,'SCHEDULE: ', 0,0,'L');
		$pdf->SetFont('courier','',14);
		$pdf->Cell(18,$h,"$schedule", 0,0,'L');
		//cot
		$pdf->SetFont('courier','',10);
		$pdf->Cell(10,$h,'COT: ', 0,0,'L');
		$pdf->SetFont('courier','',14);
		$pdf->Cell(18,$h,"$cot", 0,0,'L');
		//ccl
		$pdf->SetFont('courier','',10);
		$pdf->Cell(10,$h,'CCL: ', 0,0,'L');
		$pdf->SetFont('courier','',14);
		$pdf->Cell(10,$h,"$ccl", 0,0,'L');

	$pdf->Output();

?>
