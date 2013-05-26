<?php
    $path = parse_url($_SERVER['REQUEST_URI']);
    $path = $path['path'];
    $path = explode('/', trim($path, '/'));
?>
<?php if (!empty($this->currencies)) : ?>
<div class="current" style="background: url(/theme/img/currencies/<?php echo $this->current['image']; ?>) top 17px left no-repeat; padding-left:17px;">
    <?php echo $this->current['alias']; ?>
</div>
<ul id="currControl" class="top-menu-plashka">
    <li class="l-current" style="background: url(/theme/img/currencies/<?php echo $this->current['image']; ?>) top 2px left no-repeat; padding-left:17px;"><?php echo $this->current['alias']; ?></li>
    <?php foreach ($this->currencies as $cur) : ?>
        <?php if ($cur['alias'] != $this->current['alias']) : ?>
            <?php
                $path[1] = strtolower($cur['alias']);
                $url = '/' . implode('/', $path);
            ?>
            <li><a style="background: url(/theme/img/currencies/<?php echo $cur['image']; ?>) top 2px left no-repeat; padding-left:17px;" href="<?php echo $url; ?>"><?php echo $cur['alias']; ?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
