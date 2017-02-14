<form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/MonthlyAll" method="POST">
    <select name="year" required="true">
        <option value="">Year</option>
        <?php
        date_default_timezone_set('Asia/Kathmandu');
        require_once('/../../nepalidate/nepali_calendar.php');
        $calendar = new Nepali_Calendar();
        $engDate = date('Y-m-d', time());
        if(!empty($engDate)){
            list($eDate, $emonth, $eday) =explode("-",$engDate);

            $cal = $calendar->eng_to_nep($eDate, $emonth, $eday);

        }
        foreach(range($cal['year'], 2022) as $yr){ ?>
            <option value="<?php echo $yr; ?>"<?php if (@$_POST['year']==$yr) echo 'selected="selected"';?>><?php echo $yr; ?></option>
        <?php } ?>
    </select>
    <select name="month" required="true">
        <option value="">Month</option>
        <option value="<?php echo '01'; ?>"<?php if (@$_POST['month']=='01') echo 'selected="selected"';?>>Baisakh</option>
        <option value="<?php echo '02'; ?>"<?php if (@$_POST['month']=='02') echo 'selected="selected"';?>>Jesth</option>
        <option value="<?php echo '03'; ?>"<?php if (@$_POST['month']=='03') echo 'selected="selected"';?>>Ashadh</option>
        <option value="<?php echo '04'; ?>"<?php if (@$_POST['month']=='04') echo 'selected="selected"';?>>Shrawan</option>
        <option value="<?php echo '05'; ?>"<?php if (@$_POST['month']=='05') echo 'selected="selected"';?>>Bhadra</option>
        <option value="<?php echo '06'; ?>"<?php if (@$_POST['month']=='06') echo 'selected="selected"';?>>Ashoj</option>
        <option value="<?php echo '07'; ?>"<?php if (@$_POST['month']=='07') echo 'selected="selected"';?>>Kartik</option>
        <option value="<?php echo '08'; ?>"<?php if (@$_POST['month']=='08') echo 'selected="selected"';?>>Mangsir</option>
        <option value="<?php echo '09'; ?>"<?php if (@$_POST['month']=='09') echo 'selected="selected"';?>>Poush</option>
        <option value="<?php echo '10'; ?>"<?php if (@$_POST['month']=='10') echo 'selected="selected"';?>>Magh</option>
        <option value="<?php echo '11'; ?>"<?php if (@$_POST['month']=='11') echo 'selected="selected"';?>>Falgun</option>
        <option value="<?php echo '12'; ?>"<?php if (@$_POST['month']=='12') echo 'selected="selected"';?>>Chaitra</option>
        </section>

        <input type="submit" value="Submit" name="submit">
</form>

<?php
if(!empty($checkedCostConf)){?>
    <div class="widget first">
        <div class="head"><h5 class="iFrames">Static table</h5></div>
        <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
            <thead>
            <tr>
                <th width="6.25%">Date</th>
                <th width="6.25%">Defined</th>
                <th width="6.25%">samiti sulka</th>
                <th width="6.25%">bhalai kosh</th>
                <th width="6.25%">samrakshan</th>
                <th width="6.25%">ticket</th>
                <th width="6.25%">sahayog</th>
                <th width="6.25%">bima</th>
                <th width="6.25%">bibidh</th>
                <th width="6.25%">mandir</th>
                <th width="6.25%">jokhim</th>
                <th width="6.25%">anugaman</th>
                <th width="6.25%">bi bya sulka</th>
                <th width="6.25%">ma kosh</th>
                <th width="6.25%">Miscellaneous</th>
                <th width="6.25%">Row Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $def_tot = 0;
            $rc_tot = 0;
            $mis_tot = 0;
            $res_tot=0;
            $col_tot_samiti_sulka=0;
            $col_tot_bhalai_kosh=0;
            $col_tot_samrakshan=0;
            $col_tot_ticket=0;
            $col_tot_sahayog=0;
            $col_tot_bima=0;
            $col_tot_bibidh=0;
            $col_tot_mandir=0;
            $col_tot_jokhim=0;
            $col_tot_anugaman=0;
            $col_tot_bi_bya_sulka=0;
            $col_tot_ma_kosh=0;
            $final_tot2=0;
            foreach($checkedCostConf as $cCC){
                $checked_rate_arr = explode(',', $cCC['checked_rate']);
//            $route_cost_arr = explode(',',$cCC['route_cost']);
                $crc_samiti_sulka_arr=explode(',',$cCC['crc_samiti_sulka']);
                $crc_bhalai_kosh_arr=explode(',',$cCC['crc_bhalai_kosh']);
                $crc_samrakshan_arr=explode(',',$cCC['crc_samrakshan']);
                $crc_ticket_arr=explode(',',$cCC['crc_ticket']);
                $crc_sahayog_arr=explode(',',$cCC['crc_sahayog']);
                $crc_bima_arr=explode(',',$cCC['crc_bima']);
                $crc_bibidh_arr=explode(',',$cCC['crc_bibidh']);
                $crc_mandir_arr=explode(',',$cCC['crc_mandir']);
                $crc_jokhim_arr=explode(',',$cCC['crc_jokhim']);
                $crc_anugaman_arr=explode(',',$cCC['crc_anugaman']);
                $crc_bi_bya_sulka_arr=explode(',',$cCC['crc_bi_bya_sulka']);
                $crc_ma_kosh_arr=explode(',',$cCC['crc_ma_kosh']);

                $res_samiti_sulka_arr=explode(',',$cCC['res_samiti_sulka']);
                $res_bhalai_kosh_arr=explode(',',$cCC['res_bhalai_kosh']);
                $res_samrakshan_arr=explode(',',$cCC['res_samrakshan']);
                $res_ticket_arr=explode(',',$cCC['res_ticket']);
                $res_sahayog_arr=explode(',',$cCC['res_sahayog']);
                $res_bima_arr=explode(',',$cCC['res_bima']);
                $res_bibidh_arr=explode(',',$cCC['res_bibidh']);
                $res_mandir_arr=explode(',',$cCC['res_mandir']);
                $res_jokhim_arr=explode(',',$cCC['res_jokhim']);
                $res_anugaman_arr=explode(',',$cCC['res_anugaman']);
                $res_bi_bya_sulka_arr=explode(',',$cCC['res_bi_bya_sulka']);
                $res_ma_kosh_arr=explode(',',$cCC['res_ma_kosh']);
                $dailydate = $cCC['created_nep_date'];
                //            $rc_tot = $rc_tot + array_sum($route_cost_arr);

                $tot_samiti_sulka=array_sum($crc_samiti_sulka_arr)+array_sum($res_samiti_sulka_arr);
                $tot_bhalai_kosh=array_sum($crc_bhalai_kosh_arr)+array_sum($res_bhalai_kosh_arr);
                $tot_samrakshan=array_sum($crc_samrakshan_arr)+array_sum($res_samrakshan_arr);
                $tot_ticket=array_sum($crc_ticket_arr)+array_sum($res_ticket_arr);
                $tot_sahayog=array_sum($crc_sahayog_arr)+array_sum($res_sahayog_arr);
                $tot_bima=array_sum($crc_bima_arr)+array_sum($res_bima_arr);
                $tot_bibidh=array_sum($crc_bibidh_arr)+array_sum($res_bibidh_arr);
                $tot_mandir=array_sum($crc_mandir_arr)+array_sum($res_mandir_arr);
                $tot_jokhim=array_sum($crc_jokhim_arr)+array_sum($res_jokhim_arr);
                $tot_anugaman=array_sum($crc_anugaman_arr)+array_sum($res_anugaman_arr);
                $tot_bi_bya_sulka=array_sum($crc_bi_bya_sulka_arr)+array_sum($res_bi_bya_sulka_arr);
                $tot_ma_kosh=array_sum($crc_ma_kosh_arr)+array_sum($res_ma_kosh_arr);

                $col_tot_samiti_sulka=$col_tot_samiti_sulka+$tot_samiti_sulka;
                $col_tot_bhalai_kosh=$col_tot_bhalai_kosh+$tot_bhalai_kosh;
                $col_tot_samrakshan=$col_tot_samrakshan+$tot_samrakshan;
                $col_tot_ticket=$col_tot_ticket+$tot_ticket;
                $col_tot_sahayog=$col_tot_sahayog+$tot_sahayog;
                $col_tot_bima=$col_tot_bima+$tot_bima;
                $col_tot_bibidh=$col_tot_bibidh+$tot_bibidh;
                $col_tot_mandir=$col_tot_mandir+$tot_mandir;
                $col_tot_jokhim=$col_tot_jokhim+$tot_jokhim;
                $col_tot_anugaman=$col_tot_anugaman+$tot_anugaman;
                $col_tot_bi_bya_sulka=$col_tot_bi_bya_sulka+$tot_bi_bya_sulka;
                $col_tot_ma_kosh=$col_tot_ma_kosh+$tot_ma_kosh;

                $other_amt_arr = explode(',',$cCC['amount']);
                $def_tot = $def_tot + array_sum($checked_rate_arr);

                $mis_tot = $mis_tot + array_sum($other_amt_arr);
                $route_tot=$tot_samiti_sulka+$tot_bhalai_kosh+$tot_samrakshan+$tot_ticket+$tot_sahayog+$tot_bima+$tot_bibidh+$tot_mandir+$tot_jokhim+$tot_anugaman+$tot_bi_bya_sulka+$tot_ma_kosh;
                $rowtotal = (array_sum($checked_rate_arr)+$route_tot+array_sum($other_amt_arr));
                $final_tot1 = $def_tot + $col_tot_samiti_sulka+$col_tot_bhalai_kosh+$col_tot_samrakshan+$col_tot_ticket+$col_tot_sahayog+$col_tot_bima+$col_tot_bibidh+$col_tot_mandir+$col_tot_jokhim+$col_tot_anugaman+$col_tot_bi_bya_sulka+$col_tot_ma_kosh+$mis_tot;
                $final_tot2=$final_tot2+$rowtotal;
                ?>
                <tr>
                    <td><?php echo $cCC['created_nep_date'];?></td>
                    <td><?php echo array_sum($checked_rate_arr) ;?></td>
                    <td><?php echo $tot_samiti_sulka;?></td>
                    <td><?php echo $tot_bhalai_kosh;?></td>
                    <td><?php echo $tot_samrakshan;?></td>
                    <td><?php echo $tot_ticket;?></td>
                    <td><?php echo $tot_sahayog;?></td>
                    <td><?php echo $tot_bima;?></td>
                    <td><?php echo $tot_bibidh;?></td>
                    <td><?php echo $tot_mandir;?></td>
                    <td><?php echo $tot_jokhim;?></td>
                    <td><?php echo $tot_anugaman;?></td>
                    <td><?php echo $tot_bi_bya_sulka;?></td>
                    <td><?php echo $tot_ma_kosh;?></td>
                    <td><?php echo array_sum($other_amt_arr);?></td>
                    <td><?php echo $rowtotal;?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
            <tr>
                <th>Grand Total </th>
                <th><?php echo $def_tot;?></th>
                <th><?php echo $col_tot_samiti_sulka;?></th>
                <th><?php echo $col_tot_bhalai_kosh;?></th>
                <th><?php echo $col_tot_samrakshan;?></th>
                <th><?php echo $col_tot_ticket;?></th>
                <th><?php echo $col_tot_sahayog;?></th>
                <th><?php echo $col_tot_bima;?></th>
                <th><?php echo $col_tot_bibidh;?></th>
                <th><?php echo $col_tot_mandir;?></th>
                <th><?php echo $col_tot_jokhim;?></th>
                <th><?php echo $col_tot_anugaman;?></th>
                <th><?php echo $col_tot_bi_bya_sulka;?></th>
                <th><?php echo $col_tot_ma_kosh;?></th>
                <th><?php echo $mis_tot;?></th>
                <th><?php echo $final_tot2;?></th>
                <?php
                ?>
            </tr>
        </table>
    </div>
<?php }else{
    $user = Yii::app()->getComponent('user');
    $user->setFlash(
        'error',
        "<strong>No Results.</strong>"
    );
    $this->widget('bootstrap.widgets.TbAlert', array(
        'fade' => true,
        'closeText' => '&times;', // false equals no close link
        'events' => array(),
        'htmlOptions' => array(),
        'userComponentId' => 'user',
        'alerts' => array( // configurations per alert type
            // success, info, warning, error or danger
            'success' => array('closeText' => '&times;'),
            'info', // you don't need to specify full config
            'warning' => array('closeText' => false),
            'error' => array('closeText' => '')
        ),
    ));
} ?>

<script>
    $('#date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>