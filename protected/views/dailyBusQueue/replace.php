<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 3/20/2017
 * Time: 11:28 PM
 */
$bus_replace = [['id'=>1,'bus'=>'bus1'],['id'=>2,'bus'=>'bus2'],['id'=>3,'bus'=>'bus3']];
?>
<form>
<div class="modal-body">
    <br>
    <label>Replace <span style="font-weight: bolder;font-size: 14px; text-transform: uppercase;" id="old_bus"></span> With </label>
    <!--                                    <input type="text" placeholder="New bus" value="--><?//= 1; ?><!--">-->
    <select required="required">
        <option value="">Select One</option>
        <?php foreach($bus_replace as $br){?>
            <option value="<?= $br['id'];?>" selected="1"><?= $br['bus'];?></option>
        <?php } ?>
    </select>
    <label>Remarks</label>
    <textarea placeholder="Reason Behind Replacing"></textarea>
</div>
<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn">Save changes</button>
</div>
</form>