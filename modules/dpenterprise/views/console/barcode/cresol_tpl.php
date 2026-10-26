<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.css">
</head>
<style>
    .container {
        width: container-desktop  !important;
    }

    .container-fluid {
        width: 15cm;
        height: 9cm;
        border-style: solid;
    }

    .barcode {
        height: 10mm;
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
            <div class="col-sm-4x" style="background-color:WHITE;color:black;font-size:10px;margin-top: 19px;">W.B Govt. supply<br>Not for sale
            </div>
            <div class="col-sm-4x" style="background-color:WHITE;margin-top: 40px"><span style="font-size: 10px;"><h6>Net Contents : 5 Ltrs.</h6></span>
                <h6>হাসপাতাল হইতে বিনামূল্যে সরবরাহের জন্যে</h6>
                <h6>Cerosol With Soap Solution 50% I.P.</h6>
            </div>
            <div class="col-sm-4x" style="background-color:WHITE;font-size:10px;margin-top: 15px;">Vendor Code: <?=$data['vendor_code']?><br> C.M.S./H. CAT No:C48/KCR<h6 style="margin-top: 28px;
            ">S.S.I. UNIT</h6>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-4x " style="background-color:WHITE;font-size:10px;margin-bottom:7px"><p class="mypclass " style="color:black;margin-bottom:9px;padding:4px"></p>MISCIBLE ALL PROPORTION WITH WATER STRENGTH FOR SURGICAL PURPOSE : 1IN 100 PART OF WATER</p>
            </div>
            <div class="col-sm-4x" style="background-color:WHITE;font-size:10px"></div>
            <div class="col-sm-4x" style="background-color:WHITE;font-size:10px;margin-left:200px;margin-top:0px">Mfg. DL.No : 1445-M<br>FIRM No.<br>Batch No: <?=$data['barcode_batch']?> <br>Mfg date: <?=$data['barcode_mfg']?> </div>
        </div>

        

        <div class="row" style="margin-top: -60px">
            <div class="col-sm-4x " style="background-color:WHITE;font-size:10px;margin-top:-19px;"><p class="myp2class" style="color:black;padding:5px"></p>
            </div>
            <div class="col-sm-4x " style="background-color:WHITE;font-size:10px;margin-top: -52px;margin-top: -12px;
            
            margin-left: -165px;"><p class="myp3class " style="color:black;margin-top:-11px;margin-bottom:-10px;padding:4px">
            <h6>FOR EXTERNAL USE ONLY<br>
                    Disinfectant Fluid</h6>
                    <h6>Manufactured in India by<br>M/S. D.P.ENTERPRISE</h6>
                    <h6>29,R.K.Das Road,Haltu,Ramlal Bazar,Kolkata-700078</h6>
            </div>
            <div class="col-sm-4x" style="background-color:WHITE;color:black;font-size:10px;margin-top: 8px;
            margin-left: 13px;">Exp.Date:24 months from the Mfg. date
            </div>
        </div>

        
        <div class="row">
            <div class="col-sm-4x">
            </div>
            <div class="col-sm-4x"></div>
            <div class="col-sm-4x" style="font-size:10px;color:black;margin-top:32px">
                <div class="col-sm-4x" style="text-align:center;width: 16mm;margin-left: 34px;">
                <img src="/barcode/barcode.php?s=dmtxs&wq=1&d=<?=$data['datamatrix']?>" class="barcode" style="height: 16mm;width: 16mm;margin-top: -160px;margin-left: -51px;">
                </div>
            </div>
        </div>
</body>

</html>