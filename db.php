<?php

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


class DatabaseConnection
{

    /** @var string  */
    private $dbTable = "";

    /** @var string */
    private $tableName = "";

    /** @var mysqli  */
    private $conn;

    public function __construct()
    {
        global $wpdb;

        $this->tableName = $wpdb->prefix . "timetable";
        $this->dbTable = DB_NAME . "." .$wpdb->prefix . "timetable";

        $this->createTableIfNotExist();
    }

    /**
     * @return array
     */
    public function getPrayerTimeForToday()
    {
        $today = date ("Y-m-d");
        $sql = "SELECT * FROM  $this->dbTable WHERE d_date = '$today' LIMIT 1";

        return $this->returnArray($sql);
    }

    public function truncateTable()
    {
        global $wpdb;

        $truncateSql = "TRUNCATE TABLE $this->dbTable";
        $wpdb->query($truncateSql);
    }
    /**
     * @param array $row
     */
    public function insertRow($row)
    {
        global $wpdb;

        $wpdb->insert(
            $this->tableName,
            array(
                'd_date'        => $row['d_date'],
                'fajr_begins'   => $row['fajr_begins'],
                'fajr_jamah'    => $row['fajr_jamah'],
                'sunrise'       => $row['sunrise'],
                'zuhr_begins'   => $row['zuhr_begins'],
                'zuhr_jamah'    => $row['zuhr_jamah'],
                'asr_mithl_1'   => $row['asr_mithl_1'],
                'asr_mithl_2'   => $row['asr_mithl_2'],
                'asr_jamah'     => $row['asr_jamah'],
                'maghrib_begins'=> $row['maghrib_begins'],
                'maghrib_jamah' => $row['maghrib_jamah'],
                'isha_begins'   => $row['isha_begins'],
                'isha_jamah'    => $row['isha_jamah'],
            )
        );
    }

    /**
     * @param $sql
     * @return array
     */
    private function returnArray($sql)
    {
        global $wpdb;
        $result = $wpdb->get_row($sql, ARRAY_A);

        return $result;
    }

    private function createTableIfNotExist()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE " . $this->dbTable. "(
                timetable_id int(3) NOT NULL AUTO_INCREMENT,
                d_date date DEFAULT NULL,
                fajr_begins time DEFAULT NULL,
                fajr_jamah time DEFAULT NULL,
                sunrise time DEFAULT NULL,
                zuhr_begins time DEFAULT NULL,
                zuhr_jamah time DEFAULT NULL,
                asr_mithl_1 time DEFAULT NULL,
                asr_mithl_2 time DEFAULT NULL,
                asr_jamah time DEFAULT NULL,
                maghrib_begins time DEFAULT NULL,
                maghrib_jamah time DEFAULT NULL,
                isha_begins time DEFAULT NULL,
                isha_jamah time DEFAULT NULL,
                PRIMARY KEY  (timetable_id)
                ) $charset_collate;";

        $wpdb->get_var("SHOW TABLES LIKE 'wp_timetable'");
        if($wpdb->num_rows != 1) {
            dbDelta( $sql );
            $this->importTimeTable();
        }

    }

    /**
     * Import table on the first run
     */
    private function importTimeTable()
    {
        global $wpdb;

        $this->truncateTable();

        $query = "INSERT INTO  $this->dbTable
                  (d_date,
                  fajr_begins,
                  fajr_jamah,
                  sunrise,
                  zuhr_begins,
                  zuhr_jamah,
                  asr_mithl_1,
                  asr_mithl_2,
                  asr_jamah,
                  maghrib_begins,
                  maghrib_jamah,
                  isha_begins,
                  isha_jamah) VALUES";
        $data = file_get_contents('timetable.txt', true);

        $insertSql = $query . $data;
        $wpdb->query($insertSql);
    }
}
