

<style>
    #invoice-POS {
      box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
      margin: 0 auto;
      height: 230px;
      width: 400px;
      background: #FFF;
     
      /*padding: 2mm;*/
      overflow: hidden;
      background-repeat: no-repeat;
      background-size: 98% 98%;
    }
  
    ::selection {
      background: #f31544;
      color: #FFF;
    }
  
    ::moz-selection {
      background: #f31544;
      color: #FFF;
    }
  
    h1 {
      font-sizex: 1.5em;
    }
  
    h2 {
      font-sizex: .9em;
    }
  
    h3 {
      font-sizex: 1.2em;
      font-weight: 300;
      line-height: 2em;
    }
  
    p {
      font-sizex: .7em;
      line-height: 1.2em;
    }
  
    #top,
    #mid,
    #bot {
      /* Targets all id with 'col-' */
      border-bottom: 1px solid #EEE;
	  padding-left: 15px;
	  padding-right: 20px
    }
  
    #top {
      min-height: 100px;
      
    }
  
    #mid {
      min-height: 80px;
      
}
    }
  
    #bot {
      min-height: 50px;
    }
  
  
    .info {
      display: block;
      margin-left: 0;
    }
  
    .title {
      float: right;
    }
  
    .title p {
      text-align: right;
    }
  
   
    .service {
      border-bottom: 1px solid #EEE;
    }
  
    .item {
      width: 24mm;
    }
  
    .itemtext {
      font-sizex: .5em;
    }
  
    #legalcopy {
      margin-top: 5mm;
      text-align: center;
    }
  </style>
  
  <div id="invoice-POS">
  
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
@import url("https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bree+Serif&family=EB+Garamond:ital,wght@0,500;1,800&display=swap");


#container {
  box-shadow: 0 15px 30px 1px grey;
  background: rgba(255, 255, 255, 0.9);
  text-align: center;
  border-radius: 5px;
  overflow: hidden;
  /*margin: 5em auto;*/
  height: 230px;
  width: 400px;
}
.bd{text-align: left;font-size: 14px;font-family: "Bookman Demi";background: #069b06; color: #FFF;padding:1px;}
.br{text-align: left;font-size: 11px;font-family: "Bookman Demi";}
table{font-size: 11px;font-family: "Courier Bold";}
th,th{ text-align: left;}
.product-details {
  position: relative;
  overflow: hidden;
  padding: 10px;
  height: 100%;
  float: left;
  width: 70%;
}

#container .product-details h1 {
  font-family: "Bebas Neue", cursive;
  display: inline-block;
  position: relative;
  font-size: 25px;
  text-align: center;
  color: #344055;
  margin: 0;
}

#container .product-details h1:before {
  position: absolute;
  content: "";
  right: 0%;
  top: 0%;
  transform: translate(25px, -15px);
  font-family: "Bree Serif", serif;
  display: inline-block;
  background: #ffe6e6;
  border-radius: 5px;
  font-size: 10px;
  padding: 5px;
  color: white;
  margin: 0;
  animation: chan-sh 6s ease infinite;
}

.hint-star {
  display: inline-block;
  margin-left: 0.5em;
  color: gold;
  width: 50%;
}

#container .product-details > p {
  font-family: "EB Garamond", serif;
  text-align: center;
  font-size: 18px;
  color: #7d7d7d;
}
.control {
  position: absolute;
  top: 15%;
  left: 53.1%;
}
.btn {
  transform: translateY(0px);
  transition: 0.3s linear;
  background: #809fff;
  border-radius: 5px;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  outline: none;
  border: none;
  color: #eee;
  padding: 0;
  margin: 0;
}

.btn:hover {
  transform: translateY(-6px);
  background: #1a66ff;
}

.btn span {
  font-family: "Farsan", cursive;
  transition: transform 0.3s;
  display: inline-block;
  padding: 10px 20px;
  font-size: 1.2em;
  margin: 0;
}
.btn .price,
.shopping-cart {
  background: #333;
  border: 0;
  margin: 0;
}

.btn .price {
  transform: translateX(-10%);
  padding-right: 15px;
}

.btn .shopping-cart {
  transform: translateX(-100%);
  position: absolute;
  background: #333;
  z-index: 1;
  left: 0;
  top: 0;
}

.btn .buy {
  z-index: 3;
  font-weight: bolder;
}

.btn:hover .price {
  transform: translateX(-110%);
}

.btn:hover .shopping-cart {
  transform: translateX(0%);
}

.product-image {
  transition: all 0.3s ease-out;
  display: inline-block;
  position: relative;
  overflow: hidden;
  height: 30%;
  float: right;
  width: 20%;
  margin-top: 10px;
  margin-left: 5px;
  display: inline-block;
  padding: 7px;
 
}

#container img {
  width: 100%;
  height: 30%;
  clear: both; 
}

.info {
  background: rgba(27, 26, 26, 0.9);
  font-family: "Bree Serif", serif;
  transition: all 0.3s ease-out;
  transform: translateX(-100%);
  position: absolute;
  line-height: 1.8;
  text-align: left;
  font-size: 105%;
  cursor: no-drop;
  color: #fff;
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
}

.info h2 {
  text-align: center;
}
/* .product-image:hover .info {
  transform: translateX(0);
}

.info ul li {
  transition: 0.3s ease;
}
.info ul li:hover {
  transform: translateX(50px) scale(1.3);
}

.product-image:hover img {
  transition: all 0.3s ease-out;
}
.product-image:hover img {
  transform: scale(1.2, 1.2);
} */



</style>
<div id="container">	
	
	<div class="product-details">
		
	<h1>XRF CARD</h1>
    <div class="bD">XRFGOLD TESTING CERTIFICATE</div>
            <table >
                <tr>
                  <th>Customer Name</th>
                  <th colspan="3">: <?= strtoupper($testing[0]['order_person']) ?></th>
                 
                </tr>
                <tr>
                  <th>Certificate No</th>
                  <th>: <?=$testing[0]['testing_order_serial'] ?></th>
                  <th colspan="2" rowspan="5">
                      <?php if($testing[0]['image_name']== '1' ){?>
        
            
               <?= ($testing[0]['image_name'] == '1' && !empty($testing[0]['image']))? 
               '<img alt="logo" style="height: 75px;width: 110px;" src="https://phrpl.msbsmart.in/phrpls/uploads/weight/'.$testing[0]["image"].'"':''?>
          
           <?php }?>
                  </th>
                </tr>
                <tr>
                  <th>Date</th>
                  <th>: <?php $date =$testing[0]['added_on'];?><?=date('d/m/Y', strtotime($date)); ?> </th>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <th>: <?=strtoupper($testing[0]['sample'] )?></th>
                  </tr>
                  <tr>
                    <th>Product Weight</th>
                    <th>: <?= $testing[0]['weight'] ?> grm</th>
                  </tr>
                  <tr>
                    <th>Product Karat</th>
                    <th>: <?= $testing[0]['karat'] ?> %</th>
                    
                  </tr>
                 
                  <tr>
                    
                    <th>Gold</th>
                    <th>: <?= $testing[0]['gold'] ?> %</th>
                    <th>Copper</th>
                    <th>: <?= $testing[0]['copper'] ?> %</th>
                  </tr>
                  <tr>
                    <th>Silver</th>
                    <th>: <?= $testing[0]['silver'] ?> %</th>
                    <th>Others</th>
                    <?php  $others=($testing[0]['zinc']+$testing[0]['cadmium']+$testing[0]['indium']+$testing[0]['iridium']+$testing[0]['ruthenium']+$testing[0]['osmium']+$testing[0]['tin']+$testing[0]['rhenium']+$testing[0]['nickel']+$testing[0]['lead']+$testing[0]['platinum']+$testing[0]['bismuth']+$testing[0]['rhodium']+$testing[0]['iron']+$testing[0]['cobalt']+$testing[0]['tungsten']+$testing[0]['others']); ?>
                    <th>: <?=$others ?> %</th>
                  </tr>
              </table>
              <hr style="background-color: #0c09c0;height:2px;"/>
              <div class="br">Note : Max. deviation +/- 0.50% as per machine specification</div>
	
		
</div>
		
<div class="control">
    
    <!--<img src="https://phrpl.msbsmart.in/phrpls/uploads/logo.png" style="height: 110px;width: 150px;"alt="">-->
	
</div>
<div class="product-image">
    
     
 <?php echo '<img src="https://phrpl.msbsmart.in/phrpls/qrcode/'.$testing[0]["testing_order_serial"].'.png" style="height: 80px;"alt="">'?>
	


</div>

</div>

 
  </div>
  <!--End Invoice-->
  
  
  
  
  
  