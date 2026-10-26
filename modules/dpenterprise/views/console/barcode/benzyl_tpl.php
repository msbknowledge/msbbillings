<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.css">
    </head>
    <style>
	.container { width: @container-desktop !important; }

        .container-fluid {
            width: 15cm;
            height: 10cm;
            border-style: solid;
        }

        .barcode {
            height: 13mm;
            width: 13mm
        }
		.col-sm-4x {
		width: 28%;
		float: left;
		margin: 0% 14px;
		}
    </style>

    <body>

        <div class="container-fluid">


            <div class="row">
                <div class="col-sm-4x" style="background-color:WHITE;color:black;font-size:11px;margin-top: 19px;">
                    <b>COMPOSITION</b> :-<br>Benzyl Benzoate I.P. 25% W/W in a suitable
                    oil-in-water emulsion base
                </div><br>
                <div class="col-sm-4x"
                     style="background-color:WHITE;font-size:15px;border-top:1px solid; border-bottom:1px solid">
					 <span style="font-size: 12px;">
					 <b>BENZYL
                        BENZOATE APPLICATION IP 25% W/W</b>
						</span>
                </div>
                <div class="col-sm-4x" style="background-color:WHITE;font-size:13px"><b>S.S.I.UNIT</b>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4x " style="background-color:WHITE;font-size:10px;margin-bottom:7px">
                    <p class="panel panel-default panel-body " style="color:black;margin-bottom:9px;padding:4px">FOR EXTERNAL USE ONLY</p>
                </div>
                <div class="col-sm-4x" style="background-color:WHITE;font-size:15px"><b></b></div>
                <div class="col-sm-4x" style="background-color:WHITE;font-size:11px"><b>Vender Code: <?=$data['vendor_code']?></b></div>
            </div>

            <div class="row">
                <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;margin-bottom:7px">
                    <p class=" panel panel-default panel-body" style="color:black;margin-bottom:20px;padding:4px;margin-top:-10px">For the treatement of scabies
                    </p>
                </div>
                <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;padding:21px">   </div>
                <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;margin-top:-3px"><b>Mfg.Lic.No.:DL 1445M</b><br><b>Batch No: <?=$data['barcode_batch']?> </b><br><b>Mfg data: <?=$data['barcode_mfg']?> </b><br></div>
            </div>

            <div class="row">
                <div class="col-sm-4x " style="background-color:WHITE;font-size:11px;margin-top:-19px;">
                    <p class="panel panel-default panel-body" style="color:black;padding:5px">SHAKE WELL BEFORE USE</p>
                </div>
                <div class="col-sm-4x " style="background-color:WHITE;font-size:11px">
                    <p class=" panel panel-default panel-body" style="color:black;margin-top:-11px;margin-bottom:-10px;padding:4px"><b>Net Contents 500ml<br>
					<br>Total Weight: 14.1 kg <br>Total Quantity: 25 pieces</b>
                </div>
                <div class="col-sm-4x" style="background-color:WHITE;color:black;font-size:11px;margin-top:7px"><b>Exp.Date: 2 years from the
                        date of Mfg</b></div>
            </div>

            <div class="row">
                <div class="col-sm-4x " style="background-color:WHITE;font-size:11px;COLOR:black;margin-top:-10px">As directed by the
                    phisician.
                </div>
                <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:15px"></div>
                <div class="col-sm-4x" style="background-color:white;font-size:11px;color:black;margin-top:9px"><b>CAUTION</b>:Avoid contact of
                    the medicament with the eyes.</div>
            </div>
            <div class="row">
                <div class="col-sm-4x " style="background-color:WHITE;font-size:11px">
                    <p class=" panel panel-default panel-body" style="color:black;margin-top:-20px;padding:4px">CMS CAT NO: <?=$data['cms_cat']?></div>
                        <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:15px">Manufactured by<br>M/S. D.P.ENTERPRISE</div>
                        <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:15px">Store well closed after used</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:1px;font-size:8px;font-weight:bold">W.B GOVT. SUPPLY NOT FOR SALE</div>
                            <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:15px">29,R.K.Das Road,Haltu,Ramlal Bazar,Kolkata-700078</div>
                            <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:15px"><div class="col-sm-4x" style="text-align:center;width: 16mm;margin-left: 34px;">
                            <img src="/barcode/barcode.php?s=dmtxs&wq=1&d=<?=$data['datamatrix']?>" class="barcode" style="height: 16mm;width: 16mm;">                                    
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:-34px;font-size:10px;margin-left: 24px;">হাসপাতাল হইতে বিনামূল্যে সরবরাহের জন্যে</div>
                            <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:15px"></div>
                            <div class="col-sm-4x" style="background-color:WHITE;font-size:11px;color:black;margin-top:15px"></div>   
                        </div>   


         
			


              
               
                    
                </div>


        


    </body>

</html>