<?php
function indexHosting() {
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Simple Hosting index</h2>
            <br/>
            Gandi API version : <b><?php echo getAPIInfo(); ?></b> <br/>
            <br/>
            <a href="<?php echo admin_url('admin.php?page=listSimpleHosting'); ?>">Simple Hosting list</a><br/>
            <br/>
            <a href="<?php echo admin_url('admin.php?page=configSimpleHosting'); ?>">Simple Hosting configuration</a>
            <br/>
    <h2>Gandi Server index</h2>

    </div>
<?php
}
?>
