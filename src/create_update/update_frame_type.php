<?php
include "../common.php";
include "../connection.php";
include "../authentication/admin_user_required.php";
?>

<html>
    <div class="update-header-container">
        <h1 class="update-header">Update Frame-Type</h1>
    </div>

    <div class="update-list-container">

        <?php

        $item_list_query = oci_parse($connection, "SELECT * FROM FRAME_TYPE");
        oci_execute($item_list_query);

        while ($row = oci_fetch_array($item_list_query,OCI_ASSOC+OCI_RETURN_NULLS)) {

            $id = $row['ID'];
            $table_name = "FRAME_TYPE";
            $page = "update_frame_type";
            $edit_url = "location.href='create_frame_type.php?id=$id'";
            $del_url = "location.href='utils/delete_item.php?table=$table_name&id=$id&page=$page'";

            echo "<table class='list-item'>
                    <td class='list-item-info'>".$row['NAME']." - ".$row['DOOR_COUNT']." Door</td>
                    <td><button onclick=$edit_url>Edit</button></td>
                    <td><button onclick=$del_url>Delete</button></td>
                </table>";
        }

        ?>
    </div>
</html>