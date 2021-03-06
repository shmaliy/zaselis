<link rel="stylesheet" href="/js/jquery/jQuery-File-Upload-master/css/style.css">
<link rel="stylesheet" href="/js/jquery/jQuery-File-Upload-master/css/jquery.fileupload-ui.css">
<div class="container">
    
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="icon-plus icon-white"></i>
        <span>Add files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress progress-success progress-striped">
        <div class="bar"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files"></div>
</div>
<script src="/js/jquery/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="/js/jquery/jQuery-File-Upload-master/proprietar/load-image.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="/js/jquery/jQuery-File-Upload-master/proprietar/canvas-to-blob.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/js/jquery/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image resize plugin -->
<script src="/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-resize.js"></script>
<!-- The File Upload validation plugin -->
<script src="/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-validate.js"></script>
<script>
/*jslint unparam: true */
/*global window, $ */

var timer = 0;

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '/js/jquery/jQuery-File-Upload-master/server/php/',
        uploadButton = $('<button/>')
            .addClass('btn')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    var i = 0;       
    var k = 0;
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        loadImageMaxFileSize: 15000000, // 15MB
        disableImageResize: false,
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        
        $.each(data.files, function (index, file) {
            if (i == 0) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
            }
            i++;
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append(file.error);
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        
        var res = {};
        $.each(data.result.files, function (index, file) {
            var link = $('<a>')
                .attr('target', '_blank')
                .prop('href', file.url);
            $(data.context.children()[index])
                .wrap(link);
            res = file['url'];

        });
        clearInterval(timer);
        timer = setTimeout(function(){
            megaOverlayShow();
            $.ajax({
                url: '<?php echo $this->url(array(), 'ajax-avatar'); ?>',
                data: {file: res},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    updateWindow(); 
                },
                complete: function(jqXHR, textStatus) {}
             });
        }, 1000);
        
        
    }).on('fileuploadfail', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var error = $('<span/>').text(file.error);
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    });
});
</script>
