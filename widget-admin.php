<?php
require_once('Validator.php');

ini_set('auto_detect_line_endings', true);

if (isset($_POST['submit'])) {
    if ( $_FILES["timetable"]["type"] === "text/csv") {

        $temp = $_FILES["timetable"]["tmp_name"];

        $row = 0;

        if (($handle = fopen($temp, "r")) !== FALSE) {
            $validator = new Validator();

            $file = file($temp);
            $count = count($file);
            if (! $validator->isValidNumberOfRows($count)) {
                echo "<h3 class='error'>Your file do not have data for full year. Found data for $count days only</h3>";
                goBack();
                exit;
            }

            /** skip column headings */
            fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) {
                    if ($c == 0) {
                        if(! $validator->isValidateDateFormat($data[$c])) {
                            echo "<h3 class='error'>Invalid Date format, valid date format is <span class='important'>YYYY-MM-DD</span> </h3>";
                            var_dump($data[$c]);
                            exit;
                        }
                    } else {
                        if(! $validator->isValidateTimeFormat($data[$c])) {
                            echo "<h3 class='error'>Invalid Time format ". $data[$c] ." on ". $data[0] .", valid time format is <span class='important'>HH:MM:SS</span> </h3>";
                            var_dump($data);
                            exit;
                        }
                    }
                }
                echo ' insert me ';
            }
        }
        echo "<h3>" . $row . " Inserted</h3>";
        fclose($handle);
    } else {
        echo "<h1 class='error'>Invalid csv file</h1>";
    }
}

function goBack()
{
    echo "<a href='javascript:history.back()'><h3 class='important'>Go Back</h3> </a>";
}

?>

<div xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <h1>Set prayer time for your mosque</h1></br>
    <h2><a href="http://plugins.svn.wordpress.org/daily-prayer-time-for-mosques/trunk/sample.csv"> Download csv template</a></h2>
    <h2 class="important">Please update the csv with your mosque's timetable before upload.
    Valid date format is <span class="error">YYYY-MM-DD</span> and valid time format is <span class="error">HH:MM:SS</span></h2>
    <form enctype="multipart/form-data" name="form1" method="post" action="">
        <h2>Select prayer time csv to upload:</h2>
        <input type="file" name="timetable" id="timetable">
        <input type="submit" value="Upload Prayer Time" name="submit" class="submit">
    </form>

</div>
<?php

