<?php
$inner = array(
    array(
        'title' => 'Телефоны',
        'url'   => $this->url(array(), 'user-contacts'),
    ),
    array(
        'title' => 'Социальные сети',
        'url'   => $this->url(array(), 'user-social-networks'),
    ),
    array(
        'title' => 'Настройка оповещений',
        'url'   => '#',
    ),
    array(
        'title' => 'Методы выплаты',
        'url'   => $this->url(array(), 'paydata'),
    ),
    array(
        'title' => 'История платежей',
        'url'   => '#',
    ),
    array(
        'title' => 'Пригласить друзей',
        'url'   => '#',
    )
);

echo $this->Common()->userLeftInnerHtml($inner);
?>