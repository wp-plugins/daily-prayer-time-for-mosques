<?php
require_once('Validator.php');
require_once('db.php');

ini_set('auto_detect_line_endings', true);

if (isset($_POST['submit'])) {
    if ( $_FILES["timetable"]["type"] === "text/csv") {

        $temp = $_FILES["timetable"]["tmp_name"];

        $row = 0;

        if (($handle = fopen($temp, "r")) !== FALSE) {
            $validator = new Validator();
            $db = new DatabaseConnection();

            $file = file($temp);
            if (! $validator->isValidNumberOfRows($file)) {
                goBack();
                exit;
            }

            $db->truncateTable();

            /** skip column headings */
            $header = fgetcsv($handle);
            $validator->setHeaders($header);

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (! $validator->isValidData($data)) {
                    goBack();
                    exit;
                } else {
                    $row++;
                    $data = $validator->getValidData();
                    $db->insertRow($data);
                }
            }
        }
        echo "<h3 class='success'>" . $row . " Rows Inserted successfully  </h3>";
        fclose($handle);
    } else {
        echo "<h1 class='error'>Invalid csv file</h1>";
    }
}

function goBack()
{
    echo "<a href='javascript:window.location = document.referrer;'><h3 class='important'>Go back and Retry</h3> </a>.<br />";
}

?>

<div xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <h1>Set prayer time for your mosque</h1></br>
    <h2><a href="http://plugins.svn.wordpress.org/daily-prayer-time-for-mosques/trunk/sample.csv"> Download csv template</a></h2>
    <h2>Please update the csv with your mosque's timetable before upload.
    Valid date format is <span class="error">YYYY-MM-DD</span> and valid time format is <span class="error">HH:MM:SS</span></h2>
    <form enctype="multipart/form-data" name="form1" method="post" action="">
        <h2>Select prayer time csv to upload:</h2>
        <input type="file" name="timetable" id="timetable">
        <input type="submit" value="Upload Prayer Time" name="submit" class="submit">
    </form>

</div>
<?php

