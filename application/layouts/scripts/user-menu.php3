<?php 

function checkActive($url) 
{
    $path = parse_url($url);
    $current = parse_url($_SERVER['REQUEST_URI']);
    
    if ($path['path'] == $current['path']) {
        return 'active';
    } else return '';
}

function publicateMenuItem($menu, $alias)
{
    if (isset($menu[$alias])) {
        ?>
        <ul class="vertical-menu">
            <?php foreach ($menu[$alias] as $item) : ?>
             <li class="vertical-menu-item">
                <a href="<?php echo $item['url']; ?>" 
                   class="vertical-menu-link <?php echo $item['active']; ?>">
                    <span><?php echo $item['title']; ?></span>
                </a>
            </li>    
            <?php endforeach; ?>
        </ul>
        <?php
    }
}


$menu = array(
    'info' => array(
        array(
            'title' => 'Главная страница пользователя',
            'url'   => $this->url(array(), 'user-index'),
            'active' => checkActive($this->url(array(), 'user-index'))
        )
    ),
    
    'friends' => array(),
    
    'profile' => array(
        array(
            'title' => 'Редактирование личной информации',
            'url'   => $this->url(array(), 'user-profile'),
            'active' => checkActive($this->url(array(), 'user-profile'))
        ),
        array(
            'title' => 'Телефоны',
            'url'   => $this->url(array(), 'user-contacts'),
            'active' => checkActive($this->url(array(), 'user-contacts'))
        ),
        array(
            'title' => 'Социальные сети',
            'url'   => $this->url(array(), 'user-social-networks'),
            'active' => checkActive($this->url(array(), 'user-social-networks'))
        ),
        array(
            'title' => 'Настройка оповещений',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'Методы выплаты',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'История платежей',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'Пригласить друзей',
            'url'   => '#',
            'active' => checkActive('#')
        ),
    ),
    
    'mail' => array(
        array(
            'title' => 'Входящие',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'Отправленные',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'Спам',
            'url'   => '#',
            'active' => checkActive('#')
        )
    ),
    
    'flats' => array(
        array(
            'title' => 'Список квартир',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'Добавить квартиру',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'Избранное',
            'url'   => '#',
            'active' => checkActive('#')
        )
    ),
    
    'travels' => array(
        array(
            'title' => 'Предстоящие поездки',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'На рассмотрении',
            'url'   => '#',
            'active' => checkActive('#')
        ),
        array(
            'title' => 'Архив',
            'url'   => '#',
            'active' => checkActive('#')
        )
    ),
    
);
?>

<div id="userpanel-accordion">
    <h3>Инфо</h3>
    <div>
        <?php echo $this->action('avatar', 'manage', 'user'); ?>
        <?php publicateMenuItem($menu, 'info'); ?>
    </div>
    <h3>Друзья</h3>
    <div><?php publicateMenuItem($menu, 'friends'); ?></div>
    <h3>Профиль</h3>
    <div>
        <?php publicateMenuItem($menu, 'profile'); ?>
    </div>
    <h3>Почтовый ящик</h3>
    <div>
        <?php publicateMenuItem($menu, 'mail'); ?>
    </div>
    <h3>Ваши объявления</h3>
    <div>
        <?php publicateMenuItem($menu, 'flats'); ?>
    </div>
    <h3>Поездки</h3>
    <div>
        <?php publicateMenuItem($menu, 'travels'); ?>
    </div>
    <h3>Настройки аккаунта</h3>
    <div>
        
    </div>
    <h3>Смена пароля</h3>
    <div>
        <?php echo $this->Common()->changePassword(); ?>
    </div>
    <?php if ($this->user['z_users_roles_id'] == 1) : ?>
        <h3>Управление сайтом</h3>
        <div>
            
        </div>
    <?php endif; ?>
</div>
<?php 
    $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    $position = (!isset($url[3])) ? 'none' : $url[3];
    
    $tabs = array(
        'none' => 0,
        'friends' => 1,
        'profile' => 2,
        'mail'  => 3,
        'flats' => 4,
        'travels' => 5,
        'settings' => 6
    );
    
    $active = (isset($tabs[$position])) ? $tabs[$position] : 0; 
?>
 <script>
    $(function() {
        $( "#userpanel-accordion" ).accordion({
            heightStyle: "content",
            active: <?php echo $active; ?>
        });
    });
</script>