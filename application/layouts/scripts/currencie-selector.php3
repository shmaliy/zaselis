<?php
    $path = parse_url($_SERVER['REQUEST_URI']);
    $path = $path['path'];
    $path = explode('/', trim($path, '/'));
?>
<?php if (!empty($this->languages)) : ?>
<ul>
    <li class="current"><?php echo $this->current['symbol']; ?> <?php echo $this->current['alias']; ?></li>
    <?php foreach ($this->currencies as $cur) : ?>
        <?php if ($cur['alias'] != $this->current['alias']) : ?>
            <?php
                $path[1] = strtolower($cur['alias']);
                $url = '/' . implode('/', $path);
            ?>
            <li><a href="<?php echo $url; ?>"><?php echo $cur['symbol']; ?> <?php echo $cur['alias']; ?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
