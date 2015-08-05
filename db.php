<?php

class DatabaseConnection
{
    const TABLE_NAME = 'wp_timetable';

    /** Connection */
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
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
        if ($conn) {
            $conn->close();
        }

        return false;
    }

    private function createTableIfNotExist()
    {
        $sql = "CREATE TABLE `" . self::TABLE_NAME . "`(
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
                ) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;";

        if(mysql_num_rows(mysql_query("SHOW TABLES LIKE `" . self::TABLE_NAME . "`")) != 1) {
            $this->conn->query($sql);
        }
    }
}
