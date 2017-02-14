<?php
/* @var $this ReserveController */
/* @var $data Reserve */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_id')); ?>:</b>
	<?php echo CHtml::encode($data->bus_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('checked_cost_conf_id')); ?>:</b>
	<?php echo CHtml::encode($data->checked_cost_conf_id); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sahayog')); ?>:</b>
	<?php echo CHtml::encode($data->sahayog); ?>
	<br />

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

	<b><?php echo CHtml::encode($data->getAttributeLabel('bi_bya_sulka')); ?>:</b>
	<?php echo CHtml::encode($data->bi_bya_sulka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ma_kosh')); ?>:</b>
	<?php echo CHtml::encode($data->ma_kosh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reserve_date')); ?>:</b>
	<?php echo CHtml::encode($data->reserve_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reserve_time')); ?>:</b>
	<?php echo CHtml::encode($data->reserve_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_nep_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_nep_date); ?>
	<br />

	*/ ?>

</div>