<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mname')); ?>:</b>
	<?php echo CHtml::encode($data->mname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_of_birth')); ?>:</b>
	<?php echo CHtml::encode($data->date_of_birth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('landline')); ?>:</b>
	<?php echo CHtml::encode($data->landline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('em_contact_name')); ?>:</b>
	<?php echo CHtml::encode($data->em_contact_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('em_contact_relation')); ?>:</b>
	<?php echo CHtml::encode($data->em_contact_relation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('em_contact_number')); ?>:</b>
	<?php echo CHtml::encode($data->em_contact_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>