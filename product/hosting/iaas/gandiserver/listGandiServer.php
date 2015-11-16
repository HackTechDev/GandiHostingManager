<?php
function listGandiServer() {
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Gandi Server list</h2>
            <a href="<?php echo admin_url('admin.php?page=createGandiServer'); ?>">Add a Gandi Server</a>
    <?php

echo "<table border=1>";
echo "<tr>";
echo "<th>vms id</th>";
echo "<th>Name</th>";
echo "<th>Source</th>";
echo "<th>Kernel version</th>";
echo "<th>Can snapshot</th>";
echo "<th>Total size</th>";
echo "<th>Snapshot id</th>";
echo "<th>Visibility</th>";
echo "<th>Label</th>";
echo "<th>Datacenter id</th>";
echo "<th>Date updated</th>";
echo "<th>State</th>";
echo "<th>Is boot disk</th>";
echo "<th>id</th>";
echo "<th>Date create</th>";
echo "<th>Type</th>";
echo "<th>Snapshot profile id</th>";
echo "<th>Size</th>";
echo "<th>Action</th>";
echo "</tr>";

foreach (iaasList() AS $value) {
    echo "<tr>";
    echo "<td>" . $value['vms_id'][0] . "</td>";
    echo "<td>" . $value['name'] . "</td>";
    echo "<td>" . $value['source'] . "</td>";
    echo "<td>" . $value['kernel_version'] . "</td>";
    echo "<td>" . $value['can_snapshot'] . "</td>";
    echo "<td>" . $value['total_size'] . "</td>";
    echo "<td>" . $value['snapshots_id'] . "</td>";
    echo "<td>" . $value['visibility'] . "</td>";

    echo "<td>" . $value['label'] . "</td>";
    echo "<td>" . $value['datacenter_id'] . "</td>";
    echo "<td>" . date("d/m/y H:i", $value['date_updated']->timestamp) . "</td>";
    echo "<td>" . $value['state'] . "</td>";
    echo "<td>" . $value['is_boot_disk'] . "</td>";

    echo "<td>" . $value['id'] . "</td>";
    echo "<td>" . date("d/m/y H:i", $value['date_created']->timestamp) . "</td>";
    echo "<td>" . $value['type'] . "</td>";
    echo "<td>" . $value['snapshot_profile_id'] . "</td>";
    echo "<td>" . $value['size'] . "</td>";

    echo "<td><a href='#'>View</a> | <a href='#'>Update</a> | <a href='#'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
    ?>
    </div>
<?php
}
?>
