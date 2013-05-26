<?php
    $path = parse_url($_SERVER['REQUEST_URI']);
    $path = $path['path'];
    $path = explode('/', trim($path, '/'));
?>
<?php if (!empty($this->languages)) : ?>
<div class="current">
    <?php echo $this->current['title']; ?>
</div>
<ul id="langControl">
    <li class="l-current"><?php echo $this->current['title']; ?></li>
    <?php foreach ($this->languages as $lng) : ?>
        <?php if ($lng['alias'] != $this->current['alias']) : ?>
            <?php
                $path[0] = $lng['alias'];
                $url = '/' . implode('/', $path);
            ?>
            <li><a href="<?php echo $url; ?>"><?php echo $lng['title']->$lng['alias']; ?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
