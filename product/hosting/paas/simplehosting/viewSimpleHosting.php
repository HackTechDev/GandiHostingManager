<?php
function viewSimpleHosting() {
    global $wpdb;
    $id = $_GET["id"];
    $instance = $_POST["instance"];
    $description = $_POST["description"];

        $instancedescriptions = $wpdb->get_results($wpdb->prepare("SELECT id, instance, description from wp_gandihosting where id=%s",$id));
        foreach ($instancedescriptions as $instancedescription ) {
            $instance = $instancedescription->instance;
            $description = $instancedescription->description;
        }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
    <h2>Simple Hosting view</h2>

    <?php if($_POST['delete']){ ?>
        <div class="updated"><p>Delete Simple Hosting</p></div>
           <a href="<?php echo admin_url('admin.php?page=listSimpleHosting')?>">&laquo; Return to the Simple Hosting list</a>

    <?php } else if($_POST['update']) { ?>
        <div class="updated"><p>Update Simple Hosting</p></div>
            <a href="<?php echo admin_url('admin.php?page=listSimpleHosting')?>">&laquo; Return to the Simple Hosting list</a>

    <?php } else { ?>
        <a href="<?php echo admin_url('admin.php?page=listSimpleHosting')?>">&laquo; Return to the Simple Hosting list</a>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th>Instance</th>
                    <td>
                        <input type="text" name="instance" value="<?php echo $instance;?>" readonly />
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>
                        <input type="text" name="description" value="<?php echo $description;?>" readonly />
                    </td>
                </tr>

            </table>
        </form>
    <?php }?>

    </div>
<?php
}
?>
