<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </head>
    <style>
        .container-fluid {
            width: 15cm;
            height: 12cm;
            border-style: solid;
        }
        .col-sm-4x {
            width: 50%;
            float: left;
            /* margin: 0% 14px; */
        }
    </style>

    <body>

        <div class="container-fluid">


            <div class="row" style="padding:5px">
                <h6><center>For C.M.S. Supply.... "C.MS. supply. Not for Sale" <br>
                For supplies to decentralized units 9N.B. Govt. supply. Not for sale"<br><br>
                (Glutaraldehyde Solution 2% For Instrument Sterilization)<br><br>
                DIRECTION FOR ACTIVATING
                
                <h6 style="text-align: left;">Add the contents of attached vial (Activator) to the container of GERMISOL solution and shake well. The colour of solution will change to emerald green which is now activated and ready to use up to 14 days from the date of activation. Do not use activated solution after 14 days.</h6>
                DIRECTION FOR USE
                <p style="text-align: left;">DISINFECTION : Immerse completely for a minimum of 10 minutes at 20°C to destroy vegetative organisms</p>
                <p style="text-align: left;">STERILIZATION : Immerse equipment completely for a minimum of 10 hours. Remove Equipments from activated GERMISOL solution with sterile technique and rinse throughly with sterile water. KILLS HIV-I on the cleaned environmental surfaces/objects previously solied with blood/body fluids</p>
                PRECAUTION
                <p style="text-align: left;">EYE : Contact with eyes causes damages. Prevent contact with eyes by using proper protection when handling or pouring. In case of contact, flush with water immediately and get medical attention.</p>
                <p style="text-align: left;">SKIN : Avoid skin contact as far as possible. For skin contact, flush throughly with water.</p>
                VENDOR CODE : <?=$data['vendor_code']?><br>
                CMS-Cat No : G06/KCR<br>
                <div class="col-sm-4x">
                <p style="text-align: left;">Mfg. Lic. No. DL-1445M<br><br>Batch No : <?=$data['barcode_batch']?><br>Mfg. Date : <?=$data['barcode_mfg']?><br><br>Exp. Date : 2 year from the Mfg. Date</p>
                </div>
                <div class="col-sm-4x">
                <img src="/barcode/barcode.php?s=dmtxs&wq=1&d=<?=$data['datamatrix']?>" class="barcode" style="height: 16mm;width: 16mm;">
                </div>
                </center></h6>
                </div>
            </div>

        </div>

    </body>

</html>