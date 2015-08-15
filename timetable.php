
<?php
include 'db.php';

require_once('TimetablePrinter.php');

class TimeTable
{
    /** @var boolean */
    private $isJamahOnly = false;

    /** @var boolean */
    private $isHanafiAsr = false;

    /** @var array */
    private $row = array();

    /** @var  TimetablePrinter */
    private $timetablePrinter;

    public function __construct()
    {
        $this->row = $this->getCalendarToday();
        $this->timetablePrinter = new TimetablePrinter();
    }

    public function setJamahOnly()
    {
        $this->isJamahOnly = true;
    }

    public function setHanafiAsr()
    {
        $this->isHanafiAsr = true;
    }

    public function verticalTime()
    {
        $row = $this->row;

        $row['asr_begins'] = $this->isHanafiAsr ? $this->row['asr_mithl_2'] : $this->row['asr_mithl_1'];

        if ($this->isJamahOnly) {
            return $this->timetablePrinter->verticalTimeJamahOnly($row);
        }

        return $this->timetablePrinter->verticalTime($row);
    }

    public function horizontalTime()
    {
        $row = $this->row;
        $row['asr_begins'] = $this->isHanafiAsr ? $this->row['asr_mithl_2'] : $this->row['asr_mithl_1'];

        if ($this->isJamahOnly) {
            return $this->timetablePrinter->horizontalTimeJamahOnly($row);
        }

        return $this->timetablePrinter->horizontalTime($row);
    }

    /**
     * return todays prayer time based on day and month
     * @return array
     */
    private function getCalendarToday()
    {
        $db = new DatabaseConnection();
        return $db->getPrayerTimeForToday();
    }
}
