=== Daily Prayer Time ===
Contributors: mmrs151
Donate link: http://edgwareict.org.uk/
Tags: prayer time, salah time
Requires at least: 3.0.1
Tested up to: 4.2
Stable tag: 4.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display daily prayer time either vertically or horizontally

== Description ==
The widget will allow you

- To display prayer time either vertically or horizontally.

- To display 'Jamah time' only if you chose.

- You can aslo show Hanafi Asr start time.

== Installation ==
1. Download the plugin
2. Simply go under the Plugins page, then click on Add new and select the plugin's .zip file
3. Alternatively you can extract the contents of the zip file directly to your wp-content/plugins/ folder
4. Finally, just go under Plugins and activate the plugin

= Comprehensive setup =

**The widget will be usable once you import your Masjid's prayer timetable data into the 'wp_timetable', which is created as part of installation.**

Initially it loads the data from the provided timetable.txt, which you can also edit with your timetable in the plugin editor.

You can use either sql import or csv import to feed data into your table. Please check the sample format of file to be imported.
[samples](https://github.com/mrahma01/daily-prayer-time/tree/master/sample)

Once the above is done, The widget will allow you

- To display prayer time either vertically or horizontally.

- To display 'Jamah time' only if you chose.

- You can aslo show Hanafi Asr start time.

== Frequently Asked Questions ==

= Why my time table is showing all zeros(0)? =

You will need to  import your mosque's timetable data into wp_timetable to see the times.

= Why my date is showing '1, Jan 1970' =

Because you do not have any data in the wp_timetable or your date format is not valid mysql format, which is (YYYY-MM-DD)

== Screenshots ==
1. Setup timetable, select options
2. Vertical timing
3. Horizontal timing
4. Import your timetable
