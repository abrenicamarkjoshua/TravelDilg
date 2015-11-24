<?php
require_once('fpdf/fpdf.php');
$fpdf =  new Fpdf('P','mm', array(215.9, 330.2));
  $fpdf->AddPage();

    $fpdf->Image('logo.png',92,8,-350);
    // Arial bold 15
    $fpdf->SetFont('Times','',10);
    // Title
    $republic = 'Republic of the Philippines';
    $fpdf->text(83,35,$republic);
    $department = 'DEPARTMENT OF THE INTERIOR AND LOCAL GOVERNMENT';
    $fpdf->SetFont('Times','B',12);
    $fpdf->text(40,40,$department);
    $fpdf->SetFont('Times','',10);
    $dilgnapolcom = "DILG-NAPOLCOM Center, EDSA cor. Quezon Avenue, Quezon City";
    $fpdf->text(53,45,$dilgnapolcom);
    $website = "www.dilg.gov.ph";
    $fpdf->text(89,50,$website);
    //office
    $fpdf->SetFont('Times','B',12);
    $office = (strtolower($applicationForm->position) == "governor") ? "OFFICE OF THE SECRETARY":"OFFICE OF THE UNDERSECRETARY FOR LOCAL GOVERNMENT";
    $left = (strtolower($applicationForm->position) == "governor") ? 71:38;
    $fpdf->text($left,60,$office);

    //barcode
    $fpdf->SetFont('Times','B',12);
    $barcodedateofapproval = date("mdY",strtotime($applicationForm->dateapproved));

    $barcodeHeading = App\viewStrategy::getRegionCode($applicationForm->region) . "_" . $barcodedateofapproval . "_" .$applicationForm->id;
    $fpdf->text(120,70,$barcodeHeading);

    //date of approval
    $fpdf->SetFont('Times','',12);
    $dateofapproval = date("F d, Y",strtotime($applicationForm->dateapproved));
    $fpdf->text(120,80,$dateofapproval);
    
	//heading
		//name
	    $fpdf->SetFont('Times','B',12);
	    $middleInitial = (count($applicationForm->middlename) > 0) ? substr($applicationForm->middlename, 0,1) . ".": "";
	    $name = $applicationForm->firstname . " " . $middleInitial . " " .$applicationForm->lastname . " " . $applicationForm->suffix;
	    $hon = "HON. ";
	    $fpdf->text(20,85,$hon . strtoupper($name));
	    //position
	    $fpdf->SetFont('Times','B',12);
	    $position = $applicationForm->position;
	    $fpdf->text(20,90,$position);
	    //municipal
	    $fpdf->SetFont('Times','',12);
	    $municipality = strtolower($applicationForm->municipality);
	    $municipality = ucfirst($municipality);
	    $fpdf->text(20,95,$municipality);
	    //province
	    $fpdf->SetFont('Times','',12);
	    $province = strtolower($applicationForm->province);
	    $province = ucfirst($province);
	    $fpdf->text(20,100,$province);
	//greeting
    $fpdf->SetFont('Times','',12);
    $fpdf->text(20,110,"Dear ");


    $position = ucfirst(strtolower($applicationForm->position));
    $lastname = $applicationForm->lastname;
    $name = "$position $lastname:";
    $fpdf->SetFont('Times','B',12);
    $fpdf->text(30,110,$name);
	
	//body
	$fpdf->SetXY(20,120);
	$fpdf->SetFont('Times','',12);
	$datefrom = date("F d, Y",strtotime($applicationForm->flightinfo_datefrom));
	$dateto = date("F d, Y",strtotime($applicationForm->flightinfo_dateto));
	$purpose = $applicationForm->flightinfo_purpose;
    $content = "        This refers to your proposed travel to $applicationForm->flightinfo_country, from $datefrom to $dateto, to $purpose";
   	$content .= "\n\n";
    $content .= "        Relative to the above, please be informed that the request is hereby approved, ";
    //check if has no entitlements if it has, include it (ie. (a) payment of international airfare (economy), meal expenses for dinner only, and 20% travel allowance representing incidental expenses )
    $content .= $applicationForm->entitlements;
 	$content .= "\n\n";
    $content .= "       It is further understood that this approval shall likewise be subject to the pertinent provisions of all other applicable laws, rules and regulations.";
    $fpdf->MultiCell(170,5,$content,0);
	
    //closing
    $fpdf->SetFont('Times','',12);
    $fpdf->text(128,210,"Very truly yours,");

  //bottom
    // $fpdf->SetFont('Times','',07);
    // $fpdf->text(21,250,"copy furnished:");
    // $fpdf->SetXY(20,252);
    // $fpdf->MultiCell(300,3,($applicationForm->copyFurnished) . "\n" . date("mdY",strtotime($applicationForm->created_at)));
    
//signature
    if(strtolower($applicationForm->applicationstatus) == "approved"){
        if(strtolower($applicationForm->position) == "governor"){

            $fpdf->SetFont('Times','',11);
            $fpdf->Image('mar_roxas.png',120,210,50);       
            $fpdf->text(137 ,232,"Secretary");
        }else{

            $fpdf->SetFont('Times','',11);
            $fpdf->text(128,220,"By Authority of the secretary:");
            $fpdf->Image('austere_a_apanadero.png',125,220,50);       
            $fpdf->text(137 ,242,"Undersecretary");
        }

    }
    
    $fpdf->Output();

        exit;






?>

