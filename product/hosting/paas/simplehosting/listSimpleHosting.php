<?php
function listSimpleHosting() {
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Simple Hosting list</h2>
            <a href="<?php echo admin_url('admin.php?page=createSimpleHosting'); ?>">Add a Simple Hosting</a>
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
        echo "<td>";
        echo "<a href='".admin_url('admin.php?page=updateSimpleHosting&id=' . $row->id)."'>Update</a> | ";
        echo "<a href='".admin_url('admin.php?page=viewSimpleHosting&id=' . $row->id)."'>View</a>";
        echo "</td>";
        echo "</tr>";}
    echo "</table>";
    ?>
    </div>
<?php
}
?>
