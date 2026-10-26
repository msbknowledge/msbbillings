
<table class="table table-bordered table-striped" style="font-size:10px">
    <thead>
        <tr>
            <th><strong>student Code</strong></th>	
            <th><strong>Name</strong></th>
            <th><strong>Contact</strong></th>
            <th><strong>Address</strong></th>
            <th><strong>Last Renewed On</strong></th>
            <th><strong>Upcoming Renew date</strong></th>
            <th><strong>Status</strong></th>
            <th><strong>Packages</strong></th>
        </tr><br> 
    </thead>
    <tbody>
        <?php
       // print_r($students);
        if ($students) {
            foreach ($students as $value) {
                ?>
                <tr>

                    <td>
                        <div style="display:flex">	
                            <? if ($value['student_expired']) { ?>
                                <span style="width:12px;border-radius: 12px;background:red;height: 12px;display: block;margin: none;float: left;"></span>
                            <? } else { ?>
                                <span style="width:12px;border-radius: 12px;background:green;height: 12px;display: block;margin: none;float: left;"></span>
                            <? } ?>
                            <span style="float:left;margin-left: 10px;"><?php echo $value['student_code']; ?></span>
                        </div>
                    </td>    
                    <td><?php echo $value['student_name']; ?></td> 
                    <td><?php echo $value['student_contact']; ?></td> 
                    <td><?php echo $value['student_address']; ?></td> 
                    <td><?php echo $value['student_last_renew_date']; ?></td> 
                    <td><?php echo $value['student_renewal_date']; ?></td> 
                    <td><?php echo $value['student_renewal_in']; ?></td> 
                    <td>
                        <form method="post" action="/console/renew/renew_student">
                            <input type="hidden" name="student_ID" value="<?php echo $value['student_ID'] ?>">
                            <div><?php 
                            $cus_package = json_decode($value['student_package'], true);
                            $data_arr = [];
                            if(!empty($cus_package['items'][0]['name'])){
                                foreach ($cus_package['items'] as $val) { 
                                    array_push($data_arr, $val['name']);
                                } 
                               $pack_name = implode(", ", $data_arr);
                               echo $pack_name;
                            }else{ ?>
                                <span>Package Not Assign</span>
                           <?php } ?></div>
                           <a href="/console/student/fastbill/<?php echo $value['student_ID'] ?>" style="border: 1px solid #ccc;font-size: small;padding: 6px;color: black;background-color: turquoise;border-radius: 5px;text-decoration: none;">Update Package</a>
                            <!-- <select name="student_package">
                                <?php //foreach ($packages as $val) {
                                    ?>
                                    <option <?php
                                    // if ($val['package_ID'] == $value['student_package']) {
                                    //     echo 'selected';
                                    // }
                                    ?> value=<?php //echo $val['package_ID'] ?>><?php //echo $val['package_name'] ?></option>   

                                <?php //}
                                ?>
                            </select> -->
                            on
                            <input type="date" name="student_last_renew_date" value="<?= date('Y-m-d') ?>"> 
                            For
                            <select name="for">
                                <option value=1>1 month</option>
                                <option value=2>2 months</option>
                                <option value=3>3 months</option>
                                <option value=4>4 months</option>
                                <option value=5>5 months</option>
                                <option value=6>6 months</option>
                                <option value=7>7 months</option>
                                <option value=8>8 months</option>
                                <option value=9>9 months</option>
                                <option value=10>10 months</option>
                                <option value=11>11 months</option>
                                <option value=12>12 months</option>
                            </select>
                            <input type="submit" value="Renew">
                        </form>

                    </td>



                </tr>               
                <?php
            }
        }
        ?>

    </tbody>
</table>
