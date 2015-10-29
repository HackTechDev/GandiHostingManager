<?php
function updateSimpleHosting() {
    global $wpdb;
    $id = $_GET["id"];
    $instance = $_POST["instance"];
    $description = $_POST["description"];

    if(isset($_POST['update'])) {	
        
        $wpdb->update( $wpdb->prefix . 'gandihosting',
            array('instance' => $instance, 'description' => $description), array( 'id' => $id )
        );	
    }
    else if(isset($_POST['delete'])) {	
        $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "gandihosting WHERE id = %s",$id));
    }
    else{
        $instancedescriptions = $wpdb->get_results($wpdb->prepare("SELECT id, instance, description from wp_gandihosting where id=%s",$id));
        foreach ($instancedescriptions as $instancedescription ) {
            $instance = $instancedescription->instance;
            $description = $instancedescription->description;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
    <h2>Simple Hosting update</h2>

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
                        <input type="text" name="instance" value="<?php echo $instance;?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>
                        <input type="text" name="description" value="<?php echo $description;?>"/>
                    </td>
                </tr>

            </table>
            <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
            <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Do you want to delete this Simple Hosting?')">
        </form>
    <?php }?>

    </div>
<?php
}
?>
