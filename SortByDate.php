<?php
function SortOldest(&$array)
{
    if($array==null)
    return;
    $n =count($array) ;
    for($i=0;$i<$n-1;$i++)
    {
        for($j=$i+1;$j<$n;$j++)
        {
            if(strtotime($array[$i][1]) > strtotime($array[$j][1]))
            {
                $temp = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $temp;
            }
        }
    }
    return $array;
}

function SortLatest(&$array)
{
    if($array==null)
    return;
    $n =count($array) ;
    for($i=0;$i<$n-1;$i++)
    {
        for($j=$i+1;$j<$n;$j++)
        {
            if(strtotime($array[$i][1]) < strtotime($array[$j][1]))
            {
                $temp = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $temp;
            }
        }
    }
    return $array;
}



?>