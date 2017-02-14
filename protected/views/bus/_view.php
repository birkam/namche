<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_no')); ?>:</b>
	<?php echo CHtml::encode($data->bus_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owned_date')); ?>:</b>
	<?php echo CHtml::encode($data->owned_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model_no')); ?>:</b>
	<?php echo CHtml::encode($data->model_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_seat')); ?>:</b>
	<?php echo CHtml::encode($data->total_seat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('engine_no')); ?>:</b>
	<?php echo CHtml::encode($data->engine_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chhachis_no')); ?>:</b>
	<?php echo CHtml::encode($data->chhachis_no); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('registered_date')); ?>:</b>
	<?php echo CHtml::encode($data->registered_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	*/ ?>


    <b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
    <?php echo CHtml::encode($data->remarks); ?>
    <br />

</div>