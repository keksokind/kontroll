<?php
require_once('config/db.php');
$query = 'select distinct stop_area from stops_txt';
$result = mysqli_query($con, $query);

$stopQuery = "select stop_name from stops_txt";
$stopResult = mysqli_query($con, $stopQuery);
?>

<!DOCTYPE html>
<html lang='en'>
<link href='kontroll_css.css' rel="stylesheet" />

<body>
    <div class="centeredtext">
        <div class="font1"><p><i style="font-size: 30px;"><strong>Piirkonna nimi</strong></i></p></div>
    </div>
    <form method="post" action="">
        <div class='centeredbutton'>
            <button type="submit" name="submit" style="font-size: 20px;" class='coolbuttondesign'>Show Stops</button>
        </div>
        <div class="centeredbar">
        <input type="text" name="rname" id="rname" class="rcorner1" class="dropdown-input" oninput="filterFunction()" placeholder="Type a region...">
            <div class="dropdown-menu" id="myDropdown">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<a href="#">' . $row['stop_area'] . '</a>';
                }
                ?>
            </div>
        </div>
    </form>
    <div class="centeredstops">
        <?php
        if (isset($_POST['submit'])) {
            $selectedCity = $_POST['rname'];
            $filteredStopQuery = "select distinct stop_name from stops_txt where stop_area = '$selectedCity'";
            $filteredStopResult = mysqli_query($con, $filteredStopQuery);
        
            if ($filteredStopResult->num_rows > 0) {
                echo "<h2 style='text-align: center;'>Bus Stops in $selectedCity:</h2>";
                echo '<table>';
                $counter = 0;
                while ($row = mysqli_fetch_assoc($filteredStopResult)) {
                    if ($counter % 20 == 0) {
                        echo '<tr>';
                    }
                    echo "<td>{$row['stop_name']}</td>";
        
                    if ($counter % 20 == 19) {
                        echo '</tr>';
                    }
                    $counter++;
                }
                if ($counter % 20 != 0) {
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "No bus stops found for $selectedCity";
            }
        }
        ?>    
    </div>
    <script src="kontroll_js.js"></script>
</body>
</html>