<?php

ini_set('auto_detect_line_endings', true);

if (isset($_POST['submit'])) {
    if ( $_FILES["timetable"]["type"] === "text/csv") {

        $temp = $_FILES["timetable"]["tmp_name"];

        $row = 0;

        if (($handle = fopen($temp, "r")) !== FALSE) {
            /** skip column headings */
            fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) {
                    if ($c == 0) {
                        validateDateFormat($data[$c]);
                    } else {
                        validateTimeFormat($data[$c]);
                    }
                }
            }
        }
        echo $row;
        fclose($handle);
    }
}

/**
 * @param string $date
 */
function validateDateFormat($date)
{
//    if (not valid date format) {
        echo "<h3 class='important'>Invalid Date format</h3>";
        var_dump($date);
//    }
}

/**
 * @param string $time
 */
function validateTimeFormat($time)
{
//    if (not valid date format) {
    echo "<h3 class='important'>Invalid Time format</h3>";
    var_dump($time);
//    }
}
?>

<div xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <h1>Set prayer time for your mosque</h1></br></br>
    <h2><a href="http://plugins.svn.wordpress.org/masjidnow/trunk/sample.csv"> Download sample csv.</a></h2></br>
    <h3 class="important">Please update the csv with your mosque's timetable before upload.</h3> </br>
    <form enctype="multipart/form-data" name="form1" method="post" action="">
        <h2>Select prayer time csv to upload:</h2>
        <input type="file" name="timetable" id="timetable">
        <input type="submit" value="Upload Prayer Time" name="submit">
    </form>

</div>
<?php

