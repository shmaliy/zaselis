<h2>Календарь и цены</h2>

<div class="calendar-container">
    <h4>Календарь</h4>

    <div id="calendarJQ" class=""></div>
</div>

<script>
    $('#flatCalendar').selectable();
</script>

<div class="prices-container">
    <h4>Цены</h4>
    <div class="main-price form-inline">
        <label class="main-price-label" for="main-price">Основная цена</label>
        
        <span class="value input-append">
            <input type="text" name="main-price" value="" class="span-2" />
            <span class="add-on">$</span>
        </span>
        
        <a class="btn btn-success" id="save-main-price">
            <i class="icon-star icon-white"></i>
            <span>Сохранить цену</span>
        </a>
        
    </div>
    <div class="clean-price form-inline">
        <label class="clean-price-label" for="clean-price">Стоимость уборки</label>
        <span class="value input-append">
            <input type="text" name="clean-price" value="" class="span-2" />
            <span class="add-on">$</span>
        </span>
            
        <a class="btn btn-success" id="save-clean-price">
            <i class="icon-star icon-white"></i>
            <span>Сохранить цену</span>
        </a>
        
    </div>
    <div class="morning-price form-inline">
        <label class="morning-price-label" for="morning-price">Утреннее заселение</label>
        <span class="value input-append">
            <input type="text" name="morning-price" value="" class="span-2" />
            <span class="add-on">$</span>
        </span>
            
        <a class="btn btn-success" id="save-morning-price">
            <i class="icon-star icon-white"></i>
            <span>Сохранить цену</span>
        </a>
        
    </div>
    
    <div class="evening-price form-inline">
        <label class="evening-price-label" for="evening-price">Вечернее заселение</label>
        <span class="value input-append">
            <input type="text" name="evening-price" value="" class="span-2" />
            <span class="add-on">$</span>
        </span>
            
        <a class="btn btn-success" id="save-evening-price">
            <i class="icon-star icon-white"></i>
            <span>Сохранить цену</span>
        </a>
        
    </div>
</div>


<script>



$(document).ready(function(){

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    console.log(d);
    console.log(m);
    console.log(y);
    console.log(date);


    $('#calendarJQ').fullCalendar({
        selectable: true,
        selectHelper: true,
        editable: true,
        header: {
            left: 'prev, today',
            center: 'title',
            right: 'next'
        },
        events: [
            {
                title: 'All Day Event',
                start: new Date(y, m, 1)
            },
            {
                title: 'Long Event',
                start: new Date(y, m, d-5),
                end: new Date(y, m, d-2)
            }
        ]
    });

    $('#save-flats-params-greed').click(function(){
        var greed = $('#ParamsGreed li');
        var post_data = [];
        
        $(greed).each(function(){
            var param_id = $(this).attr('rel');
            var rel_id = $(this).attr('alt') || 'new';
            var value_bool = $(this).find('input:checkbox').is(':checked') || 'NO';
            
            if (value_bool == true) {
                value_bool = 'YES';
            }
            
            var value_text = $(this).find('select').val() || 'NULL';
            
            var row = [param_id, rel_id, value_bool, value_text];
            post_data.push(row);
        });
//        console.log(post_data);
        
        if (post_data.length > 0) {
            megaOverlayShow();
            
            $.ajax({
                url: '<?php echo $this->url(array('id' => $this->id), 'save-flats-params-greed'); ?>',
                data: {greed: post_data},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    updateWindow();
//                    megaOverlayHide();
                },
                complete: function(jqXHR, textStatus) {}
             });
        }
    });
    
     $('#save-flats-beds-greed').click(function(){
        var greed = $('#BedsGreed li');
        var post_data = [];
        
        $(greed).each(function(){
            var rel_id = $(this).attr('rel');
            var bed_id = $(this).attr('alt');
            var flat_id = <?php echo $this->id; ?>;
            var count_beds = $(this).find('input').val() || 0;
            var row = [rel_id, bed_id, flat_id, count_beds];
            post_data.push(row);
        });
//        console.log(post_data);
        
        if (post_data.length > 0) {
            megaOverlayShow();
            
            $.ajax({
                url: '<?php echo $this->url(array('id' => $this->id), 'save-flats-beds-greed'); ?>',
                data: {greed: post_data},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    updateWindow();
//                    megaOverlayHide();
                },
                complete: function(jqXHR, textStatus) {}
             });
        }
     });
});
    

</script>
