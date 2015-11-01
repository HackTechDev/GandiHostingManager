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
    
    <?php

echo "<table border=1>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Console</th>";
echo "<th>Date end</th>";
echo "<th>Catalog name</th>";
echo "<th>Servers</th>";
echo "<th>Datacenter id</th>";
echo "<th>State</th>";
echo "<th>Need upgrade</th>";
echo "<th>Snapshot profile</th>";
echo "<th>id</th>";
echo "<th>Size</th>";
echo "<th>Type</th>";
echo "<th>Date disk additional size</th>";
echo "<th>Date end commitment</th>";
echo "<th>Action</th>";
echo "</tr>";
foreach (paasList() AS $value) {
    echo "<tr>";
    echo "<td>" . $value['name'] . "</td>";
    echo "<td>" . $value['console'] . "</td>";
    echo "<td>" . date("d/m/y H:i", $value['date_end']->timestamp) . "</td>";
    echo "<td>" . $value['catalog_name'] . "</td>";

    echo "<td>";
    foreach ($value['servers'] AS $server) {
        $servers .=  $server['id'] . "/";
    }
    echo substr($servers, 0, strlen($servers)-1);
    echo "</td>";

    echo "<td>" . $value['datacenter_id'] . "</td>";
    echo "<td>" . $value['state'] . "</td>";
    echo "<td>" . $value['need_upgrade'] . "</td>";
    echo "<td>" . $value['snapshot_profile'] . "</td>";
    echo "<td>" . $value['id'] . "</td>";
    echo "<td>" . $value['size'] . "</td>";
    echo "<td>" . $value['type'] . "</td>";
    echo "<td>" . $value['data_disk_additional_size'] . "</td>";
    echo "<td>" . date("d/m/y H:i", $value['date_end_commitment']->timestamp) . "</td>";
    echo "<td><a href='#'>View</a> | <a href='#'>Update</a> | <a href='#'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
    ?>
    </div>
<?php
}
?>
