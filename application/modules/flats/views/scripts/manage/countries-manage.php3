<h2>Настройка цен и тел. кодов для стран</h2>

<button class="save-greed btn btn-success"><i class="icon icon-white icon-ok"></i> Сохранить изменения</button>
<table class="table top-30">
    <thead>
        <th>Название</th>
        <th>Тел. код</th>
        <th>Цена</th>
        <th>Активна</th>
    </thead>
    <?php foreach ($this->list as $row) : ?>
    <tr rel="<?php echo $row['z_countries_id']; ?>"
        class="greed-row
        <?php echo ($row['avaliable'] != 'YES') ? 'unavaliable' : ''; ?>
        <?php echo ($row['day_price'] > 0) ? 'priced' : ''; ?> "
        >
        <td>
            <a title="Редактировать список городов" href="<?php echo $this->url(array('country' => $row['z_countries_id']), 'towns-manage'); ?>">
                <i class="icon icon-th-list"></i>
            </a>
            <?php echo $row['title']; ?>
        </td>
        <td>
            <div class="input-prepend code">
                <span class="add-on"> + </span>
                <input class="span4 code" rel="<?php echo $row['codes_id']; ?>" type="text" value="<?php echo $row['codes_code']; ?>">
            </div>
        </td>
        <td>
            <div class="input-append ">
                <input class="span4 day-price" type="text" value="<?php echo $row['day_price']; ?>">
                <span class="add-on"> $/день </span>
            </div>
        </td>
        <td>
            <div class="slideTwo aval">
                <input type="checkbox"
                       value="None"
                       id="slideTwo_<?php echo $row['z_countries_id']; ?>"
                       name="check"
                       <?php echo ($row['avaliable'] == 'YES') ? 'checked' : ''; ?>
                    />
                <label for="slideTwo_<?php echo $row['z_countries_id']; ?>"></label>
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
                var countryId = $(this).attr('rel');
                var dayPrice = $(this).find('.day-price').val() || 0;
                var aval = 'NO';
                var aval_field = $(this).find('.aval input');
                var codeId = $(this).find('.code input').attr('rel');
                var codeVal = $(this).find('.code input').val();

                if ($(aval_field).is(':checked')) {
                    aval = 'YES';
                }

                var data_row = {
                    z_countries_id: countryId,
                    day_price: dayPrice,
                    avaliable: aval,
                    z_phone_codes_id: codeId,
                    code: codeVal
                };
                data_greed.push(data_row);
            });

            if (data_greed.length > 0) {
                megaOverlayShow();
                $.ajax({
                    url: '<?php echo $this->url(array(), 'countries-manage'); ?>',
                    data: {greed: data_greed},
                    type: 'POST',
                    error: function(jqXHR, textStatus, errorThrown) {},
                    success: function(data, textStatus, jqXHR) {
                        updateWindow();

                    },
                    complete: function(jqXHR, textStatus) {}
                });
            }
            //console.log(data_greed);
        });
    });
});
</script>
