<div class="footer">

</div>
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

</body>
</html>