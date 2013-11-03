<?php
$inner = array(
    array(
        'title' => 'Входящие',
        'url'   => '#',
    ),
    array(
        'title' => 'Отправленные',
        'url'   => '#',
    ),
    array(
        'title' => 'Спам',
        'url'   => '#',
    )
);

echo $this->Common()->userLeftInnerHtml($inner);
?>