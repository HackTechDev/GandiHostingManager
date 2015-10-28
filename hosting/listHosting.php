<?php
function listHosting() {
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Hosting</h2>
            <a href="<?php echo admin_url('admin.php?page=createHosting'); ?>">Add a hosting</a>
    <?php
    global $wpdb;
    $rows = $wpdb->get_results("SELECT id, instance, description from wp_gandihosting");
    echo "<table class='wp-list-table widefat fixed'>";
    echo "<tr><th><b>Id</b></th><th><b>Instance</b></th><th><b>Description</b></th><th><b>Action</b></th></tr>";
    foreach ($rows as $row ){
        echo "<tr>";
        echo "<td>$row->id</td>";
        echo "<td>$row->instance</td>";	
        echo "<td>$row->description</td>"; 
        echo "<td><a href='".admin_url('admin.php?page=updateHosting&id=' . $row->id)."'>Update</a></td>";
        echo "</tr>";}
    echo "</table>";
    ?>
    </div>
<?php
}
?>
