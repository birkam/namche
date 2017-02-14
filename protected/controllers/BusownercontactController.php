<?php

class BusOwnerContactController extends RController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column1';

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
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }


public function actionSms(){
        if(Yii::app()->user->name=='admin') {
//            $owner = BusOwnerContact::model()->findAll("mobile");
            if(isset($_POST['send'])){
                $message = $_POST['message'];
                $criteria = new CDbCriteria();
                $criteria->order = 'busOwnerId DESC';
                $mobile = BusOwnerContact::model()->findAll($criteria);
                foreach($mobile as $no){
                    $mobilenum = substr($no->mobile,0,10);
                    $mobile_str = $mobilenum.",";
                }
                $args = http_build_query(array(
                    'token' => 'jgmU9xJXln8HUNZSymU9',
                    'from'  => 'samagyan',
                    // 'to'    => $mobile_str,
                    'to'    => '
9846280310,9856022879,9846036821,9805885510,9808322085,9846224960,9856042680,9856034968,9846106557,9846619034,9824196224,9846614351,9846091338,9856031770,9856022674,9846037989,9845610980,9802810476,9846651111,9814121923,9847651557,9846059474,9855046732,9856044973,9856071715,9846037386,9846049921,9843385055,061 462936,9846071660,9846047319,9806601383,9726141179,9841457317,065 560540,061 466703,9808480745,9856020211,9846043247,9846137904,9855022367,9819125973,9841938404,9846044373,9846417647,9846460307,9851076187,9846070111,9856021215,9818396244,9856021532,9846021145,9845113060,9813874482,9856031158,9845030051,9851151567,9846427765,9841322312,9846058000,9856023160,9815148237,9846362027,9843475784,9808678054,9846184788,9856023412,9846045163,9804168794,9846135406,9856021103,9845176590,9804161048,061 520495,9856060587,9856041333,9806881874,9851116337,9856029234,9846408871,9846606694,9846020826,9843050533,9856051111,9846131307,9846231824,9848784254,9846175872,9846321733,9847623535,9856028057,9856032447,9846024440,9846074610,9805826060,9846082481,9819285685,9846154455,9846030944,9846046912,9845032958,9816641931,9846041582,9856028136,9846306059,9846193577,9846321771,9841919019,9856030566,9846382023,9846333267,9806799776,9851027297,9856048633,9846056167,9846413375,9846056446,9856060098,9856023063,9856026882,9846234478,9846313593,9846063328,9806666114,9746007891,9855040275,9815100385,9856033262,9846059341,9856029814,9856029514,9855052479,9846553972,9805177973,9846306227,9856050354,9846022933,9745082346,9856031474,9856026240,9846127644,9846562980,9846041993,9855046732,9806680618,9804134345,9846104750,9856021978,9841398639,9815136223,9856034153,9856062863,9806705017,9846322085,9855040275,9846021145,9846027956,9806522123,9817185841,9851199895,9817243085,9846154455,9846079807,9856060741,9806736524,9856035670,061 524184,9846117107,9856052224,9846021145,9846064627,9856031784,9856025568,9804101847,9846022807,9849538749,9846027671,9846153595,9846048722,9846150200,9804140361,9846105145,9846084383,9846078687,9846046230,9846046230,9856024195,9846722015,9856030879,9856035053,9856025635,9846225831,9846140702,9846029018,9846029018,9856034292,9856026475,9846085957,9846028665,9856025568,9856022854,9817166251,9846046948,9818965206,9846039806,9846032638,9856026938,9846058686,9856028842,9856044141,9856028842,9856026938,9856028842,9846028230,9846088080,9846052045,9856025117,9840603140,9816198687,9856045323,9846516667,9856024427,9846058255,9846705821,9856039517,9806712182,9856035670,9846030660,9856035670,9856025117,9814162244,9846023059,9846075499,9814160117,9846067561,9846041739,9856035941,9846208616,061 430765,9846051512,9856026934,9846265410,9856021215,9846023402,9846041809,9846130607,9846177200,9846160137,9856037973,9816624374,9856020645,9846291008,9856040428,9856024623,9856032463,9846157001,9856020507,9846034131,9806796506,9846525885,9856050296,9856027651,9846060823,9846174007,9804153885,9806608985,9856028158,9846208682,9856035515,9846072767,9846529812,9856032157,9856038176,9846399989,9816138002,9856020666,9856032463,9841357312,9846047517,9856027790,9806522816,9846246877,9856024443,9846057114,9804148257,9846266290,9803529811,9808457779,9856034830,9846107946,9846564515,9805826345,9856025798,9856037268,9846130423,9856039299,9816672046,9846041877,9847631889,9846156366,9846054155,9804161608,9846751030,9856031783,9808973507,9841423533,9846350620,9856036732,9856038904,9846374465,9856024349,9805863571,9804132708,9856023711,9846217500,9856050790,9846082736,9856021674,9804175296,9846061644,9846070481,9856026166,9846045419,9856032447,9806649087,9846346109,9817123818,9846145741,9819116921,9845041431,9846332851,9846077922,9860454473,9856055156,9846196755,9806551381,9846057727,9841852917,9846487284,9814126747,9803176474,9856021863,9856021663,9846040901,9806745670,9856032726,9846070260,9848073550,9846487563,9846099188,9846056003,9846071328,9846067000,9841067008,9846071347,9856033247,9819118326,9856028754,9856033247,9856044032,9846232228,9846025280,9846070407,9846659480,9846082332,9856021932,9856035617,9856020645,9846256204,9846056042,9856060377,9856036589,9846637703,9846603481,9856060180,9846218382,9846323943,9856060156,9846359667,9846030223,9856021716,9846051542,9845239459,9845059040,9856031035,9845078982,9856031783,9846797131,9846138288,9846214244,9845344573,9846559207,9846038416,9804106422,9856042450,9846055471,9846080575,9856021532,9846509293,9846059262,9846579282,066 520118,9856020645,9806626008,9846623481,9845053437,9846041654,9846041654,9856023238,9846022933,9846027060,9856037535,9856055557,9813629079,9846491923,9856024008,9846071804,9806538770,9846369105,9846521784,9804172706,9846030062,9846020655,9845833104,9846217674,9846042335,9846154702,9846617217,9806519907,9803463129,9804205642,9856050808,9856040138,9846056487,9808076934,9816650566,9814185311,9815156241,9804205642,9803845977,9846049351,9803731548,9856023238,9815170440,9856045678,9819159556,9856022275,9846367526,9846325535,9846483686,9846045035,9804160727,9856033571,9856028017,9806507697,9856029034,9841747967,9856038727,9856034755,9856038727,9846071660,9813068592,9808843123,9806505220,9803821419,9856037328,9804172615,9856023941,9802828754,9808963136,9856034153,9846182389,9856027830,9846082980,9846026878,9815180507,9846605142,9845113060,9849009921,9804106975,9856020072,9846026878,9811166288,9846035126,9856035809,9846021430,9846147448,9856032463,9846151487,9846281163,9841542601,9855060449,9846337419,9806688483,9846112105,9846067768,9818521062,9846226239,9846031672,9846704793,9856020353,9856023202,9846346722,061 463608,9841941049,9846065022,9856030912,9846074802,9846243019,9845051598,9846176144,9846324812,9846032151,9851040115,9841373829,9851103168,9846030622,9846455548,9846088996,9846077163,9845112784,9855023999,9856023160,9846127641,9804180514,9846178306,9846022821,9806732469,9846029066,9856024151,9846611553,9846335519,9841746365,9846033113,9856021988,9846031850,9856021448,9846200314,056530351�,9813439065,9856039190,9846294934,9856031602,9846033113,9841252434,9846037790,9846032792,9806754744,9846321588,9846052068,9824132474,9804114136,9846032670,9846146855,9856021078,9856030726,9846058291,9856055910,9846114188,9857022689,9817183351,9846039493,9846184363,9856035014,9846197964,9816196675,9846530498,9846054367,9856022650,9816614485,9856028440,9846150933,9846024088,9846026375,9846130387,9806505510,9856024296,9856024296,9856028935,9806579354,9846040888,9856025568,9856025568,9846781858,9849538749,9846062828,9806742483,9846445739,9846238875,9805873427,9846122541,9846182577,9846268343,9856033410,9856028440,9846184523,9860582182,9856022458,9856032463,9856022276,9817140788,9846150513,9846037989,9856023971,9815153952,9815153152,9847250389,9846444736,9846039625,9806588677,9856028236,9846260547,9806681581,9807278050,9847535323,9856029593,9846090287,9856026475,9846149502,9856025185,9806686730,9808261944,061 541468,9856038555,9746000657,9846039006,9818118688,9846056295,9846037989,9804152202,9816640052,9843600730,9846402647,9841260765,9816690901,9813388719,9846087478,9846447085,9846306132,9846025699,9841121228,9845596253,9846053617,9856027558,9845157860,9856055958,9806653450,9803246010,9846173808,9846180876,9746000657,9856023567,9846208734,9846046397,9841201787,9846109020,9846056043,9846065572,9846363969,9856060118,9846067000,9846023345,9846242900,9846492324,9856033410,9846015587,9846046774,9856060377,9851040777,9856027804,9806704721,9846028324,9856021995,9846029018,063 440168,9846054741,9846455249,9805865350,9856026240,9856032322,9856026240,9856032114,9846024440,9804148257,9804172168,9812778715,9843288385,9841782852,9846100618,9846027671,9856035764,9846059512,9804133165,9856023643,9856027926,9845594499,9856031940,9856035460,9846071415,9846206873,9846048726,9846095591,9846000518,9806716205,9846098816,9846156782,9846098299,9806659920,9856021340,9846034196,9846070481,9846055609,9856035310,9846509805,9846056503,9856029671,9846020591,9856022669,9846374735,9846030515,9856030729,9856031131,9846743962,9846195592,9846244007,9804171508,9856021340,9846135681,9846134404,9849113766,9846545800,9804106426,9803291396,9856055283,9846106806,9813038522,9856026172,9846050952,9856026175,9814154888,9846004950,9846438766,9806704968,9746002765,9846420505,9845691788,9846743112,9841629090,9846085815,9846060199,9856029298,9846702026,9846739367,9846153520,9847264073,9846171892,9856030427,9846185870,9846122371,9846044911,9851041060,9851149945,061 530681,9856031470,9856027830,9814131816,9819125973,9856027558,9856021906,9856027775,9856034118,9846268724,9846460441,9846029066,9815103366,9846027671,9846499471,9806544103,9856026882,9856036195,9851026457,9817112105,9846442138,9846058206,9856055777,9846070989,9849350409,9846025284,9846055711,9806544200,9845039288,9846090316,9856060883,9819196107,9802811065,9846078942,9846240096,9856025635,9846023995,9846268724,9846046314,9846046314,9856029221,9856021103,9846078041,9815100620,9846077144,9856033730,9856023160,9856021995,9856021995,63460119,9856022780,9846058428,9856030961,9856021995,9846211913,9856060883,9891515055,9804196162,9805878031,9846571386,21176,9846030051,051 520236,9814168370,9846252028,9818334588,9856025766,9856037760,9846026143,9856036151,9846020545,9856025635,9846018371,9806699027,9856035670,9856045277,9856037794,9856053856,9856020359,9856022674,9846390666,9841529196,9846057114,9856032447,9845304974,9856077785,9846375855,9851017785,9806533995,9819185742,9856023507,9851060266,9804116052,9846367260,9814188066,9846005165,9846201725,9804185884,9746003478,9806606694,9846052452,9846107967,9846046913,9846243727,9841216617,9846255038,9845064695,9846164083,9856020021,9856027778,9845099510,9856021716,9856023724,9841381162,9816108117,9856048899,9856020645,9856029554,9846100123,9856035074,9845079758,9845141052,9856028172,9846048859,9846054176,9811263716,9846047779,9856026294,9856024523,9846028836,9841570656,9804123045,9846068997,9806636678,9846475216,9846050826,9816660277,9846035049,9846041993,9845711481,9846025662,9856031170,9846510509,9856025162,9846167588,9856021070,9806598834,9856034227,9813344409,9846040961,9846030691,9846064526,9846145805,9816101439,9841382910,9856061440,9817103943,9806638476,9846539898,9846605970,9856036119,9846301171,9846196287,9856022854,9846030784,9846022818,9846022220,9856025938,9846113126,9856021940,9856050502,9846155067,9846105818,9856028435,9846245388,',

                    'text'  => $message,
                ));
                $url = "http://api.sparrowsms.com/v2/sms/";
# Make the call using API.
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// Response
                $response = curl_exec($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
            }elseif(isset($_POST['credit'])){
                $api_url = "http://api.sparrowsms.com/v2/credit/?";
                http_build_query(array(
                    'token' => '<token-provided>',
                    $response = file_get_contents($api_url)));
            }else{
                $response = null;
                $status_code = null;
            }
            $this->render('sms', array('response'=>$response, 'status_code'=>$status_code));
        }
        else{
            $this->redirect(array('site/login'));
        }
    }


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new BusOwnerContact;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if(isset($_POST['BusOwnerContact']))
        {
            $model->attributes=$_POST['BusOwnerContact'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate()
    {
        $owner_id = $_GET['owner_id'];
        $busOwnContact = BusOwnerContact::model()->findByAttributes(array('busOwnerId'=>$owner_id));
        $id = $busOwnContact->id;
        $model=$this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['BusOwnerContact']))
        {
            $model->attributes=$_POST['BusOwnerContact'];
            if($model->save())
                $this->redirect(array('/busOwner/'.$owner_id, 'ref'=>'ci'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
// we only allow deletion via POST request
            $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('BusOwnerContact');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new BusOwnerContact('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['BusOwnerContact']))
            $model->attributes=$_GET['BusOwnerContact'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=BusOwnerContact::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='bus-owner-contact-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
