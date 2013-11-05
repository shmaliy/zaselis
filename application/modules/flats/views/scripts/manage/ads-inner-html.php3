<?php

$inner = array(
    array(
        'title' => 'Список квартир',
        'url'   => $this->url(array(), 'flat-list'),
    ),
    array(
        'title' => 'Добавить квартиру',
        'url'   => $this->url(array('id' => 'new'), 'flat-edit'),
    ),
    array(
        'title' => 'Избранное',
        'url'   => '#',
    )
);



if ($this->user['z_users_roles_id'] == 1) {
    $inner[] = array(
        'title' => '&#9733; Настройка удобств',
        'url'   => $this->url(array(), 'parameters-edit')
    );

    $inner[] = array(
        'title' => '&#9733; Настройка кроватей',
        'url'   => $this->url(array(), 'beds')
    );

    $inner[] = array(
        'title' => '&#9733; География',
        'url'   => $this->url(array(), 'countries-manage')
    );
}


echo $this->Common()->userLeftInnerHtml($inner);
?>