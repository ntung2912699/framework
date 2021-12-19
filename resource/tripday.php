<?php
    arr(
        "Trip", array(
            "trip1" => [
                "2021-12-20",
                "2021-12-21",
                "2021-12-22",
                "2021-12-23",
            ],
            "trip2" => [
                "2021-12-26",
                "2021-12-27",
            ],
            "trip3" => [
                "2022-01-10",
                "2021-12-11",
            ]
        )
    );

    function getdatetime()
    {
        $arr = Trip;
        $result = [];

        foreach ($arr as $item) {
            foreach ($item as $value) {
                $result[] = $value;
            }
            return $result;
        }
    }
    function getalldate($format = 'Y-m-d')
    {
        if (isset($_GET['startdate'])&& isset($_GET['enddate']))
        {
            $arrTrip = [];

            $start = strtotime($_GET['startdate']);
            $end = strtotime($_GET['enddate']);

            $stepval = "+1 day";

            while ($start <= $end){
                $arrTrip[] = date($format, $start);

                $start = strtotime($stepval, $start);
            }
            return $arrTrip;
        }
    }

    function gettrip()
    {
        $arrTrip = getdatetime();
        $arrDate = getalldate();

        $arrDate1 = [];
        $arrDate2 = [];

        foreach ( $arrTrip as $datevalue){
            $arrDate1[] = strtotime($datevalue);
        }
        foreach ($arrDate as $itemvalue){
            $arrDate2 = strtotime($itemvalue);
        }

        $arrDateFinal = array_unique(array_merge($arrDate1,$arrDate2));

        $listDate = [];
        foreach ($arrTrip as $date){
            if (!in_array($date, $arrDate1)){
                $listDate[] = date('Y-m-d', $date);
            }
        }
        print_r($listDate);
    }