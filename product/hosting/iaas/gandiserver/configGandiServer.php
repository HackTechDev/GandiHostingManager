<?php
function configGandiServer() {
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Gandi Server configuration</h2>
        <?php
            print_r(iaasImageList());
        ?>
    </div>
<?php
}
?>
