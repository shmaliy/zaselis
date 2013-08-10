<h2>Добавление/редактирование объявления</h2>

<?php $tabs = array(
    'first' => 0,
    'photos' => 1,
    'params-and-beds' => 2,
    'fourth' => 3,
    'fivth' => 4,
); ?>
<div id="tabs">
    <ul>
        <li><a href="#EditFirstTabTab">Общая информация</a></li>
        <?php if ($this->id != 'new') : ?>
        <li><a href="#photos">Фотографии</a></li>
        <li><a href="#params-and-beds">Удобства и кровати</a></li>
        <li><a href="#tabs-4">Календарь и цены</a></li>
        <?php endif; ?>
    </ul>
    <div id="EditFirstTabTab">
        <p>
            <?php echo $this->action('edit-first-tab', 'manage', 'flats', array('id' => $this->id)); ?>
        </p>
    </div>
    <?php if ($this->id != 'new') : ?>
    <div id="photos">
        <p><?php echo $this->action('edit-photos', 'manage', 'flats', array('id' => $this->id)); ?></p>
    </div>
    <div id="params-and-beds">
        <p><?php echo $this->action('edit-params-and-beds', 'manage', 'flats', array('id' => $this->id)); ?></p>
    </div>
    <div id="tabs-4">
        <p></p>
    </div>
    
    <?php endif; ?>
</div>

<script>

$(document).ready(function () {
    $( "#tabs" ).tabs({
        collapsible: true,
        active: <?php echo $tabs[$this->tab]; ?>
    });
});

</script>