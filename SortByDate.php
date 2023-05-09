<?php
function SortOldest(&$array)
{
    $n = count($array);
    for($i=0;$i<$n-1;$i++)
    {
        for($j=$i+1;$j<$n;$j++)
        {
            if(strtotime($array[$i][2]) > strtotime($array[$j][2]))
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
    $n = count($array);
    for($i=0;$i<$n-1;$i++)
    {
        for($j=$i+1;$j<$n;$j++)
        {
            if(strtotime($array[$i][2]) < strtotime($array[$j][2]))
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