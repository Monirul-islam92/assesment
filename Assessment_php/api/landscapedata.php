<?php

$con = mysqli_connect("localhost","root","","assessment");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$request_type = $_SERVER['REQUEST_METHOD'];
$response = [
    'success' => false,
    'error_code' => 4001,
    'message' =>'Invalid Request Format'
];
switch ($request_type){
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'),true);
        if(empty($_POST) === false) {
            if(1) {
                if(isset($_POST['post_type'])){
                    switch ($_POST['post_type']){
                        case "landscapedata":
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
                            if($all) {
                                $response = [
                                    'success' => true,
                                    'data' => $all
                                ];
                                break;

                            }
                            else{
                                //require post value missing
                                $response = [
                                    'success' => false,
                                    'error_code' => 1003,
                                    'message' => 'invalid attempt'
                                ];
                            }

                            break;

                    }
                    if($response['success'] === false && $response['error_code'] === 4001){
                        $response = [
                            'success' => false,
                            'error_code' => 1155,
                            'message' => 'invalid post'
                        ];
                    }
                }
                else{

                    $response = [
                        'success' => false,
                        'error_code' => 1003,
                        'message' => 'invalid attempt'
                    ];
                }
            }
            else{
                // page token error
                $response = [
                    'success' => false,
                    'error_code' => 1010,
                    'message' => 'invalid attempt'
                ];
            }
        }
        else{
            // empty post value
            $response = [
                'success' => false,
                'error_code' => 1002,
                'message' => 'invalid attempt'
            ];
        }
        break;

    case 'GET':
        break;
}
echo json_encode($response);