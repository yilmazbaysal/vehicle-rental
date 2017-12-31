<?php
include "../common.php";
include "../connection.php";
include "../authentication/login_required.php";
?>

<div class="left_menu">
    <center>
        <form action="car_filter.php" method="post">
            Amount<br><input type="number" name="min_amount" style="width: 100px;"> - <input type="number" name="max_amount"style="width: 100px;"><br><br>
            Year<br><input type="number" name="min_year" style="width: 100px;"> - <input type="number" name="max_year"style="width: 100px;"><br><br>
            Kilometer<br><input type="number" name="min_km" style="width: 100px;"> - <input type="number" name="max_km"style="width: 100px;"><br><br>

            Fuel Type<br><select name="fuel_type">
                <option value= '%' selected="selected">All</option>
                <option value='Diesel'>Diesel</option>
                <option value='Hybrid'>Hybrid</option>
                <option value='Gasoline'>Gasoline</option>
                <option value='Electric'>Electric</option>
                <option value='Gasoline + LPG'>Gasoline + LPG</option>
            </select><br><br>

            Gear<br><select name="gear">
                <option value= 0 selected="selected">All</option>
                <?php
                $gear_query = oci_parse($connection, 'SELECT * FROM GEAR');
                oci_execute($gear_query);

                while ($row = oci_fetch_array($gear_query,OCI_ASSOC+OCI_RETURN_NULLS)) {
                    echo "<option value='".$row['ID']."'>".$row['TYPE']."-".$row['COUNT']."</option>";
                }
                ?>
            </select><br><br>

            Segment <br>
            <select name="segment" required>
                <option value='%' selected="selected">All</option>";
                <option value='A'>A</option>";
                <option value='B'>B</option>";
                <option value='C'>C</option>";
                <option value='D'>D</option>";
                <option value='E'>E</option>";
                <option value='F'>F</option>";
                <option value='G'>G</option>";
            </select><br><br>

            Frame Type<br><select name="frame_type">
                <option value= 0 selected="selected">All</option>
                <?php
                $frame_type_query = oci_parse($connection, 'SELECT * FROM FRAME_TYPE');
                oci_execute($frame_type_query);

                while ($row = oci_fetch_array($frame_type_query,OCI_ASSOC+OCI_RETURN_NULLS)) {
                    echo "<option value='".$row['ID']."'>".$row['NAME']."-".$row['DOOR_COUNT']."Door</option>";
                }
                ?>
            </select><br><br>

            Equipment Package<br><select name="equipment_package">
                <option value= 0 selected="selected">All</option>
                <?php
                $equipment_package_query = oci_parse($connection, 'SELECT * FROM EQUIPMENT_PACKAGE');
                oci_execute($equipment_package_query);

                while ($row = oci_fetch_array($equipment_package_query,OCI_ASSOC+OCI_RETURN_NULLS)) {
                    echo "<option value='".$row['ID']."'>".$row['PACKAGE_NAME']."</option>";
                }
                ?>
            </select><br><br>
            <input type="submit" name="list_cars" value="List Cars">
        </form>
    </center>
</div>

<div class="vehicle_list">

    <?php
        if (isset($_POST['list_cars'])) {

            $car_filter = true;
            $max_value = 9999999999;

            if($_POST["max_amount"])
                $max_amount = $_POST["max_amount"];
            else
                $max_amount = $max_value;
            if($_POST["min_amount"])
                $min_amount = $_POST["min_amount"];
            else
                $min_amount = -1 * $max_value;

            if($_POST["max_year"])
                $max_year = $_POST["max_year"];
            else
                $max_year =  $max_value;
            if($_POST["min_year"])
                $min_year = $_POST["min_year"];
            else
                $min_year = -1 * $max_value;

            if($_POST["max_km"])
                $max_km = $_POST["max_km"];
            else
                $max_km =  $max_value;
            if($_POST["min_km"])
                $min_km = $_POST["min_km"];
            else
                $min_km = -1 * $max_value;

            $fuel_type = $_POST["fuel_type"];
            $segment = $_POST["segment"];

            if($_POST["gear"] > 0){
                $temp = $_POST["gear"];
                $gear_condition = "m.GEAR_ID = $temp";
            }
            else
                $gear_condition = "m.GEAR_ID > 0";

            if($_POST["frame_type"] > 0){
                $temp = $_POST["frame_type"];
                $frame_type_condition = "car.FRAME_TYPE_ID = $temp";
            }
            else
                $frame_type_condition = "car.FRAME_TYPE_ID > 0";

            if($_POST["equipment_package"] > 0){
                $temp = $_POST["equipment_package"];
                $equipment_package_condition = "car.EQUIPMENT_PACKAGE_ID = $temp";
            }
            else
                $equipment_package_condition = "car.EQUIPMENT_PACKAGE_ID > 0";

        }
    include "../vehicle_list.php";
    ?>

</div>


