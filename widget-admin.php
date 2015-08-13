<?php

require_once('timetable.php');

ini_set('auto_detect_line_endings', true);

if (isset($_POST['submit'])) {
    if ( $_FILES["timetable"]["type"] === "text/csv") {

        $temp = $_FILES["timetable"]["tmp_name"];

        $row = 0;

        if (($handle = fopen($temp, "r")) !== FALSE) {
            $t = new TimeTable();
            /** skip column headings */
            fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) {
                    if ($c == 0) {
                        if(! $t->isValidateDateFormat($data[$c])) {
                            echo "<h3 class='error'>Invalid Date format</h3>";
                            var_dump($data[$c]);
                            exit;
                        }
                    } else {
                        if(! $t->isValidateTimeFormat($data[$c])) {
                            echo "<h3 class='error'>Invalid Time format ". $data[$c] ." on ". $data[0] ." </h3>";
                            var_dump($data);
                            exit;
                        }
                    }
                }
            }
        }
        echo $row;
        fclose($handle);
    } else {
        echo "<h1 class='error'>Invalid csv file</h1>";
    }
}



?>

<div xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <h1>Set prayer time for your mosque</h1>
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

