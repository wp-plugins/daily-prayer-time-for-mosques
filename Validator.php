<?php

class Validator
{
    /** @var array  */
    private $validData = array();

    /** @var array  */
    private $headers = array();

    /**
     * @param string $date
     * @return bool
     */
    public function isValidateDateFormat($date)
    {
        $format = 'Y-m-d';
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * @param string $time
     * @return bool
     */
    public function isValidateTimeFormat($time)
    {
        $format = 'H:i:s';
        $d = DateTime::createFromFormat($format, $time);
        return $d && $d->format($format) == $time;
    }

    /**
     * @param $file
     * @return bool
     */
    public function isValidNumberOfRows($file)
    {
        $count = count($file);

        if ($count < 365 || $count > 366) {
            echo "<h3 class='error'>Your file do not have data for full year. Found data for $count days only</h3>";
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isValidData(array $data)
    {
        $num = count($data);

        for ($c=0; $c < $num; $c++) {
            if ($c == 0) {
                if(! $this->isValidateDateFormat($data[$c])) {
                    echo "<h3 class='error'>Invalid Date format, valid date format is <span class='important'>YYYY-MM-DD</span>. Found $data[$c] </h3>";
                    return false;
                }
            } else {
                if(! $this->isValidateTimeFormat($data[$c])) {
                    var_dump($this->headers[$c]);
                    echo "<h3 class='error'>Invalid Time format in " . $data[$c] . " for " . $this->headers[$c] ." on ". $data[0] .", valid time format is <span class='important'>HH:MM:SS</span> </h3>";
                    print_r('<pre>');
                    print_r(array_combine($this->headers, $data));
                    print_r('</pre>');
                    return false;
                }
            }
        }

        $this->setValidData($data);

        return true;
    }

    /**
     * @return array
     */
    public function getValidData()
    {
        $data = array_combine($this->headers, $this->validData);

        return $data;
    }

    /**
     * @param array $data
     */
    private function setValidData(array $data)
    {
        $this->validData = $data;
    }

    /**
     * @param array $header
     */
    public function setHeaders(array $header)
    {
        $this->headers = $header;
    }
}
