<?php
    $path = parse_url($_SERVER['REQUEST_URI']);
    $path = $path['path'];
    $path = explode('/', trim($path, '/'));
?>
<?php if (!empty($this->languages)) : ?>
<li class="main-menu-list-item" 
    id="LangBlock"
    onmouseover="$('#LangDrop').show().width($('#LangBlock').width()-11 + 'px'); $('#LangLink').addClass('menu-item-drop-hover');"
    onmouseout="$('#LangDrop').hide(); $('#LangLink').removeClass('menu-item-drop-hover');">
    
    <a class="menu-item-drop main-menu-list-item-link" id="LangLink">
        <span><?php echo $this->current['title']; ?></span>
    </a>
    <div class="menu-item-over" id="LangDrop">
        <ul class="menu-item-over-list">
            <?php foreach ($this->languages as $lng) : ?>
                <?php if ($lng['alias'] != $this->current['alias']) : ?>
                    <?php
                        $path[0] = $lng['alias'];
                        $url = '/' . implode('/', $path);
                    ?>
                        <li>
                            <a class="menu-item-over-list-item-link" href="<?php echo $url; ?>">
                                <span class="menu-item-over-list-item-link-span">
                                    <?php echo $lng['title']->$lng['alias']; ?>
                                </span>
                            </a>
                        </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <script>
        $('#LangBlock').css({'width': $('#LangDrop').width()+18 + 'px'});
        $('#LangLink').css({'width': $('#LangDrop').width()+7 + 'px'});
        //$('#UserDrop').css({'min-width': $('#UserDrop').width()+20 + 'px'});
    </script>
</li>
<?php endif; ?>
