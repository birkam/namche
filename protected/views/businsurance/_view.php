<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_id')); ?>:</b>
	<?php echo CHtml::encode($data->bus_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insurance_company')); ?>:</b>
	<?php echo CHtml::encode($data->insurance_company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insurance_account')); ?>:</b>
	<?php echo CHtml::encode($data->insurance_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ac_holder_name')); ?>:</b>
	<?php echo CHtml::encode($data->ac_holder_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_invoice_no')); ?>:</b>
	<?php echo CHtml::encode($data->tax_invoice_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('police_no')); ?>:</b>
	<?php echo CHtml::encode($data->police_no); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_date')); ?>:</b>
	<?php echo CHtml::encode($data->issue_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expiry_date')); ?>:</b>
	<?php echo CHtml::encode($data->expiry_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>