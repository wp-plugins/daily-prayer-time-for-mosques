<div class="wrap">
    <h2>Set prayer time for your mosque</h2></br></br>
	<form name="form1" method="post" action="">
        <input type="checkbox" name="jamahOnly" value="jamahOnly"/>Display Jamah time only</br>
        <input type="checkbox" name="hanafiAsr" value="hanafiAsr"/>Display Asr start time according to Hanafi school</br></br>
        <input type="radio" name="choice" value="vertical"/>Display prayer time vertically</br>
        <input type="radio" name="choice" value="vertical"/>Display prayer time horizontally</br></br>

        Select prayer time csv to upload:
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload Prayer Time" name="submit">
    </form>

</div>
<?php

