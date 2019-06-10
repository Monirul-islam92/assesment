<?php

function lanscapedata(){
    $con = mysqli_connect("localhost","root","","assessment");
    $pointer=1;
    $stmt = $con->prepare("SELECT `name`,`phone`,`email`,`bio`,`profile_picture` FROM `profile_details` Where pointer = ?");
    $stmt->bind_param('i', $pointer);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        //result is in row
        $profile[0]=$row;
    }
    $stmt->close();
    $pointer=1;
    $stmt = $con->prepare("SELECT `id`,`title`,`description`,`img`,`date`,`featured` FROM `albums` Where `user`= ?");
    $stmt->bind_param('i', $pointer);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        //result is in row
        if($row['featured']==1){
            $row['featured']=true;
        }
        else{
            $row['featured']=false;
        }
        $album[]=$row;

    }
    $stmt->close();
    $all=array();
    $all=$profile[0];
    $all['album']=$album;
    return $all;
}
var_dump(lanscapedata());