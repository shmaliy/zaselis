<h2>Ваши объявления</h2>

<ul class="manage-flats-list cf">
<?php foreach($this->list as $item) : ?>
    <li>
        <div class="flat-top cf">
            <div class="controls cf">
                <a title="Редактирование общей информации" href="<?php echo $this->url(array('tab' => 'first', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
                    <img src="/theme/img/userpanel/icons-30/obschee-16.png" />
                </a>
                <a title="Редактирование фотографий" href="<?php echo $this->url(array('tab' => 'photos', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
                    <img src="/theme/img/userpanel/icons-30/foto-16.png" />
                </a>
                <a title="Настройка удобств и кроватей" href="<?php echo $this->url(array('tab' => 'params-and-beds', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
                    <img src="/theme/img/userpanel/icons-30/udobstva_i_krovati-16.png" />
                </a>
                <a title="Календарь и цены" href="<?php echo $this->url(array('tab' => 'prices', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
                    <img src="/theme/img/userpanel/icons-30/kalendar_i_tseni-16.png" />
                </a>
            </div>
            <div class="status">
                <div class="slideTwo <?php echo ($item['published'] != 1) ? 'publish' : ''; ?>"
                     title="<?php echo ($item['published'] == 1) ? 'Вашу квартиру видят посетители сайта' : 'Срок оплаченой публикации вашей квартиры истек. Нажмите на индикатор для оплаты публикации'; ?>"
                     rel="<?php echo $item['z_flats_id']; ?>">
                    <input type="checkbox"
                           disabled
                           value="None"
                           id="slideTwo_<?php echo $item['z_flats_id']; ?>"
                           name="check"
                           <?php echo ($item['published'] == 1) ? 'checked' : ''; ?>
                    />
                    <label for="slideTwo_<?php echo $item['z_flats_id']; ?>"></label>
                </div>
            </div>
        </div>

        <a class="item-image" href="<?php echo $this->url(array('tab' => 'first', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
            <?php if ($item['avatar'] != '') : ?>
            <img src="<?php echo $item['avatar'] ?>" />
            <?php else : ?>
            <img src="/theme/img/userpanel/icons-310-207/no-flat-image.png" />
            <?php endif; ?>
        </a>
        <a class="item-text" href="<?php echo $this->url(array('tab' => 'first', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
            <?php echo $item['district_description']; ?>
        </a>
        <div class="item-adress">
            <?php echo $item['adress']; ?>
        </div>
        
        <div class="item-guests">
            Гостей <?php echo $item['guests_count']; ?>
        </div>
    </li>
    
<?php endforeach; ?>
</ul>

<script>
    $(document).ready(function(){

        $('.publish').each(function(){
            $(this).css({cursor:'pointer'});
            $(this).click(function(){
                var flatId = $(this).attr('rel');
                console.log(flatId);
            });
        });

        $(document).tooltip();
        var max = 0;
        $('.manage-flats-list li').each(function(){
            if ($(this).height() > max) {
                max = $(this).height();
            }
        });

        $('.manage-flats-list li').each(function(){
            $(this).css({height: max});
        });
    });
</script>