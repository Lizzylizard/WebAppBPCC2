<?php
    $myfile = fopen("data.json", "r") or die("Unable to open file!");
    $jsonobj = fread($myfile, filesize("data.json"));
    fclose($myfile);
    $data_as_php = json_decode($jsonobj, true);

    $res_str = "";
    $isInArray = 0;


    if (array_key_exists('fname', $_POST)) {
        $fname = $_POST['fname'];
    } else {
        $fname = "Kein Name";
    }

    if (strlen($fname) > 0) {

        foreach($data_as_php as $key => $value) {
            # echo $key . " => " . $value . "<br>";
            if ($key == $fname) {
                $isInArray = 1;
                $data_as_php[$key]++;
            }
            $res_str .= $key . " has visited " . $value . " times.<br>";
        }

        if ($isInArray == 0) {
            $data_as_php[$fname] = 1;
        }

        $myfile2 = fopen("data.json", "w") or die("Unable to open file! While writing.");
        fwrite($myfile2, json_encode($data_as_php));
        fclose($myfile2);

        echo $res_str;

    } else {
    foreach($data_as_php as $key => $value) {
        $res_str .= $key . " has visited " . $value . " times.<br>";
        }
        echo $res_str;
    }








    # $new_entry = json_encode(array("Felix"=>9));
    # $new_entry = json_encode($data_as_php->append("Felix:9"));
    # echo $new_entry;

    # $myfile2 = fopen("data.json", "a") or die("Unable to open file!");
    # fwrite($myfile2, $new_entry);
    # fclose($myfile2);

    # {"Elisabeth":10,"David":12,"Axel":4, "Sebastian":2}
?>