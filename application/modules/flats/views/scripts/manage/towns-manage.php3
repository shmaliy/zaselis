<h2>Настройка цен и активности для городов страны <?php echo $this->country['title']; ?></h2>

<a class="btn btn-info" href="<?php echo $this->url(array(), 'countries-manage'); ?>">
    <i class="icon icon-arrow-left icon-white" ></i> Список стран</a>

<button class="save-greed btn btn-success"><i class="icon icon-white icon-ok"></i> Сохранить изменения</button>
<table class="table table-striped top-30">
    <thead>
    <th>Название</th>
    <th>Цена</th>
    <th>Активен</th>
    </thead>
    <?php foreach ($this->towns as $row) : ?>
    <tr class="greed-row" rel="<?php echo $row['z_towns_id']; ?>">
        <td><?php echo $row['title']; ?></td>
        <td class="price">
            <div class="input-prepend input-append">
                <span class="add-on">
                    <?php echo $this->country['day_price']; ?> $
                    <i class="icon <?php echo ($row['day_price'] != 0) ? 'icon-arrow-right' : 'icon-arrow-left'; ?>"></i>
                </span>
                <input class="span3 day-price" type="text" value="<?php echo $row['day_price']; ?>">
                <span class="add-on"> $ / день </span>
            </div>
        </td>
        <td>
            <div class="slideTwo aval">
                <input type="checkbox"
                       value="None"
                       id="slideTwo_<?php echo $row['z_towns_id']; ?>"
                       name="check"
                    <?php echo ($row['avaliable'] == 'YES') ? 'checked' : ''; ?>
                    />
                <label for="slideTwo_<?php echo $row['z_towns_id']; ?>"></label>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<button class="save-greed btn btn-success"><i class="icon icon-white icon-ok"></i> Сохранить изменения</button>

<script>
    $(document).ready(function(){
        $('.save-greed').each(function(){
            $(this).click(function(){
                var greed = $('.greed-row');
                var data_greed = [];

                $(greed).each(function(){
                    var townId = $(this).attr('rel');
                    var dayPrice = $(this).find('.day-price').val() || 0;
                    var aval = 'NO';
                    var aval_field = $(this).find('.aval input');

                    if ($(aval_field).is(':checked')) {
                        aval = 'YES';
                    }

                    var data_row = {
                        z_towns_id: townId,
                        day_price: dayPrice,
                        avaliable: aval
                    };
                    data_greed.push(data_row);
                });
                //console.log(data_greed);
                if (data_greed.length > 0) {
                    megaOverlayShow();
                    $.ajax({
                        url: '<?php echo $this->url(array(), 'towns-manage'); ?>',
                        data: {greed: data_greed},
                        type: 'POST',
                        error: function(jqXHR, textStatus, errorThrown) {},
                        success: function(data, textStatus, jqXHR) {
                            updateWindow();

                        },
                        complete: function(jqXHR, textStatus) {}
                    });
                }

            });
        });
    });
</script>