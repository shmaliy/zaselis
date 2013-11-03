<?php
$current = parse_url($_SERVER['REQUEST_URI']);
$current = 'https://' . $_SERVER['HTTP_HOST'] . $current['path'];
?>
<ul class="left-inner-submenu">
    <?php foreach ($this->container as $item) : ?>
        <li>
            <a class="<?php echo ($current == $item['url']) ? 'active' : ''; ?>" href="<?php echo $item['url']; ?>">
                <i class="icon first"></i>
                <?php echo $item['title']; ?>
                <i class="icon last"></i>
            </a>
        </li>
    <?php endforeach; ?>
</ul>