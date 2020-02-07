<?php
echo \dastanaron\dropzone\DropZoneWidget::widget([
        'id' => 'myDropZone', // ID on the div element
        'options'=> [
            'url' => 'branches/upload', //Where to send a request to save the file
            'maxFiles' => 1, //The maximum number of files
            'acceptedFiles' => 'image/*', // MIME - file types
        ],
        'events' => [
            'success' => 'function(event, response) {
                console.log("success")
                $("input#inputid").val(response.id);
            }',
        ],
]);
?>