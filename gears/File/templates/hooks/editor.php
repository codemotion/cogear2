<p>
    <a class="btn" id="upload-button">
        <?php echo icon('upload') . ' ' . t("Загрузить изображение"); ?>
    </a></p>
<script>
    $('#upload-button').uploader({
        url: '<?php echo l('/files/upload/editor/image') ?>',
        drop_element: $('[name=body]').attr('id'),
        uploadProgress: function(file){
            cogear.ajax.loader.type('blue-dots').after($('#upload-button')).show();
        },
        onComplete: function(data){
            if(data.code){
                $el = $('[name=body]');
                if($el.redactor){
                  $el.insertHtml("<p align=\"center\">" + data.code + "</p>")
                }
                else {
                    $el.val($el.val() + "\n<p align=\"center\">" + data.code + "</p>\n");
                }
            }
            cogear.ajax.loader.hide();
        }
    });
</script>
<style>
    textarea.dragover{
        border: 1px dashed #CCC;
        background: #F1F1F1;
    }
    .ajax-loader.blue-dots{
        margin: 9px 3px;
        vertical-align: middle;
    }
</style>