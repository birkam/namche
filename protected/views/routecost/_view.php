<?php
/* @var $this RouteCostController */
/* @var $data RouteCost */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('route_id')); ?>:</b>
	<?php echo CHtml::encode($data->route_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('samiti_sulka')); ?>:</b>
	<?php echo CHtml::encode($data->samiti_sulka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bhalai_kosh')); ?>:</b>
	<?php echo CHtml::encode($data->bhalai_kosh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('samrakshan')); ?>:</b>
	<?php echo CHtml::encode($data->samrakshan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket')); ?>:</b>
	<?php echo CHtml::encode($data->ticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sahayog')); ?>:</b>
	<?php echo CHtml::encode($data->sahayog); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bima')); ?>:</b>
	<?php echo CHtml::encode($data->bima); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bibidh')); ?>:</b>
	<?php echo CHtml::encode($data->bibidh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mandir')); ?>:</b>
	<?php echo CHtml::encode($data->mandir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jokhim')); ?>:</b>
	<?php echo CHtml::encode($data->jokhim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anugaman')); ?>:</b>
	<?php echo CHtml::encode($data->anugaman); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ma_kosh')); ?>:</b>
	<?php echo CHtml::encode($data->ma_kosh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost_status')); ?>:</b>
	<?php echo CHtml::encode($data->cost_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>