<?php
function indexSimpleHosting() {
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Simple Hosting index</h2>
             <a href="<?php echo admin_url('admin.php?page=listSimpleHosting'); ?>">Simple Hosting list</a>
    </div>
<?php
}
?>
