<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 03.05.16
 * Time: 12:46
 */
class Entity
{
    private $date;

    /**
     * Set formatted date.
     *
     * @param $date
     */
    public function setDate($date)
    {
        $this->date = $this->dateFormat($date);
    }

    /**
     * Get formatted date.
     *
     * @param int $dateFormat
     * @return bool|string
     */
    public function getDate($dateFormat = 1)
    {
        $returnData = $this->date;

        switch ($dateFormat) {
            case 1:
                $returnData = $this->dateFormat($returnData);
                break;
            case 2:
                /* Month map */
                $monthMap = array(
                    '01' => 'styczeń',
                    '02' => 'luty',
                    '03' => 'marzec',
                    '04' => 'kwiecień',
                    '05' => 'maj',
                    '06' => 'czerwiec',
                    '07' => 'lipiec',
                    '08' => 'sierpień',
                    '09' => 'wrzesień',
                    '10' => 'październik',
                    '11' => 'listopad',
                    '12' => 'grudzień',
                );

                /* Build date */
                $tmpDate = explode('-', $this->date);
                $moth = $monthMap[$tmpDate[1]];
                $buildDate = $tmpDate[2] . ' ' . $moth . ' ' . $tmpDate[0];

                $returnData = $buildDate;
                break;
            default:
                break;
        }

        return $returnData;
    }

    private function dateFormat($date)
    {
        return date('Y-m-d', strtotime(str_replace('-', '/', $date)));
    }
}