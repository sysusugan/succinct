<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>留言板</title>
    <link rel="stylesheet" type="text/css" href="static/images/main.css">
    <script src="./static/sea-modules/seajs/seajs/2.1.1/sea.js"></script>
    <script>

        // Set configuration
        seajs.config({
            base: "./static/sea-modules/",
            alias: {
                "jquery": "jquery/jquery/1.10.1/jquery.js"
            }
        });

        // For production
        seajs.use("msg/main");

    </script>

</head>

<body>