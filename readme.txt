=== Daily Prayer Time ===
Contributors: mmrs151	
Donate link: http://edgwareict.org.uk/
Tags: prayer time, salah time
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display daily prayer time either vertically or horizontally

== Description ==
The widget will allow you

- To display prayer time either vertically or horizontally.

- To display 'Jamah time' only.

- You can aslo show Hanafi Asr start time.

== Installation ==
1. Download the plugin
2. Simply go under the Plugins page, then click on Add new and select the plugin's .zip file
3. Alternatively you can extract the contents of the zip file directly to your wp-content/plugins/ folder
4. Finally, just go under Plugins and activate the plugin

This widget requires a database table named 'timetable' in your own wordpress database. 

The table definition must follow:
```sql
CREATE TABLE `timetable` (
  `timetable_id` int(3) NOT NULL AUTO_INCREMENT,
  `timetable_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `d_date` date DEFAULT NULL,
  `fajr_begins` time DEFAULT NULL,
  `fajr_jamah` time DEFAULT NULL,
  `sunrise` time DEFAULT NULL,
  `zuhr_begins` time DEFAULT NULL,
  `zuhr_jamah` time DEFAULT NULL,
  `asr_mithl_1` time DEFAULT NULL,
  `asr_mithl_2` time DEFAULT NULL,
  `asr_jamah` time DEFAULT NULL,
  `maghrib_begins` time DEFAULT NULL,
  `maghrib_jamah` time DEFAULT NULL,
  `isha_begins` time DEFAULT NULL,
  `isha_jamah` time DEFAULT NULL,
  PRIMARY KEY (`timetable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;`
```

#####The widget will be usuable once you import your Masjid's prayer timetable daata into the table.

You can use either sql import or csv import to feed data into your table. Please check the directory names 'sample' for the format of file to be imported.

Once the above is done, The widget will allow you

- To display prayer time either vertically or horizontally.

- to display 'Jamah time' only.

- You can aslo show Hanafi Asr start time.

== Screenshots ==
1. `/assets/screenshot-1.png` Horizontal timing
2. `/assets/screenshot-2.png` Vertical timing
