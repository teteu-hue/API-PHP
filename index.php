<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="jquery.js"></script>
</head>
    <script type="text/javascript" src="functions.js">
        
    </script>

    <style>
        #panel
        {
            padding: 5px;
            text-align: center;
            background-color: #e5eecc;
            border: solid 1px #c3c3c3;
        }

        .panel 
        {
            padding: 50px;
            display: none;
        }
    </style>

<body>
<?php

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function romanToInt($s) {
        $result = 0;

        $data = [
            "I" => 1,
            "V" => 5,
            "X" => 10,
            "L" => 50,
            "C" => 100,
            "D" => 500,
            "M" => 1000
        ];

        if($s == null || $s < 1)
        {
            return -1;
        }

        for($i = 0; $i < strlen($s); $i++)
        {
            if($s[$i] === "I" && $s[$i+1] === "V")
            {
                $result += 4;
                $i++;
            } else if($s[$i] === "I" && $s[$i+1] === "X")
            {
                $result += 9;
                $i++;
            }
        }
    }
}

?>

</body>
</html>