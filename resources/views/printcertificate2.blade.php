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
    $fpdf->SetFont('Times','',12);
    $office = (strtolower($applicationForm->position) == "governor") ? "OFFICE OF THE SECRETARY":"OFFICE OF THE UNDERSECRETARY FOR LOCAL GOVERNMENT";
    $left = (strtolower($applicationForm->position) == "governor") ? 71:38;
    $fpdf->text(83,80,"AUTHORIZATION");

    //barcode
    $fpdf->SetFont('Times','B',12);
    $barcodedateofapproval = date("mdY",strtotime($applicationForm->dateapproved));

    $barcodeHeading = App\viewStrategy::getRegionCode($applicationForm->region) . "_" . $barcodedateofapproval . "_" .$applicationForm->id;
    $fpdf->text(120,70,$barcodeHeading);

    //date of approval
    $fpdf->SetFont('Times','',12);
    $dateofapproval = date("F d, Y",strtotime($applicationForm->dateapproved));
    
    //heading
        //name
        $fpdf->SetFont('Times','B',12);
        $middleInitial = (count($applicationForm->middlename) > 0) ? substr($applicationForm->middlename, 0,1) . ".": "";
        $name = $applicationForm->firstname . " " . $middleInitial . " " .$applicationForm->lastname . " " . $applicationForm->suffix;
        $hon = "HON. ";
        
        //position
        $fpdf->SetFont('Times','B',12);
        $position = $applicationForm->position;
       
        //municipal
        $fpdf->SetFont('Times','',12);
        $municipality = strtolower($applicationForm->municipality);
        $municipality = ucfirst($municipality);
       
        //province
        $fpdf->SetFont('Times','',12);
        $province = strtolower($applicationForm->province);
        $province = ucfirst($province);
      
    //greeting
    $fpdf->SetFont('Times','',12);



    $position = ucfirst(strtolower($applicationForm->position));
    $lastname = $applicationForm->lastname;
    $firstname = $applicationForm->firstname;
    $middlinitial = ($applicationForm->middlename != "") ? substr($applicationForm->middlename . ".", 0, 1): "";
    $name = strtoupper("$position $firstname $middlinitial $lastname");
    $name2 = $position . " " . $applicationForm->lastname;
    if($middleInitial == ""){
        $name =  strtoupper("$position $firstname $lastname");
    }
    $fpdf->SetFont('Times','B',12);
  
    
    //body
    $fpdf->SetXY(20,90);
    $fpdf->SetFont('Times','',12);
    $datefrom = date("F d, Y",strtotime($applicationForm->flightinfo_datefrom));
    $dateto = date("F d, Y",strtotime($applicationForm->flightinfo_dateto));
    $purpose = $applicationForm->flightinfo_purpose;
    $province = strtoupper($applicationForm->province);
    $content = "        Pursuant to DILG Memorandum Circular No. 2006-163 dated November 30, 2006, $name, PROVINCE OF $province, (whose picture appears below), is hereby authorized to travel to the $applicationForm->flightinfo_country, from $applicationForm->flightinfo_datefrom to $applicationForm->flightinfo_dateto, to $applicationForm->flightinfo_purpose";
    $content .= "\n\n";
    $content .= "        $name2 is authorized to claim for entitlements, ";
    //check if has no entitlements if it has, include it (ie. (a) payment of international airfare (economy), meal expenses for dinner only, and 20% travel allowance representing incidental expenses )
    $content .= $applicationForm->entitlements;
    
    $content .= " Further, this authorization shall likewise be subject to the pertinent provisions of all other applicable laws, rules and regulations.";
    
    $fpdf->MultiCell(170,5,$content,0, 'B');

    //closing
    $fpdf->SetFont('Times','',12);

  //bottom
    // $fpdf->SetFont('Times','',07);
    // $fpdf->text(21,250,"copy furnished:");
    // $fpdf->SetXY(20,252);
    // $fpdf->MultiCell(300,3,($applicationForm->copyFurnished) . "\n" . date("mdY",strtotime($applicationForm->created_at)));
    $match = [
                'categories' => 'updated picture',
                'travelApplication_id' => $applicationForm->id
                ];
    $updatedTwoByTwoPicture = (App\attachedDocuments::where($match)->first()) ? App\attachedDocuments::where($match)->first()->location : "";
    if($updatedTwoByTwoPicture){
         $fpdf->Image($updatedTwoByTwoPicture,20,170,-350);
    }else{
         $fpdf->Image($applicationForm->picture,20,170,-350);
    }
   
//signature
    if(strtolower($applicationForm->applicationstatus) == "approved"){
        if(strtolower($applicationForm->position) == "governor"){

            $fpdf->SetFont('Times','',11);
            //$fpdf->Image('mar_roxas.png',120,170,50);       
            $fpdf->text(137 ,192,"Secretary");
            $fpdf->text(137 ,197,$barcodeHeading);
            if($applicationForm->InitialToUsec){
                $initial = App\config::where('configName', 'InitialToUsec')->get()->first()->contentOrLocation;
                $fpdf->Image($initial,165,185,10); 
       
            }            
        }else{

            $fpdf->SetFont('Times','',11);
            $fpdf->Image('austere_a_apanadero.png',125,170,50);       
            $fpdf->text(127 ,192,"Undersecretary for Local Government");
            $fpdf->text(127 ,197,$barcodeHeading);

            if($applicationForm->InitialToUsec){
                $initial = App\config::where('configName', 'InitialToUsec')->get()->first()->contentOrLocation;
                $fpdf->Image($initial,165,190,10); 
       
            }
        }

    }
    
    $fpdf->Output();

        exit;






?>

