<div class="world-container clearfix">
    <div id="world-list"></div>
    <div id="map-canvas"></div>
</div>

<script>
    $(document).ready( function(){

        var htmlheight = $('html').height();
        var hrheight = $('.world-link').height();

        $('#map-canvas').css({height: htmlheight - hrheight + 'px'});
        $('#world-list').css({height: htmlheight - hrheight + 'px'});

        var map;
        function initialize() {
            var mapOptions = {
                zoom: 13,
                center: new google.maps.LatLng(<?php echo Zend_Registry::get('lat'); ?>, <?php echo Zend_Registry::get('lng'); ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
              
            var image = '/theme/img/map/flags/flag.png';
            
            <?php foreach ($this->list as $item) : ?>
                var myLatlng_<?php echo $item['z_flats_id']; ?> = new google.maps.LatLng(<?php echo $item['latitude']; ?>, <?php echo $item['longitude']; ?>);
                <?php 
//                    $text = nl2br($item['main_description']);
//                    $text = str_replace('\n\r', "", $text);
//                    $text = str_replace('\r', "", $text);
//                    $text = str_replace("\r\n",'',$text);
//                    $text = str_replace("\n",'',$text);
                    $text = str_replace(PHP_EOL,'',$text);
               
                    $fulltext = '<strong>' . $item['district_description'] . '</strong><br /><br />' . $text;
                ?>
                            
                var contentString_<?php echo $item['z_flats_id']; ?> = '<?php echo $fulltext; ?>';

                var infowindow_<?php echo $item['z_flats_id']; ?> = new google.maps.InfoWindow({
                    content: contentString_<?php echo $item['z_flats_id']; ?>
                });

                var marker_<?php echo $item['z_flats_id']; ?> = new google.maps.Marker({
                    position: myLatlng_<?php echo $item['z_flats_id']; ?>,
                    map: map,
                    title: '<?php echo $item['district_description']; ?>',
                    image: image
                });
                google.maps.event.addListener(marker_<?php echo $item['z_flats_id']; ?>, 'click', function() {
                  infowindow_<?php echo $item['z_flats_id']; ?>.open(map,marker_<?php echo $item['z_flats_id']; ?>);
                });

                
                
                
            <?php endforeach; ?>

        }

        google.maps.event.addDomListener(window, 'load', initialize);
    });

</script>