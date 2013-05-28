<?php
    $path = parse_url($_SERVER['REQUEST_URI']);
    $path = $path['path'];
    $path = explode('/', trim($path, '/'));
?>

<li class="main-menu-list-item" id="CurrBlock"
    onmouseover="$('#CurrDrop').show().width($('#CurrBlock').width()-11 + 'px'); $('#CurrLink').addClass('menu-item-drop-hover');"
    onmouseout="$('#CurrDrop').hide(); $('#CurrLink').removeClass('menu-item-drop-hover');">
    <a class="menu-item-drop main-menu-list-item-link image-drop" id="CurrLink"
       style="background:url(/theme/img/currencies/<?php echo $this->current['image']; ?>) left 5px top 10px no-repeat;">
        <span><?php echo $this->current['alias']; ?></span>
    </a>
    <?php if (!empty($this->currencies)) : ?>
        <div class="menu-item-over" id="CurrDrop" style="margin-top:43px;">
            <ul class="menu-item-over-list">
                <?php foreach ($this->currencies as $cur) : ?>
                    <?php if ($cur['alias'] != $this->current['alias']) : ?>
                        <?php
                            $path[1] = strtolower($cur['alias']);
                            $url = '/' . implode('/', $path);
                        ?>
                        <li>
                            <a href="<?php echo $url; ?>" class="menu-item-over-list-item-link  image-drop"
                               style="background:url(/theme/img/currencies/<?php echo $cur['image']; ?>) left 0px top 9px no-repeat;">
                                <span class="menu-item-over-list-item-link-span"><?php echo $cur['alias']; ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <script>
        $('#CurrLink').css({'width': $('#CurrLink').width()+12 + 'px'});
        $('#CurrBlock').css({'width': $('#CurrLink').width()+45 + 'px'});
        $('#CurrBlock').css({'width': $('#CurrBlock').width()-11 + 'px'});
    </script>
</li>
