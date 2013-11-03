<?php
    $menuContainer = array(
        'mainpage' => array(
            'title' => 'Главная страница',
            'url' => '/ru/uah/user',
            'innerHtml' => ''
        ),

        'friends' => array(
            'title' => 'Друзья',
            'url' => '/ru/uah/user/friends',
            'innerHtml' => ''
        ),

        'profile' => array(
            'title' => 'Профиль',
            'url' => '/ru/uah/user/profile',
            'innerHtml' => $this->action('profile-inner-html', 'manage', 'user')
        ),

        'ads' => array(
            'title' => 'Ваши объявления',
            'url' => '/ru/uah/user/flats',
            'innerHtml' => $this->action('ads-inner-html', 'manage', 'flats')
        ),

        'trips' => array(
            'title' => 'Поездки',
            'url' => '/ru/uah/user/trips',
            'innerHtml' => ''
        ),

        'chpassword' => array(
            'title' => 'Смена пароля',
            'url' => '/ru/uah/user/chpassword',
            'innerHtml' => ''
        ),

        'messages' => array(
            'title' => 'Сообщения',
            'url' => '/ru/uah/user/messages',
            'innerHtml' => $this->action('messages-inner-html', 'manage', 'user')
        ),

        'accsettings' => array(
            'title' => 'Настройка аккаунта',
            'url' => '/ru/uah/user/accsettings',
            'innerHtml' => ''
        ),

        'sitemanage' => array(
            'title' => 'Управление сайтом',
            'url' => '/ru/uah/user/sitemanage',
            'innerHtml' => ''
        ),
    );

    $current = parse_url($_SERVER['REQUEST_URI']);
    $current = $current['path'];
?>

<ul class="left-menu" id="left-menu">
    <?php foreach ($menuContainer as $alias=>$item) : ?>
        <li class="<?php echo (strstr($current, $item['url'])) ? 'expanded' : 'collapsed'; ?>">
            <a href="<?php echo $item['url']; ?>" class="main cf">
                <i class="micon micon-<?php echo $alias; ?>"></i>
                <div><?php echo $item['title']; ?></div>
                <i class="marrow"></i>
            </a>
            <?php if (!empty($item['innerHtml'])) : ?>
            <div class="inner">
                <?php echo $item['innerHtml']; ?>
            </div>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<script>
    $(document).ready(function(){
        $('#left-menu li').each(function(){
            $(this).find('.inner li a').each(function(){
                if ($(this).hasClass('active')) {
                    $(this).find('i.last').addClass('icon-tag');
                    $(this).closest('.collapsed').removeClass('collapsed').addClass('expanded');

                }
            });
        });

        var expanded = $('#left-menu .expanded');

        var i = 1;

        $(expanded).each(function(){
            if (i < expanded.length) {
                $(this).removeClass('expanded').addClass('collapsed');
                i++;
            }
        });

    });
</script>
