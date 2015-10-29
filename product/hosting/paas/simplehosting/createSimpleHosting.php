<?php

function createSimpleHosting() {
    $instance = $_POST["instance"];
    $description = $_POST["description"];

    if(isset($_POST['insert'])){
        global $wpdb;
        $wpdb->insert(
            'wp_gandihosting',
            array('instance' => $instance, 'description' => $description),
            array('%s', '%s') 			
        );
        $message .= "Simple Hosting added";

    }
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add a Gandi Hosting</h2>
        <?php 
            if (isset($message)) { ?>
                <div class="updated">
                    <p>
                        <?php echo $message;?>
                    </p>
                </div>
                <a href="<?php echo admin_url('admin.php?page=listSimpleHosting')?>">&laquo; Return to the Simple Hosting list</a>
            <?php } else {?>

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
            <input type='submit' name="insert" value='Save' class='button'>
        </form>

        <?php
            }
        ?>

    </div>
<?php
}
?>
