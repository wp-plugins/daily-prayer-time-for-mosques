<?php

class TimetablePrinter
{
    /**
     * @param $row
     * @return string
     */
    public function verticalTime($row)
    {
        return
            '<table class="timetable">
            <tr><th></th>
                <th style="text-align:center">Fajr</th>
                <th style="text-align:center">Sunrise</th>
                <th style="text-align:center">Zuhr</th>
                <th style="text-align:center">Asr</th>
                <th style="text-align:center">Magrib</th>
                <th style="text-align:center">Isha</th></tr>
            <tr><th style="text-align:center">Begins</th>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['fajr_begins']).'</td>
                <td style="text-align:center" rowspan="2">'.$this->formatDateForPrayer($row['sunrise']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['zuhr_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['asr_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['maghrib_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['isha_begins']).'</td>
            </tr
            <tr><th style="text-align:center">Jamah</th>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['fajr_jamah']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['zuhr_jamah']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['asr_jamah']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['maghrib_jamah']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['isha_jamah']).'</td></tr>
        </table>';
    }

    /**
     * @param $row
     * @return string
     */
    public function horizontalTime($row)
    {
        return
            '<table class="timetable">
            <tr>
             <th colspan="3" style="text-align:center">'.$this->formatDate($row['d_date']).'</th>
            </tr>
            <tr>
             <th style="text-align:center">Prayer</th><th style="text-align:center">Begins</th><th style="text-align:center">Jamah</th>
            </tr>
            <tr>
                <td style="text-align:center">Fajr</td><td style="text-align:center">'.$this->formatDateForPrayer($row['fajr_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['fajr_jamah']).'
            </tr>
            <tr><td style="text-align:center">Sunrise</td><td colspan="2" style="text-align:center">'.$this->formatDateForPrayer($row['sunrise']).'</td></tr>
            <tr>
                <td style="text-align:center">Zuhr</td><td style="text-align:center">'.$this->formatDateForPrayer($row['zuhr_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['zuhr_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Asr</td><td style="text-align:center">'.$this->formatDateForPrayer($row['asr_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['asr_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Magrib</td><td style="text-align:center">'.$this->formatDateForPrayer($row['maghrib_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['maghrib_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Isha</td><td style="text-align:center">'.$this->formatDateForPrayer($row['isha_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['isha_jamah']).'
            </tr>
        </table>';
    }

    public function verticalTimeJamahOnly($row)
    {
        return
            '<table class="timetable">
            <tr><th colspan="6" style="text-align:center">'.$this->formatDate($row['d_date']).'</th></tr>
            <tr><th></th>
                <th style="text-align:center">Fajr</th>
                <th style="text-align:center">Zuhr</th>
                <th style="text-align:center">Asr</th>
                <th style="text-align:center">Magrib</th>
                <th style="text-align:center">Isha</th></tr>
            <tr><th style="text-align:center">Jamah</th>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['fajr_jamah']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['zuhr_jamah']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['asr_jamah']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['maghrib_jamah']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['isha_jamah']).'</td></tr>
        </table>';
    }

    /**
     * @param  array $row
     * @return string
     */
    public function horizontalTimeJamahOnly($row)
    {
        return
            '<table class="timetable">
            <tr>
             <th colspan="2" style="text-align:center">'.$this->formatDate($row['d_date']).'</th>
            </tr>
            <tr>
             <th style="text-align:center">Prayer</th><th style="text-align:center">Jamah</th>
            </tr>
            <tr>
                <td style="text-align:center">Fajr</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['fajr_jamah']).'
            </tr>
            <tr><td style="text-align:center">Sunrise</td><td style="text-align:center">'.$this->formatDateForPrayer($row['sunrise']).'</td></tr>
            <tr>
                <td style="text-align:center">Zuhr</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['zuhr_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Asr</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['asr_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Magrib</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['maghrib_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Isha</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['isha_jamah']).'
            </tr>
        </table>';
    }

    /**
     * @param  string $mysqlDate
     * @param  string $format
     * @return string
     */
    private function formatDate($mysqlDate, $format=null)
    {
        $phpdate = strtotime($mysqlDate);
        $date =  date( 'l j, M Y', $phpdate );
        if ($format) {
            $date = date($format, $phpdate);
        }

        return $date;
    }

    /**
     * @param  string $mysqlDate
     * @return string
     */
    private function formatDateForPrayer($mysqlDate)
    {
        return $this->formatDate($mysqlDate, 'H:i');
    }
}
