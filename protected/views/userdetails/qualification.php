<fieldset>
    <div class="widget first">
        <div class="head"><h5 class="iList">Qualification</h5></div>
        <div class="rowElem ">
            <label>Acedimic Qualification:</label>

            <div class="formRight">
                <?php echo ucwords(strtolower($model->academic_qualification));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Proffessional Qualification:</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($model->professional_qualification	));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="fix"></div>

    </div>
</fieldset>
