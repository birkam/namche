<?php
/* @var $this ReserveController */
/* @var $model Reserve */

$this->breadcrumbs=array(
	'Reserves'=>array('index'),
	'Create',
);

$criteria = new CDbCriteria();
$criteria->addInCondition('id', $owner_id_arr);
$owners=BusOwner::model()->findAll($criteria);
$owners_name_arr=array();
foreach ($owners as $o) {
    $owners_name_arr['']=$o->fname.' '.$o->mname.' '.$o->lname;
}
$owner_names=implode(', ',$owners_name_arr);

$fileno=FileNo::model()->findByPk($fileno_id);
?>
    <div class="title"><h5>Manage Reserves</h5></div>

<table class="well">
    <tr>
        <th>Bus No.</th>
        <th>=</th>
        <td><?php echo strtoupper($bus->bus_no); ?></td>
    </tr>
    <tr>
        <th>Owners.</th>
        <th>=</th>
        <td><?php echo ucwords(strtolower($owner_names)); ?></td>
    </tr>
    <tr>
        <th>File No.</th>
        <th>=</th>
        <td><?php echo $fileno->file_no; ?></td>
    </tr>
</table>
<!--<h3>Reserve Form</h3>-->
    <div class="title"><h5> Reserves Form</h5></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>