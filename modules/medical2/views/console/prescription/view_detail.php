<!DOCTYPE html>
<html>

<head>
    <title>Prescription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style type="text/css">
  img {
    background-image:url('default-image.jpg');
  width:100%;
  /* height:300px; */
}
        #results { 
          padding:5px; 
          border:1px solid; 
          background:#ccc; 
          width :100%;
        }
        .container-fluid {
            width: 100%;
            padding-right: 100px;
            padding-left: 100px;
            margin-right: auto;
            margin-left: auto;
            border-color: skyblue;
                        }
    </style>
<body>
<h1 style="text-align: center;">Upload Prescription</h1>
<div class="container">
         

  <form method="POST" action="<?=base_url('uppresc/do_upload');?>">
  <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                      <label class="form-label" for="form3Example4">Name</label>
                      <input type="input" id="form3Example4" class="form-control" name="name"/>
                    </div>
                      <div class="form-group">
                            <label class="form-label" for="form3Example4">Phone Number</label>
                            <input type="input" id="form3Example4" class="form-control" name="phone" />
                      </div>
                      <div class="form-group">
                          <label class="form-label" for="form3Example4">Address</label>
                          <input type="input" id="form3Example4" class="form-control" name="address" />
                      </div>
                    <div class="form-group">
                          <label for="exampleFormControlTextarea1">Note</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note"></textarea>
                    </div>
                    <div id="my_camera"></div>
                    <div class="form-group">
                                
                                <input type="file" class="btn btn-info" name="image" id="Capture" accept="image/*" capture />
                                <input type="hidden"  name="image" id="imagetag">
                      </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="text-center">
                    <div id="results" class="img-fluid img-thumbnail">
                      <p>
                        <img src="https://simplebillings.com/upload/default-image.jpg" id="img" alt="from phone"/>
                      </p>
                    </div>
                </div>
            </div>
          </div>
            <div class="row">
                    <div class="col">
                      <div class=" text-center">
                        <br/>
                          <input type="submit" name="submit" class="btn btn-success" style="display: inline; width: 130px; background-color: rgb(4, 170, 109); color: white; border-radius: 25px;">
                      </div>
                    </div>
              </div>
              <div>
              <a href="https://simplebillings.com/"><img src="https://simplebillings.com/upload/simplebillingslogo.jpeg" alt="footer logo" style="max-width:200px;float: right;"></a>
                <div>
              <!-- <p>
                        <img src="simplebillingslogo.jpeg" id="img" alt="icon" />
                      </p>
              <link rel="icon" type="image/png"  href="simplebillingslogo.jpeg"> -->
</form>
    </div>
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
  
  document.addEventListener('DOMContentLoaded',(ev)=>{
        let form = document.getElementById('myform');
        let input = document.getElementById('Capture');

        input.addEventListener('change',(ev)=>{
            console.dir(input.files[0]);
            if(input.files[0].type.indexOf("image/") > -1)

            {

                let img = document.getElementById('img');
                console.log(input.files[0])
                img.src = window.URL.createObjectURL(input.files[0]);
                document.getElementById('imagetag').value =getBase64(input.files[0]);

            }else{

            }
        })

    })
   // $("#results").show();
  
   function getBase64(file) {
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
      document.getElementById('imagetag').value =reader.result
   };
   reader.onerror = function (error) {
     console.log('Error: ', error);
   };
  }
 
</script>
</body>
</html>