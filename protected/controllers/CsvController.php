<?php

class CsvController extends RController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionAa(){
        $conn = mysql_connect("localhost","root","");
        mysql_select_db("db_namche",$conn);

        $query = "SELECT * FROM tbl_bus";
        $result = mysql_query($query);

        $num_column = mysql_num_fields($result);

        $csv_header = '';
        for($i=0;$i<$num_column;$i++) {
            $csv_header .= '"' . mysql_field_name($result,$i) . '",';
        }
        $csv_header .= "\n";

        $csv_row ='';
        while($row = mysql_fetch_row($result)) {
            for($i=0;$i<$num_column;$i++) {
                $csv_row .= '"' . $row[$i] . '",';
            }
            $csv_row .= "\n";
        }

        /* Download as CSV File */
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=toy_csv.csv');

        echo $csv_header . $csv_row;
//        exit;
    }

    public function actionView1()
    {
        $csv_header = '';
        $csv_header .= '"daily_bus_queue_id","time_id","bus_id","queue_serial"';
        $csv_header .= "\n";

        $csv_row ='';
        $model = DailyBusQueue::model()->findAll();
        foreach ($model as $m) {
            $t_arr = explode(',', $m->time_id);
            $b_arr = explode(',', $m->bus_id);
            $q_arr = explode(',', $m->queue_serial);
            if (count($t_arr) == count($b_arr) && count($t_arr) == count($q_arr)) {
                foreach (array_keys($t_arr + $b_arr + $q_arr) as $tb) {
                    $csv_row .= '"' . $m->id . '","' . $t_arr[$tb] . '","' . $b_arr[$tb] . '","' . $q_arr[$tb] . '"';
                    $csv_row .= "\n";
//                    $m->id;
//                    $t_arr[$tb];
//                    $b_arr[$tb];
//                    $q_arr[$tb];
                }
            } else {
                var_dump("Something wrong at id no. <strong>".$m->id."</strong>");
                exit;
            }
        }
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=toy_csv.csv');

        echo $csv_header . $csv_row;
    }

    public function actionView()
    {
//        return $csv->toArray();
//        $criteria1 = new CDbCriteria();
//        $criteria1->condition = 'id >:id1 and id <:id2';
//        $criteria1->params = array(':id1' => 0, ':id2'=>112);
        $model = DailyBusQueue::model()->findAll();
        $type=@$_GET['type'];
        if($type=='csv'){
            $csv_header = '';
            $csv_header .= '"daily_bus_queue_id","time_id","bus_id","queue_serial","payment_status","bus_remove_type"';
            $csv_header .= "\n";

            $csv_row ='';
            foreach ($model as $m) {
                $t_arr = explode(',', $m->time_id);
                $b_arr = explode(',', $m->bus_id);
                $q_arr = explode(',', $m->queue_serial);
                $p_sts_arr = explode(',', $m->payment_status);
                if (count($t_arr) == count($b_arr) && count($t_arr) == count($q_arr)) {
                    foreach (array_keys($t_arr + $b_arr + $q_arr) as $tb) {
                        $bid=$b_arr[$tb];
                        $psts=0;
                        if(in_array($bid, $p_sts_arr))
                            $psts=1;
                        $csv_row .= '"' . $m->id . '","' . $t_arr[$tb] . '","' . $bid . '","' . $q_arr[$tb] . '","' . $psts . '","0"';
                        $csv_row .= "\n";
                    }
                } else {
                    var_dump("Something wrong at id no. <strong>".$m->id."</strong>");
                    exit;
                }
            }
            $file_name='queued_bus'.Date('Ymd_His').'.csv';
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$file_name);

            echo $csv_header . $csv_row;
            exit;
        }
        $this->render('view',['model'=>$model]);
    }
}