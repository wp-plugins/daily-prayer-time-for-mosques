<?php

class DatabaseConnection
{
    const TABLE_NAME = 'wp_timetable';

    /** Connection */
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->conn->options(MYSQLI_OPT_LOCAL_INFILE, true);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $this->createTableIfNotExist();
    }

    /**
     * @param  string $sql
     * @return boolean
     */
    public function returnArray($sql)
    {
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row;
            }
        }

        $this->conn->close();

        return false;
    }

    private function createTableIfNotExist()
    {
        $sql = "CREATE TABLE `" . self::TABLE_NAME . "`(
                `timetable_id` int(3) NOT NULL AUTO_INCREMENT,
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
                ) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;";

        $tableExist = $this->conn->query('select 1 from prayer_plugin.wp_timetable limit 1;');
        if (! $tableExist) {
            $this->conn->query($sql);
            $this->importTimeTable();
        }
    }

    private function importTimeTable()
    {
        $truncateSql = "TRUNCATE TABLE `". self::TABLE_NAME ."`";
        $this->conn->query($truncateSql);

        $query = "INSERT INTO ".DB_NAME.".`". self::TABLE_NAME ."` (`d_date`, `fajr_begins`, `fajr_jamah`, `sunrise`, `zuhr_begins`, `zuhr_jamah`, `asr_mithl_1`, `asr_mithl_2`, `asr_jamah`, `maghrib_begins`, `maghrib_jamah`, `isha_begins`, `isha_jamah`) VALUES";
        $data = file_get_contents('timetable.sql', true);

        $insertSql = $query . $data;
        $this->conn->query($insertSql);
    }
}
