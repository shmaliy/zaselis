<h2>Ваши объявления</h2>

<ul class="manage-flats-list cf">
<?php foreach($this->list as $item) : ?>
    <li>
        <div class="flat-top cf">
            <div class="controls cf">
                <a href="<?php echo $this->url(array('tab' => 'first', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
                    <img src="/theme/img/userpanel/icons-30/obschee-16.png" />
                </a>
                <a href="<?php echo $this->url(array('tab' => 'photos', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
                    <img src="/theme/img/userpanel/icons-30/foto-16.png" />
                </a>
                <a href="<?php echo $this->url(array('tab' => 'params-and-beds', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
                    <img src="/theme/img/userpanel/icons-30/udobstva_i_krovati-16.png" />
                </a>
                <a href="<?php echo $this->url(array('tab' => 'prices', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>">
                    <img src="/theme/img/userpanel/icons-30/kalendar_i_tseni-16.png" />
                </a>
            </div>
            <div class="status">
                <label class="checkbox">
                    <input type="checkbox" value="">
                    На сайте
                </label>
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