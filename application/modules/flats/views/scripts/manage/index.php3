<h2>Ваши объявления</h2>
<?php foreach($this->list as $item) : ?>
<a href="<?php echo $this->url(array('tab' => 'first', 'id' => $item['z_flats_id']), 'flat-edit-tab'); ?>"><?php echo $item['district_description']; ?></a><br />
<?php endforeach; ?>
