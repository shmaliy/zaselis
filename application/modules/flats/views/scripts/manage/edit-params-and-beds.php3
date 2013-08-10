<h2>Удобства и кровати</h2>
<style>
    .slideThreeOnOff:after {
	content: 'Нет';
	color: #000;
    }

    .slideThreeOnOff:before {
        content: 'Да';
        color: green;
    }
</style>

<div class="params-container">
    <h4>Удобства квартиры</h4>
    <ul id="ParamsGreed">
        <?php foreach ($this->params as $param) : ?>
        <li class="cf" rel ="<?php echo $param['param_id']; ?>" alt ="<?php echo $param['rel_id']; ?>">
            <div class="param-icon">
                <?php if(!empty($param['param_icon'])) : ?>
                    <?php $icon = str_replace('/parameters-icons/', '/parameters-icons/thumbnail-16-16/', $param['param_icon']); ?>
                    <img src="<?php echo $icon; ?>" />
                <?php endif; ?>
            </div>
            <div class="param-title"><?php echo $param['param_title']; ?></div>
            <div class="param-value">
                <?php if ($param['param_type'] == 'BOOLEAN') : ?>
                    <div class="slideThreeOnOff">
                        <?php if($param['rel_boolean'] == 'NO' || is_null($param['rel_boolean'])) : ?>
                            <input type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $param['rel_id']; ?>" name="avaliable" />
                            <label for="slideThreeOnOff_<?php echo $param['rel_id']; ?>"></label>
                        <?php else : ?>
                            <input checked type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $param['rel_id']; ?>" name="avaliable" />
                            <label for="slideThreeOnOff_<?php echo $param['rel_id']; ?>"></label>
                        <?php endif; ?>
                    </div>  
                <?php else : ?>
                <select name="value">
                    <option value="NULL">Выберите значение</option>
                </select>
                <?php endif; ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>



$(document).ready(function(){
    
});
    

</script>
