<?php
function indexGandiServer() {
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Gandi Server index</h2>
            <a href="<?php echo admin_url('admin.php?page=listGandiServer'); ?>">list Gandi Server</a><br/>
            <br/>
            <a href="<?php echo admin_url('admin.php?page=configGandiServer'); ?>">config Gandi Server</a>

    </div>
<?php
}
?>
