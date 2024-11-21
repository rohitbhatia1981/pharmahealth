<?php include "../private/settings.php"; ?>
<!doctype html>

<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Jodit All options</title>
    <link rel="icon" type="image/png" href="<?php echo URL?>editor/examples/assets/icon.png" />
</head>
<body>

<div id="main_container" class="container">
    <div id="introduction">
        <h3>HTML</h3>
      
      
      
    </div>
    <div class="result">
        <textarea id="area_editor"></textarea>
    </div>
</div>

</body>
<link rel="stylesheet" href="<?php echo URL?>editor/build/jodit.min.css"/>
<link rel="stylesheet" href="<?php echo URL?>editor/examples/assets/app.css"/>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,700,700i" rel="stylesheet">

<script src="<?php echo URL?>editor/build/jodit.min.js"></script>
<script src="<?php echo URL?>editor/examples/assets/prism.js"></script>
<script src="<?php echo URL?>editor/examples/assets/app.js"></script>
<script>
    var editor = new Jodit('#area_editor', {
        textIcons: false,
        iframe: false,
        iframeStyle: '*,.jodit_wysiwyg {color:red;}',
        height: 300,
        defaultMode: Jodit.MODE_WYSIWYG,
        observer: {
            timeout: 100
        },
        uploader: {
            url: 'https://xdsoft.net/jodit/connector/index.php?action=fileUpload'
        },
        filebrowser: {
            // buttons: ['list', 'tiles', 'sort'],
            ajax: {
                url: 'https://xdsoft.net/jodit/connector/index.php'
            }
        },
        commandToHotkeys: {
            'openreplacedialog': 'ctrl+p'
        }
        // buttons: ['symbol'],
        // disablePlugins: 'hotkeys,mobile'
    });
</script>
</html>
