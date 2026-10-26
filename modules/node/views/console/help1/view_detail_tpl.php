

<style>
    #invoice-POS {
      box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
      margin: 0 auto;
      width: 210mm;
      height: 177mm;
      background: #FFF;
      background-image: url('https://phrpl.msbsmart.in/phrpls/testing.jpg');
      padding: 2mm;
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
  
    table {
      width: 100%;
     
	  border: 2px solid #000;
	  border-radius:5px;
    }
  
    td ,th{
      padding: 5px 0 5px 15px;
      border-radius: 2%;
	   border-bottom: 1px solid #000;
    }
 tr{border-bottom: 1px solid #000;}
    .tabletitle {
      padding: 5px;
      font-sizex: .5em;
      background: #EEE;
	  border-radius: 2%;
	 
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
  
    <center id="top">
      <div class="info">
         </div>
      <!--End Info-->
    </center>
    <!--End InvoiceTop-->
   
    <div id="mid">
      <div class="info">
     
  
      </div>
    </div>
    <!--End Invoice Mid-->
  
    <div id="bot">
  
      <div id="table">
  
  
        <table style=" margin-top: 10px;">
     
           <tr class="tabletitle">
  
                         
            <th style="text-align: left;font-size: 19px">Date</th>
            <th colspan="3" style="text-align: left;font-size: 19px"><?php $date =$testing[0]['added_on'];?><?=date('d/m/Y', strtotime($date)); ?> ,<?=date('h:i:s A', strtotime($date)); ?></th>        
            <th style="text-align: left;font-size: 19px">Sr. No.</th>
            <th colspan="3" style="text-align: left;font-size: 19px"><?=$testing[0]['testing_order_serial'] ?></th>
            
          </tr> <tr>
            <th style="text-align: left;font-size: 19px">Name</th>
            <th colspan="3" style="text-align: left;font-size: 19px"><?= strtoupper($testing[0]['order_person']) ?></th>
            <th style="text-align: left;font-size: 19px">Sample</th>
          
             <?php if($testing[0]['image_name'] !== '1' || $testing[0]['image_name'] == '1' && empty($testing[0]['image'])){?>
            <th colspan="3" style="text-align: left;font-size: 19px"><?=strtoupper($testing[0]['sample'] )?></th>
           
             <?php }else{ ?>
             <th colspan="2" style="text-align: left;font-size: 19px"><?=strtoupper($testing[0]['sample'] )?></th>
             <th rowspan="2" style="text-align: left;font-size: 19px">
               <?= ($testing[0]['image_name'] == '1' && !empty($testing[0]['image']))? 
               '<img alt="logo" style="height:60px;background: white;border-radius: 4px;" src="https://phrpl.msbsmart.in/phrpls/uploads/weight/'.$testing[0]["image"].'"':''?>
             </th>
           <?php }?>
            </tr><tr>
            <th style="text-align: left;font-size: 19px">Element</th>   
            <th colspan="3" style="text-align: left;font-size: 19px"> <?=strtoupper($testing[0]['metal'] )?></th>     
            
            <th style="text-align: left;font-size: 19px">weight</th>
            <th colspan="3" style="text-align: left;font-size: 19px"><?= $testing[0]['weight'] ?></th>
		  </tr>
		   <tr>
            <th style="text-align: left;font-size: 22px;color:red;">Gold</th>   
            <th style="text-align: left;font-size: 19px"><?= $testing[0]['gold'] ?>%</th>
             <th style="text-align: left;font-size: 19px;color:red;">OTH</th>
            <th style="text-align: left;font-size: 19px"><?= $testing[0]['oth'] ?>%</th>
			<th style="text-align: left;font-size: 19px;color:red;">Actual Result:</th>
            <th style="text-align: left;font-size: 19px;"><?= $testing[0]['tkarat'] ?>%</th>
            
             <th style="text-align: left;font-size: 22px;color:red;">Carat</th>
            <th style="text-align: left;font-size: 19px"><?= $testing[0]['karat'] ?>%</th>
           
           
           </tr>
          <tr class="tabletitle">
  
               
				   <tr>
            <td style="text-align: left;font-size: 19px">Copper</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['copper'] ?></td>
            <td style="text-align: left;font-size: 19px">Iridium</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['iridium'] ?></td>
			 <td style="text-align: left;font-size: 19px">Ruthenium</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['ruthenium'] ?></td>
            <td style="text-align: left;font-size: 19px">Cobalt</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['cobalt'] ?></td>
          </tr> 
     <tr>
            <td style="text-align: left;font-size: 19px">Silver</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['silver'] ?></td>
            <td style="text-align: left;font-size: 19px">Nickel</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['nickel'] ?></td>
			 <td style="text-align: left;font-size: 19px">Rhenium</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['rhenium'] ?></td>
             <td style="text-align: left;font-size: 19px">Platinum</td>
            <td style="text-align: left;font-size: 19px"><?= $value[0]['platinum'] ?></td>
            
          </tr> 
		   <tr>
            <td style="text-align: left;font-size: 19px">Zinc</td>
            <td style="text-align: left;font-size: 19px"><?=$testing[0]['zinc'] ?></td>
            <td style="text-align: left;font-size: 19px">Tin</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['tin'] ?></td>
			 <td style="text-align: left;font-size: 19px">Indium</td>
            <td  style="text-align: left;font-size: 19px"><?= $testing[0]['indium'] ?></td>
             <td style="text-align: left;font-size: 19px">Lead</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['lead'] ?></td>
            
          </tr> 
		   <tr>
            <td style="text-align: left;font-size: 19px">Cadmium</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['cadmium'] ?></td>
            <td style="text-align: left;font-size: 19px">Osmium</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['osmium'] ?></td>
             <td style="text-align: left;font-size: 19px">Iron</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['iron'] ?></td>
            <td style="text-align: left;font-size: 19px">Tungsten</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['tungsten'] ?></td>
          </tr> 
             <tr>
            <td style="text-align: left;font-size: 19px">Palladium</td>
             <td style="text-align: left;font-size: 19px"><?= $testing[0]['platinum'] ?></td>
			  <td style="text-align: left;font-size: 19px">Bismuth</td>
            <td style="text-align: left;font-size: 19px"><?=$testing[0]['bismuth'] ?></td>
             <td style="text-align: left;font-size: 19px">Rhodium</td>
            <td style="text-align: left;font-size: 19px"><?= $testing[0]['rhodium'] ?></td>
            <td style="text-align: left;font-size: 19px">Other</td>
            <td style="text-align: left;font-size: 19px"><?=$testing[0]['others'] ?></td>
             
          </tr> 
    
        </table>
      </div>
           
          
      <!--End Table-->
  
  
    </div>
    <!--End InvoiceBot-->
  </div>
  <!--End Invoice-->
  
  
  
  
  
  