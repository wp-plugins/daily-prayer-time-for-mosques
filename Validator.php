<?php

class Validator
{

    /** @var bool  */
    private $valid = false;


    public function validate()
    {
        return $this->valid;
    }

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
     * @param $count
     * @return bool
     */
    public function isValidNumberOfRows($count)
    {
        if ($count < 365 || $count > 366) {
            return false;
        }

        return true;
    }
}
