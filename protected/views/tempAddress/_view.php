<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('busOwnerId')); ?>:</b>
	<?php echo CHtml::encode($data->busOwnerId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zone')); ?>:</b>
	<?php echo CHtml::encode($data->zone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('district')); ?>:</b>
	<?php echo CHtml::encode($data->district); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ward')); ?>:</b>
	<?php echo CHtml::encode($data->ward); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vdc_municipality')); ?>:</b>
	<?php echo CHtml::encode($data->vdc_municipality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tole')); ?>:</b>
	<?php echo CHtml::encode($data->tole); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('house_no')); ?>:</b>
	<?php echo CHtml::encode($data->house_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>