<h2>Добавление/редактирование параметров квартиры</h2>
<style>
    .slideThreeType:after {
	content: 'Да / Нет';
	color: #000;
    }

    .slideThreeType:before {
        content: 'Список';
        color: green;
    }
    
    .slideThreeOnOff:after {
	content: 'Off';
	color: #000;
    }

    .slideThreeOnOff:before {
        content: 'On';
        color: green;
    }
</style>
<form id="CreateParameter"  action="" method="post" enctype="application/x-www-form-urlencoded">
    <div class="param-container cf">
        <div class="legend">Новый параметр</div>
        <div class="text">Редактирование иконки, а так же списка значений будет доступно после сохранения.</div>
        <div class="title"><input type="text" name="title" placeholder="название"></div>
        <div class="description">
            <textarea name="description" placeholder="описание"></textarea>
        </div>
        <div class="type-legend">Тип параметра</div>
        <div class="type">
            <div class="slideThreeType">	
                <input type="checkbox" value="None" id="slideThree" name="type" />
                <label for="slideThree"></label>
            </div>            
        </div>
        <div class="save">
            <input type="submit" class="form-save-button" value="Сохранить">
        </div>
    </div>
</form>

<script>
    $('#CreateParameter').submit(function(){
        processUserForm(
            'create-parameter', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#CreateParameter',
            [['updateWindow']]
        );
        return false;
    });
    

</script>

<form id="EditParameters" action="" method="post" enctype="application/x-www-form-urlencoded">
    <ul id="params-container" class="params-edit-table">
        <li class="param-header cf">
            <div class="icon">Иконка</div>
            <div class="title">Название</div>
            <div class="description">Описание</div>
            <div class="type">Тип</div>
            <div class="avaliable">Виден на сайте</div>
            <div class="del">Удалить</div>
        </li>
        <?php if (!empty($this->list)) : ?>
        
            <?php foreach ($this->list as $item) : ?>
                <li class="param cf" rel="<?php echo $item['z_flats_params_id']; ?>">
                    <div class="icon"></div>
                    <div class="title"><input type="text" name="title" placeholder="название" value="<?php echo $item['title']; ?>"></div>
                    <div class="description">
                        <textarea name="description"><?php echo $item['description']; ?></textarea>
                    </div>
                    <div class="type">
                        <div class="slideThreeType">
                            <?php if($item['type'] == 'BOOLEAN') : ?>
                                <input type="checkbox" value="None" id="slideThree_<?php echo $item['z_flats_params_id']; ?>" name="type" />
                                <label for="slideThree_<?php echo $item['z_flats_params_id']; ?>"></label>
                            <?php else : ?>
                                <input checked type="checkbox" value="None" id="slideThree_<?php echo $item['z_flats_params_id']; ?>" name="type" />
                                <label for="slideThree_<?php echo $item['z_flats_params_id']; ?>"></label>
                            <?php endif; ?>
                        </div>  
                        <?php if($item['type'] !== 'BOOLEAN') : ?>
                        <a href="#">Список значений</a>
                        <?php endif; ?>
                    </div>
                    <div class="avaliable">
                        <div class="slideThreeOnOff">
                            <?php if($item['avaliable'] == 'NO') : ?>
                                <input type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>" name="avaliable" />
                                <label for="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>"></label>
                            <?php else : ?>
                                <input checked type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>" name="avaliable" />
                                <label for="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>"></label>
                            <?php endif; ?>
                        </div>  
                    </div>
                    <div class="del"></div>
                </li>
            <?php endforeach; ?>
        
        <?php endif; ?>
    </ul>
    
</form>
