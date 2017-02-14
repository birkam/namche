<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/print/print.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 2/4/15
 * Time: 12:57 PM
 */


//$fileNo = FileNo::model()->findByPk($file_id);
$fileNumbers = FileNo::model()->findAll();
$arrFileNo = array();
?>
<form action="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/OwnerHistory" method="POST">

    <select name="id" class="span2" required="true">
        <option value="" <?php if (@$_POST['id']==0) echo 'selected="selected"';?>>Choose One</option>
        <?php
        foreach($fileNumbers as $fileNo){
            $arrDays[$fileNo->id] = $fileNo->file_no;

            ?>
            <option value="<?php echo $fileNo->id;?>"<?php if (@$_POST['id']==$fileNo->file_no) echo 'selected="selected"';?>><?php echo $fileNo->file_no;?></option>
        <?php }?>
        <option value="all" <?php if (@$_POST['id']=='all') echo 'selected="selected"';?>>All</option>
    </select>
    <input type="submit" value="Submit">

</form>
<?php $selectedFile = @$_POST['id'];
if(!empty($selectedFile)){
?>
<div class="printable">
    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Owner History Under File No "<?php echo $selectedFile;?>"</h5></div>


            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
                <thead>
                <tr>
                    <td width="5%">SN</td>
                    <td width="10%">File No</td>
                    <td width="30%">Owner</td>
                    <td width="10%">Owner Status</td>
                    <td width="15%">Owned Date</td>
                    <td width="15%">Left Date</td>
                    <td width="15%">Created By</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sn = 1;
                foreach($model as $file){
//          echo $file->id.'<br>';
                    $owners = BusOwner::model()->findByPk($file->owner_id);
                    $userAccount = UserAccount::model()->findByPk($file->created_by);
                    $userDetails = UserDetails::model()->findByPk($userAccount->user_id);
                    $fileNos = FileNo::model()->findByPk($file->fileno_id);
                    if($file->owner_status == 1){
                        $status = 'ACTIVE';
                    }elseif($file->owner_status == 0){
                        $status = 'INACTIVE';
                    }
                    echo '<tr>';
                    echo '<td>'.$sn.'</td>';
                    echo '<td>'.$fileNos->file_no.'</td>';
                    echo '<td>'.ucwords(strtolower($owners->fname.' '.$owners->mname.' '.$owners->lname)).'</td>';
                    echo '<td>'.$status.'</td>';
                    echo '<td>'.$file->owned_date.'</td>';
                    echo '<td>'.$file->left_date.'</td>';
                    echo '<td>'.ucwords(strtolower($userDetails->name)).'</td>';
                    echo '</tr>';
                    $sn=$sn+1;
                }

                ?>

                </tbody>
            </table>


        </div>
    </fieldset>

</div>
<p>
    <z><button>Print</button></z>
</p>
<?php }?>
<script type="text/javascript">

    // When the document is ready, initialize the link so
    // that when it is clicked, the printable area of the
    // page will print.
    $(
        function(){

// Hook up the print link.
            $( "z" )
                .attr( "href", "javascript:void( 0 )" )
                .click(
                function(){
// Print the DIV.
                    $( ".printable" ).print();

// Cancel click event.
                    return( false );
                }
            )
            ;

        }
    );

</script>