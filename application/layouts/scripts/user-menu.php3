<div id="userpanel-accordion">
    <h3>Инфо</h3>
    <div>
        <p>
        Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
        ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
        amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
        odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
        </p>
    </div>
    <h3>Друзья</h3>
    <div>
        <p>
        Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
        ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
        amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
        odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
        </p>
    </div>
    <h3>Профиль</h3>
    <div>
        <ul class="vertical-menu">
            <li class="vertical-menu-item"><a href="<?php echo $this->url(array(), 'user-profile'); ?>" class="vertical-menu-link"><span>Редактирование личной информации</span></a></li>            
            <li class="vertical-menu-item"><a href="<?php echo $this->url(array(), 'user-contacts'); ?>" class="vertical-menu-link"><span>Телефоны</span></a></li>
            <li class="vertical-menu-item"><a href="#" class="vertical-menu-link"><span>Социальные сети</span></a></li>
            <li class="vertical-menu-item"><a href="#" class="vertical-menu-link"><span>Настройка оповещений</span></a></li>            
            <li class="vertical-menu-item"><a href="#" class="vertical-menu-link"><span>Методы выплаты</span></a></li>            
            <li class="vertical-menu-item"><a href="#" class="vertical-menu-link"><span>История платежей</span></a></li>            
            <li class="vertical-menu-item"><a href="#" class="vertical-menu-link"><span>Пригласить друзей</span></a></li>            
        </ul>
    </div>
    <h3>Почтовый ящик</h3>
    <div>
        <p>
        Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
        purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
        velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
        suscipit faucibus urna.
        </p>
    </div>
    <h3>Ваши объявления</h3>
    <div>
        <p>
        Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
        Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
        ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
        lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
        </p>
        <ul>
            <li>List item one</li>
            <li>List item two</li>
            <li>List item three</li>
        </ul>
    </div>
    <h3>Поездки</h3>
    <div>
        <p>
        Cras dictum. Pellentesque habitant morbi tristique senectus et netus
        et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
        faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
        mauris vel est.
        </p>
        <p>
        Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
        inceptos himenaeos.
        </p>
    </div>
    <h3>Настройки аккаунта</h3>
    <div>
        <p>
        Cras dictum. Pellentesque habitant morbi tristique senectus et netus
        et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
        faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
        mauris vel est.
        </p>
        <p>
        Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
        inceptos himenaeos.
        </p>
    </div>
    <h3>Смена пароля</h3>
    <div>
        <?php echo $this->Common()->changePassword(); ?>
    </div>
    <?php if ($this->user['z_users_roles_id'] == 1) : ?>
        <h3>Управление сайтом</h3>
        <div>
            <p>
            Cras dictum. Pellentesque habitant morbi tristique senectus et netus
            et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
            faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
            mauris vel est.
            </p>
            <p>
            Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
            inceptos himenaeos.
            </p>
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