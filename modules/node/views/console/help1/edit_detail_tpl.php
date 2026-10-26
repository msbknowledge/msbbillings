<style type="text/css">
    .ds tr,
    td,
    th {
        border-style: none;
        min-width: 90px;
    }

    .ds {
        width: 90%;
    }

/* For demonstration only */
#gridexample {
  font-size: 1.1em;
}
#gridexample th {
  padding: .15em .5em;
}
#gridexample td {
  padding: .1em;
  width: 5em;
}
#gridexample input[type="text"] {
  width: 100%;
  line-height: 2;
  box-sizing: border-box;
}
</style>
<div class="row-fluid">

 <script>
            var $data = JSON.parse('<?= json_encode($data) ?>');

        </script>
       
    <div class="row span12">

        <form method="post" onsubmit="return false;" action="" name="myform" class="choose_entry_form" " lass="dynamic-autocomplete-frm" id="dfrm">



            <div class=" box span12" style="padding:10px">
                <table class="ds">
                    <tbody class="appendHere">

                        <tr>
                            <td>
                                <div class="input-prepend"> <span class="add-on">Sr No.</div>
                            </td>
                            <td colspan="2" style="width:60px;">
                                <!-- <input id="sr_no" type="text" name="sr_no" value=" "> -->
                                <input autocomplete="off" id="search_word"  required="required" name="order_id" value ='<?= $data['testing_order_serial']; ?>'type="text" class="form-control input-lg" placeholder="order id">
                                <input id="srn" name="srn"  class="form-control input-lg" type="hidden">

                                <div id="suggestions">


                                </div>
                            </td>
                            <td> 
                             <div class="input-prepend"><span class="add-on" style="margin-bottom: 0px">OTP</span></div> </td>
                             <td> <input  style="width: 90px;" id="otp" type="text" name="otp" value="" placeholder="OTP"> </td>
                           <td>   <div class="input-prepend">  <span class="add-on" style="margin-bottom: 0px">Edit Causes </span></div> </td> 
                           <td> <input id="causes" type="text" name="causes" value="" placeholder="causes"> </td>
                            <td colspan="2" rowspan="3">
                                <div class="input-prepend" id="">  <div class="span6" class="thumbnail">
                            <!-- <img class="grayscale" style="height:150px;width:150px;border:1px solid #ede2e2;" src="<?=base_url()?>/img/loading.gif" alt="Sample Image 1"> -->
                        </div></div>
                            </td>
                        </tr>



                        <tr>
                            <td>Metal</td>
                            <td>:- <?= $data['metal']; ?></td>
                            <td>
                                <div class="input-prepend" id="metal"></div><input type="hidden" value="<?= $data['metal']; ?>" name="metal" id="metal">
                            </td>
                            <td>Rec. Date</td>
                            <td>:-<?= $data['added_on']; ?></td>
                            <td>
                                <div class="input-prepend" id="date"> </div><input type="hidden" value="<?= $data['added_on']; ?>" name="date" id="date">
                            </td>

                            <td>
                                <div class="input-prepend" id=""> </div>
                            </td>


                        </tr>

                        <tr>
                            <td>Weight</td>
                            <td>:-<?= $data['weight']; ?></td>
                            <td>
                                <div class="input-prepend" id="weight"> </div><input type="hidden" value="<?= $data['weight']; ?>" name="weight" id="weight">
                            </td>
                            <td>sample name</td>
                            <td>:-<?= $data['sample']; ?></td>
                            <td>
                                <div class="input-prepend" id="sample"> </div><input type="hidden" value="<?= $data['sample']; ?>" name="sample" id="sample">
                            </td>
                            <td>
                                <div class="input-prepend" id=""> </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Testing</td>
                            <td>:-<?= $data['testing']; ?></td>
                            <td>
                                <div class="input-prepend" id="testing"> </div><input type="hidden" value="<?= $data['testing']; ?>" name="testing" id="testing">
                            </td>
                            <td>Seal</td>
                            <td>:-<?= $data['seal']; ?></td>
                            <td>
                                <div class="input-prepend" id="seal"> </div><input type="hidden" value="<?= $data['seal']; ?>" name="seal" id="seal">
                            </td>
                            <td>
                                <div class="input-prepend" id=""> </div>
                            </td>
                            <td>
                                <!-- <div class="span2"><button type="submit" class="btn btn-secondary" style="width:600%;"> Load</button></div> -->
                            </td>
                            <td>
                                <!-- <div class="span2"><button type="submit" class="btn btn-secondary" style="width:600%;">Remove</button></div> -->
                            </td>
                        </tr>
                    </tbody>
                </table>


                <hr style="width:100%;height:2px;border: 1px solid #cdd1d0;background: #ddd8d8cc;" />

                <table class="ds">
                    <thead>
    
                        <tr>
                            <td>GOLD</td>
                            <td style="width:100px;"><input required="required" type="number" value="<?= $data['gold']; ?>" id="goldr" name="goldr" style="width:130px;" readonly></td>
                            <td>KARAT</td>
                            <td style="width:100px;"><input required="required" type="number" value="<?= $data['karat']; ?>" id="karatr" name="karatr" style="width:130px;" readonly></td>
                           
                             <td>OTH</td>
                            <td><input required="required" type="number" value="<?= $data['oth']; ?>" name="othp" id="othp" style="width:100px;" readonly step="any"></td>

                           <td>ACTUAL:</td>
                            <td><input required="required" type="number" value="<?= $data['tkarat']; ?>" name="tkarat" id="tkarat" style="width:100px;" readonly step="any"></td>

                            <td colspan="4">AVG (LAST READDING)</td>

                
                           
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">

                                <span class="input-group-btn">
                                    <div class="btn btn-default value-control"><span class="glyphicon glyphicon-plus">+</span></div>
                                </span>
                                <input required="required" type="button" class="btn btn-default" id="r1" value="0.05" onclick="buttonPlus1();" name="r1" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" id="r2" value="0.10" onclick="buttonPlus2();" name="r2" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" id="r3" value="0.15" onclick="buttonPlus3();" name="r3" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" id="r4" value="0.20" onclick="buttonPlus4();" name="r4" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" id="r5" value="0.25" onclick="buttonPlus5();" name="r5" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" id="r6" value="0.30" onclick="buttonPlus6();" name="r6" style="width:40px;">
                                <span class="input-group-btn">
                                    <div class="btn btn-default value-control"><span class="glyphicon glyphicon-plus">+</span></div>
                                </span>

                            </td>
                
                 <td colspan="2">SCHEME NAME</td>

                
                 <td colspan="2">RESULT</td>
                
                 
                
                 
                            <td colspan="2" class="form-inline">


                                <label>
                                    <input type="radio" checked="checked" name="testingt" id="testing1" value="1">
                                    <span class="btn">1</span>
                                </label>
                                <label>
                                    <input type="radio" name="testingt" id="testing2" value="2">
                                    <span class="btn">2</span>
                                </label> <label>
                                    <input type="radio" name="testingt" id="testing3" value="3">
                                    <span class="btn">3</span>
                                </label> <label>
                                    <input type="radio" name="testingt" id="testing4" value="4">
                                    <span class="btn">4</span>
                                </label>


                            </td>

                          
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">
                                <span class="input-group-btn">
                                    <div class="btn btn-default value-control" data-action="minus" data-target="font-size"><span class="glyphicon glyphicon-minus">-</span></div>
                                </span>
                                <input required="required" type="button" class="btn btn-default" onclick="buttonMinus7();" value="0.05" name="r7" id="r7" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" onclick="buttonMinus8();" value="0.10" name="r8" id="r8" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" onclick="buttonMinus9();" value="0.15" name="r9" id="r9" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" onclick="buttonMinus10();" value="0.20" name="r10" id="r10" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" onclick="buttonMinus11();" value="0.25" name="r11" id="r11" style="width:40px;">
                                <input required="required" type="button" class="btn btn-default" onclick="buttonMinus12();" value="0.30" name="r12" id="r12" style="width:40px;">
                                <span class="input-group-btn">
                                    <div class="btn btn-default value-control" data-action="plus" data-target="font-size"><span class="glyphicon glyphicon-minus">-</span></div>
                                </span>
                            </td>
                           <td colspan="2">
                           <input type="file" id="picker"/> 
                           <select id="" name="sch_name">
                                    <option value="1">Sample</option>
                                    <option value="2">all</option>
                                </select></td>
                            <td colspan="2"><input required="required" type="text" value="<?= $data['result']; ?>" name="result" id="result" style="width:130px;" ></td>

                            <td colspan="2">
                                <div class="span2"><button type="submit" class="btn btn-secondary" style="width:600%;">Read Result</button></div>
                            </td>

                            </tr>
                
                
                        </tbody>
                </table>
                <hr style="width:100%;height:2px;border: 1px solid #cdd1d0;background: #ddd8d8cc;" />

                <table class="ds" id="gridexample">
                    <thead>
                         <!-- <tr>
                             <td>OTH</td>
                            <td><input required="required" type="number" value="<?= $data['oth']; ?>" name="othp" id="othp" style="width:100px;" readonly step="any"></td>

                           <td>T:</td>
                            <td><input required="required" type="number" value="<?= $data['tkarat']; ?> name="tkarat" id="tkarat" style="width:100px;" readonly step="any"></td>

                           <td colspan="2"></td>
                        </tr>-->
                        <tr>
                            <td>GOLD</td>
                            <td><input required="required" type="number" value="<?= $data['gold']; ?>" class="cal" id="gold" name="gold" step="any" style="width:100px;"></td>
                            <td>LEAD</td>
                            <td><input required="required" type="number" value="<?= $data['lead']; ?>" class="cal" id="lead" name="lead" style="width:100px;" step="any"></td>
                            <td>PLATINUM</td>
                            <td> <input required="required" type="number" value="<?= $data['platinum']; ?>" class="cal" id="platinum" name="platinum" style="width:100px;" step="any"></td>
                           <td>COBALT</td>
                            <td> <input required="required" type="number" value="<?= $data['cobalt']; ?>" class="cal" id="cobalt" name="cobalt" style="width:100px;" step="any"></td>
                       
                </tr>
                        <tr>
                            <td>COPPER</td>
                            <td><input required="required" type="number" value="<?= $data['copper']; ?>" id="copper" name="copper" style="width:100px;" step="any"></td>
                            <td> IRIDIUM</td>
                            <td><input required="required" type="number" value="<?= $data['iridium']; ?>" class="cal" id="iridium" name="iridium" style="width:100px;" step="any"></td>
                            <td>RUTHENIUM </td>
                            <td> <input required="required" type="number" value="<?= $data['ruthenium']; ?>" class="cal" id="rethenium" name="rethenium" style="width:100px;" step="any"></td>
                            <td>BISMUTH</td>
                            <td><input required="required" type="number" value="<?= $data['bismuth']; ?>" class="cal" id="bismuth" name="bismuth" style="width:100px;" step="any"> </td>
                           
                </tr>
                        <tr>
                            <td>SILVER</td>
                            <td><input required="required" type="number" value="<?= $data['silver']; ?>" id="silver" name="silver" style="width:100px;" step="any"> </td>
                            <td>NICKEL</td>
                            <td><input required="required" type="number" value="<?= $data['nickel']; ?>" class="cal" id="nikel" name="nikel" style="width:100px;" step="any"> </td>
                            <td>RHENIUM</td>
                            <td> <input required="required" type="number" value="<?= $data['rhenium']; ?>" class="cal" id="rhenium" name="rhenium" style="width:100px;" step="any"></td>
                            <td>RHODIUM</td>
                            <td><input required="required" type="number" value="<?= $data['rhodium']; ?>" class="cal" id="rhodium" name="rhodium" style="width:100px;" step="any"> </td>
                            

                        </tr>
                        <tr>
                            <td>ZINC</td>
                            <td> <input required="required" type="number" value="<?= $data['zinc']; ?>" id="zinc" name="zinc" style="width:100px;" step="any"></td>
                            <td>TIN</td>
                            <td> <input required="required" type="number" value="<?= $data['tin']; ?>" class="cal" id="tin" name="tin" style="width:100px;" step="any"></td>
                            <td>INDIUM</td>
                            <td> <input required="required" type="number" value="<?= $data['indium']; ?>" class="cal" id="indium" name="indium" style="width:100px;" step="any"> </td>
                            <td>IRON</td>
                            <td> <input required="required" type="number" value="<?= $data['iron']; ?>" class="cal" id="iron" name="iron" style="width:100px;" step="any"></td>


                        </tr>
                
                
                        <tr>
                            <td>CADMIUM</td>
                            <td><input required="required" type="number" value="<?= $data['cadmium']; ?>" id="cadmium" name="cadmium" style="width:100px;" step="any"> </td>
                            <td>OSMIUM</td>
                            <td> <input required="required" type="number" value="<?= $data['osmium']; ?>" class="cal" id="osmium" name="osmium" style="width:100px;" step="any"></td>
                                <td>TUNGSTEN</td>
                            <td> <input required="required" type="number" value="<?= $data['tungsten']; ?>" class="cal" id="tungsten" name="tungsten" style="width:100px;" step="any"></td>
 
                <td>Others</td> 
                            <td> <input required="required" type="number" value="<?= $data['others']; ?>" class="cal" id="resultr" name="resultr" style="width:100px;" step="any"></td>

                        </tr>
                        </tbody>
                </table>
                <hr style="width:100%;height:2px;border: 1px solid #cdd1d0;background: #ddd8d8cc;" />
                <div class="row span12">
                    <div class="span4">
                        <label>
                            <input type="checkbox" name="route" id="route" value="normal">&nbsp;Cover Print&nbsp;


                            <input name="route" id="route" type="checkbox" value="transactional">&nbsp;SMS&nbsp;

                        </label>

                    </div>
                    <div class="span3">
                        <label>

                            <span class="add-on"> &nbsp;Max. Diff&nbsp;</span>
                            <input required="required" type="text" value="<?= $data['differ']; ?>" name="differ" readonly style="width:130px;">
                        </label>
                    </div>
                    <div class="span5">
                        <label>
                            <button type="" class="btn btn-secondary"><i class="icon-file"></i>Day Report</button>
                            <button type="" class="btn btn-secondary"><i class="icon-print"></i>Print Save</button>
                             <input type="button" onclick="saveData()" class="btn btn-primary" value="Submit">
                            <button type="button" class="btn btn-secondary"><i class="icon-print"></i>Print</button>
                        </label>
                    </div>

                </div>
            </div>

        </form>

    </div>
</div>


<script>
    <?php if (isset($this->page_config['autocomplete'])) : ?>
        var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
        $.each(autoComplete, function(targetField, value) {
            $.each(value, function(model, fieldToSearch) {
                $('[name="' + targetField + '"]').autocomplete({
                    //  source: page_url + "autocomplete/" + model + '/' + fieldToSearch,
                    source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                    minLength: 1,
                    select: function(event, ui) {
                        $.each(ui.item.complete, function(populate_field, populate_value) {
                            $('[name="' + populate_field + '"]').val('');
                        });
                        $.each(ui.item.complete, function(populate_field, populate_value) {
                            $('[name="' + populate_field + '"]').val(populate_value);
                        });
                    }

                });
            });
        });
    <?php endif; ?>
</script>




<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    

    
    $(document).ready(function(){
  let columns_number=8; // static for me, but you can send/get it via data-columns="4" as form attribute

  $('#gridexample').find('input, select, textarea').each(function(){
      $(this).attr('tabindex', $(this).attr('type')==='button' ? 999 : $(this).closest('td').index()%columns_number);
  });
});
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function saveData(){
    
let x =document.myform.search_word.value;
 // let n =document.myform.result.value;
 
              //Javascript reGex for Email Validation.
              
                var wgt=/[a-zA-Z]{3,}[0-9]{1,}/;  // Javascript reGex for Phone Number validation.
                 
  if (x == ""|| !wgt.test(x)) {
    alert("sr number must be filled WBBP");
    return false;
  }
  
       // $.post($(targetform).attr("action"),$(targetform).serialize(),function(resp){
  $.post("<?= base_url() ?>console/testing/edit_detail", $("#dfrm").serialize(), function(resp) {
            if(resp.status=="success"){
                alert("Data Saved");
                 setTimeout(function(){
			var nw = window.open('<?= base_url() ?>testing_print_tpl.php?testing_order_serial='+resp.testing_order_serial,"_blank","width=900,height=600")
             setTimeout(function(){
								nw.print()
								setTimeout(function(){
								//	nw.close()
									location.reload()
								},500)
							},500)
						},500)
            }
        },'json')
        return false;
    }
    $(document).ready(function() {
  //input color 
$.each($('input[class=cal]'),function(){

if ($(this).val() >0 ) {
            $(this).css("background", "red");
            $(this).css("color", "#fff");
        } else {
            $(this).css("background", "white");
        }
  
});
    //blur
 $('input[class=cal]').blur(function() {      
if ($(this).val() >0 ) {
            $(this).css("background", "red");
        } else {
            $(this).css("background", "white");
        }
     });
    
    
        $("#search_word").keyup(function() {
            var strval = $("#search_word").val();
            if (strval == "") {
                // $("#suggestions").html("<b>no record found...</b>");
            } else {
                $.get("<?=base_url()?>console/testing/ajaxsearch?serial=" + strval, function(data) {
                    // console.log(data);
                    $("input#srn").val(data.orderget[0].order_serial_no);
                    $("#metal").html('<span>' + data.orderget[0].element_name + '</span>');
                    $("input#metal").val(data.orderget[0].element_name);
                    $("#date").html('<span>' + data.orderget[0].added_on + '</span>');
                    $("input#date").val(data.orderget[0].added_on);
                    $("#weight").html('<span>' + data.orderget[0].weight + '</span>');
                    $("input#weight").val(data.orderget[0].weight);
                    $("#sample").html('<span>' + data.orderget[0].sample_name + '</span>');
                    $("input#sample").val(data.orderget[0].sample_name);
                    $("#testing").html('<span>' + data.orderget[0].testing_name + '</span>');
                    $("input#testing").val(data.orderget[0].testing_name);
                    if (data.orderget[0].seal_unique_id == 0) {
                        $("#seal").html('<span>No</span>');
                        $("input#seal").val('No');
                    } else {
                        $("#seal").html('<span>Yes</span>');
                        $("input#seal").val('Yes');
                    }


                    //alert(data);
                }, 'json');
            }

        });
    });

    $(document).on('click', '.value-control', function() {
        var d = 0.5;
        var action = $(this).attr('data-action')
        var target = $(this).attr('data-target')
        var value = parseFloat($('[id="' + target + '"]').val());
        if (action == "plus") {
            value += d;
        }
        if (action == "minus") {
            value -= d;
        }
        $('[id="' + target + '"]').val(value)
        $('[id="font-size"]').val(value + 0.5)

    })
</script>
<script>
    var r1 = 0,
        r2 = 0,
        r3 = 0,
        r4 = 0,
        r5 = 0,
        r6 = 0,
        r7 = 0,
        r8 = 0,
        r9 = 0,
        r10 = 0,
        r11 = 0,
        r12 = 0;

    function buttonPlus1() {
        var r = parseFloat($("#gold").val()) + parseFloat(document.getElementById('r1').value);
        r1 = parseFloat(r1 + .05);
        document.getElementById('r1').value = parseFloat(0.05).toFixed(2);
        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
        //$("#result").val(parseFloat(r));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }

    function buttonPlus2() {
        var r = parseFloat($("#gold").val()) + parseFloat(document.getElementById('r2').value);
        r2 = parseFloat(r2 + 0.10);
        // document.getElementById('r2').value = parseFloat(r2).toFixed(2);
        document.getElementById('r2').value =parseFloat(0.10).toFixed(2);
        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
       // $("#result").val(parseFloat(r));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }

    function buttonPlus3() {
        var r = parseFloat($("#gold").val()) + parseFloat(document.getElementById('r3').value);
        r3 = parseFloat(r3 + 0.15);
        document.getElementById('r3').value = parseFloat(0.15).toFixed(2);

        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
       // $("#result").val(parseFloat(r));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }

    function buttonPlus4() {
        var r = parseFloat($("#gold").val()) + parseFloat(document.getElementById('r4').value);
        r4 = parseFloat(r4 + 0.20);
        document.getElementById('r4').value = parseFloat(0.20).toFixed(2);

        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
       // $("#result").val(parseFloat(r));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }

    function buttonPlus5() {
        var r = parseFloat($("#gold").val()) + parseFloat(document.getElementById('r5').value);
        r5 = parseFloat(r5 + 0.25);
        document.getElementById('r5').value = parseFloat(0.25).toFixed(2);

        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
        
    }

    function buttonPlus6() {
        var r = parseFloat($("#gold").val()) + parseFloat(document.getElementById('r6').value);
        r6 = parseFloat(r6 + 0.30);
        document.getElementById('r6').value = parseFloat(0.30).toFixed(2);

        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
       // $("#result").val(parseFloat(r));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }

    function buttonMinus7() {
        var r = parseFloat($("#goldr").val() - document.getElementById('r7').value);
        r7 = parseFloat(r7 + 0.05);
        document.getElementById('r7').value = parseFloat(0.05).toFixed(2);
        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));

    }

    function buttonMinus8() {
        var r = parseFloat($("#goldr").val() - document.getElementById('r8').value);
        r8 = parseFloat(r8 + 0.10);
        document.getElementById('r8').value = parseFloat(0.10).toFixed(2);
        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }

    
    function buttonMinus9() {
        var r = parseFloat($("#goldr").val() - document.getElementById('r9').value);
        r9 = parseFloat(r9 + 0.15);
        document.getElementById('r9').value = parseFloat(0.20).toFixed(2);
        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
       $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }
    function buttonMinus10() {
        var r = parseFloat($("#goldr").val() - document.getElementById('r10').value);
        r10 = parseFloat(r10 + 0.20);
        document.getElementById('r10').value = parseFloat(0.20).toFixed(2);
        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
       $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }

    function buttonMinus11() {
        var r = parseFloat($("#goldr").val() - document.getElementById('r11').value);
        r11 = parseFloat(r11 + 0.25);
        document.getElementById('r11').value = parseFloat(0.25).toFixed(2);
        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
       $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }

    function buttonMinus12() {
        var r = parseFloat($("#goldr").val() - document.getElementById('r12').value);
        r12 = parseFloat(r12 + 0.30);
        document.getElementById('r12').value = parseFloat(0.30).toFixed(2);
        $("#gold").val(parseFloat(r).toFixed(2));
        $("#goldr").val(parseFloat(r).toFixed(2));
        $("#copper").val(parseFloat((100-r).toFixed(2)));
        $("#karatr").val(parseFloat((r)*0.24).toFixed(2));
    }
    function calculate_powder() {
    
        var lead= parseFloat($("#lead").val());
        var iridium= parseFloat($("#iridium").val());
        var nickel= parseFloat($("#nikel").val());
        var tin= parseFloat($("#tin").val());
        var osmium= parseFloat($("#osmium").val());
    
        var platinum= parseFloat($("#platinum").val());
        var ruthenium= parseFloat($("#rethenium").val());
        var rhenium= parseFloat($("#rhenium").val());
        var tungsten= parseFloat($("#tungsten").val());
        var indium= parseFloat($("#indium").val());
    
        var cobalt= parseFloat($("#cobalt").val());
        var bismuth= parseFloat($("#bismuth").val());
        var rhodium= parseFloat($("#rhodium").val());
        var iron= parseFloat($("#iron").val());
        var others= parseFloat($("#resultr").val());
    
     // var oth_t = parseFloat(lead+iridium+nickel+tin+osmium+platinum+ruthenium+rhenium+tungsten+indium+cobalt+bismuth+rhodium+iron+others);
     var oth_t = parseFloat(lead+iridium+nickel+tin+osmium+platinum+ruthenium+rhenium+tungsten+indium+cobalt+bismuth+rhodium+iron+others); 
  // alert(oth_t);
        var tkarat= parseFloat($("#tkarat").val());
         var recorded_purity = parseFloat($("#goldr").val());
        $("#othp").val(parseFloat(oth_t).toFixed(2)); 
        var othp= parseFloat($("#othp").val());
         $("#tkarat").val(parseFloat(recorded_purity-othp).toFixed(2)); 
        var tkarat = parseFloat($("#tkarat").val()).toFixed(2);
        $("#karatr").val(parseFloat(tkarat*0.24).toFixed(2));
       
    }

    function calculate_purity() {
    
        var recorded_purity = parseFloat($("#goldr").val());
      
        var silver = parseFloat($("#silver").val());
        var zinc = parseFloat($("#zinc").val());
        var cadmium = parseFloat($("#cadmium").val());
      //  console.log("impurity:" + zinc + cadmium + silver)
    
//        
        var base_copper = parseFloat(100 - (recorded_purity + zinc + cadmium + silver).toFixed(2));

        $("#copper").val(parseFloat(base_copper).toFixed(2));

        var copper = $("#copper").val();

        $('#gold').val(parseFloat(recorded_purity).toFixed(2));
    }
    $(document).ready(function() {

        $("#gold").blur(function() {
        $("#goldr").val($(this).val())
      //  $("#karatr").val(parseFloat(tkarat*0.24).toFixed(2));
       $("#karatr").val(parseFloat($(this).val()*0.24).toFixed(2));
            calculate_purity();
        });

        $("#result").blur(function() {
      
            $("#result").val(parseFloat($(this).val()).toFixed(2));
          // $("#karatr").val(parseFloat(tkarat*0.24).toFixed(2));
           // $("#karatr").val(parseFloat($(this).val()*0.24).toFixed(2));
            $("#gold").val(parseFloat($(this).val()).toFixed(2));
            $("#goldr").val(parseFloat($(this).val()).toFixed(2));
            calculate_purity();
            calculate_powder();
        });
      
       $("#copper").blur(function(){

        var c=$("#copper").val();

       $("#gold").val(parseFloat(100-c));
        $("#goldr").val(parseFloat(100-c));
       // $("#karatr").val(parseFloat((100-c)*0.24).toFixed(2));
      //  $("#result").val(c-100);
       calculate_purity()
       calculate_powder();
         });

        //zinc
        $("#zinc").blur(function(){
        var z=$("#zinc").val();
        var c=$("#copper").val();
       // $("#copper").val(parseFloat(c-z).toFixed(2));
        calculate_purity();
        calculate_powder();
        });

        //slver
        $("#silver").blur(function() {
            var z = $("#silver").val();
            var c = $("#copper").val();
           // $("#copper").val(parseFloat(c - z).toFixed(2));
            calculate_purity();
            calculate_powder();
        });

        // //tin
         $("#tin").blur(function(){
        var z=$("#tin").val();
         var c=$("#copper").val();
        // $("#copper").val(parseFloat(c-z).toFixed(2));
           calculate_powder();
           calculate_purity();
         });

        // //cadmium
     $("#cadmium").blur(function(){
        var z=$("#cadmium").val();
        var c=$("#copper").val();
      //  $("#copper").val(parseFloat(c-z).toFixed(2));
       calculate_powder();
       calculate_purity();
        });

        // //nikel
        $("#nikel").blur(function(){
        var z=$("#nikel").val();
        var c=$("#copper").val();
         //$("#copper").val(parseFloat(c-z).toFixed(2));
          calculate_powder();
          calculate_purity();
        });
        // //iridium
        $("#iridium").blur(function(){
         var z=$("#iridium").val();
         var c=$("#copper").val();
        // $("#copper").val(parseFloat(c-z).toFixed(2));
          calculate_powder();
          calculate_purity();
         });
        // //osmium
         $("#osmium").blur(function(){
         var z=$("#osmium").val();
         var c=$("#copper").val();
         //  $("#copper").val(parseFloat(c-z).toFixed(2));
           calculate_powder();
           calculate_purity();
         });
        // //rethenum
        $("#rethenium").blur(function(){
        var z=$("#rethenium").val();
         var c=$("#copper").val();
        // $("#copper").val(parseFloat(c-z).toFixed(2));
          calculate_purity();
          calculate_powder();
         });
        // //rhenium
         $("#rhenium").blur(function(){
        var z=$("#rhenium").val();
         var c=$("#copper").val();
         //$("#copper").val(parseFloat(c-z).toFixed(2));
         calculate_purity();
         calculate_powder();
         });
        // //indium
         $("#indium").blur(function(){
         var z=$("#indium").val();
         var c=$("#copper").val();
          // $("#copper").val(parseFloat(c-z).toFixed(2));
          calculate_purity();
          calculate_powder();
         });
    
    //new
    $("#lead").blur(function(){
         var othp=parseFloat($("#othp").val());
         var z=parseFloat($("#lead").val());
         var c=parseFloat($("#copper").val());
         $("#copper").val(parseFloat(c-z).toFixed(2));
        // $("#othp").val(parseFloat(othp+z));
         calculate_powder();
         calculate_purity();
         });
    $("#platinum").blur(function(){
         var z=$("#platinum").val();
         var c=$("#copper").val();
        // $("#copper").val(parseFloat(c-z).toFixed(2));
         calculate_purity();
          calculate_powder();
         });
    $("#bismuth").blur(function(){
         var z=$("#bismuth").val();
         var c=$("#copper").val();
       //  $("#copper").val(parseFloat(c-z).toFixed(2));
       calculate_powder();
       calculate_purity();
         });
    $("#rhodium").blur(function(){
         var z=$("#rhodium").val();
         var c=$("#copper").val();
       //  $("#copper").val(parseFloat(c-z).toFixed(2));
     calculate_powder();
         });
    $("#iron").blur(function(){
         var z=$("#iron").val();
         var c=$("#copper").val();
         //$("#copper").val(parseFloat(c-z).toFixed(2));
          calculate_purity();
          calculate_powder();
         });
    $("#cobalt").blur(function(){
         var z=$("#cobalt").val();
         var c=$("#copper").val();
       //  $("#copper").val(parseFloat(c-z).toFixed(2));
          calculate_purity();
          calculate_powder();
         });
    $("#tungsten").blur(function(){
         var z=$("#tungsten").val();
         var c=$("#copper").val();
        // $("#copper").val(parseFloat(c-z).toFixed(2));
          calculate_purity();
          calculate_powder();
         });
    
    
  // others
       $("#resultr").blur(function(){
         var z=parseFloat($("#resultr").val());
         var c=parseFloat($("#copper").val());
       //  $("#copper").val(parseFloat(c-z).toFixed(2));
       calculate_purity();
          calculate_powder();
         });

    });
    
fetch('http://192.168.18.141:8000/SAMPLE.exp')
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    } else {
      return response.text();
    }
  })
  .then(text => {
    console.log(text);
  })
  .catch(error => {
    console.log(error);
  });

</script>
