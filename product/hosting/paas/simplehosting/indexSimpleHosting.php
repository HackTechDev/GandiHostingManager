<?php
function indexSimpleHosting() {
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Simple Hosting index</h2>
            <a href="<?php echo admin_url('admin.php?page=listSimpleHosting'); ?>">list Simple Hosting</a><br/>
            <br/>
            <a href="<?php echo admin_url('admin.php?page=configSimpleHosting'); ?>">config Simple Hosting</a>

    </div>
<?php
}
?>
