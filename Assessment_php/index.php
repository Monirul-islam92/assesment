<?php
$getjsonfilecontent = file_get_contents("landscapes.json");
$filecontentsarray = json_decode($getjsonfilecontent, true);
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<div class="divouter">
<div class="profileouter">
    <div class="profilepictureouter">
        <img class="profileimg" src="img/profile.jpeg"/>
    </div>
    <div class="nameandbioholder">
        <div class="nameholder">
            <?php echo $filecontentsarray['name']; ?>
        </div>
        <div class="bioholder">
            <div class="bioheader">Bio</div>
            <div class="biodescription">
               <?php echo $filecontentsarray['bio']; ?>
            </div>
        </div>
    </div>
    <div class="phoneandemailholder">
        <div class="phoneouter">
            <div class="phoneholder">Phone</div>
            <div class="phonenumber">
                <?php echo $filecontentsarray['phone']; ?>
            </div>
        </div>

        <div class="emailouter">
            <div class="emailholder">Email</div>
            <div class="emailaddress">
                <?php echo $filecontentsarray['email']; ?>
            </div>
        </div>
    </div>
</div>
    <div class="albumouter">
        <ul class="albumcontents">
            <?php
            $albumcontents=$filecontentsarray['album'];
            //            var_dump($albumcontents);

            $totalcontent=count($albumcontents);
            for($i=0;$i<$totalcontent;$i++){
                ?>
                <li class="albumcontentli">
                    <div class="theouterli">
                        <div class="liimageouter">
                            <img width="280px" height="180px" class="contentimage" src="<?php echo str_replace(".jpg",".jpeg", $albumcontents[$i]['img']);?>"/>
                            <div class="transparenthalf"></div><div class="titlediv"><?php echo $albumcontents[$i]['title']; ?></div>

                        </div>
                        <div class="contentdescription">
                            <?php echo $albumcontents[$i]['description']; ?>
                        </div>
                        <div class="contentfeatureandpublishdate">
                            <?php if($albumcontents[$i]['featured']){ ?>
                            <div class="contentfeature" title="Featured">
                                <img width="22px" height="20px" class="contentimage" src="img/heart.png"/>
                            </div>
                            <?php }?>
                            <div class="contentpublishdate">
                                <?php echo $albumcontents[$i]['date']; ?>
                            </div>

                        </div>
                    </div>

                </li>
                <?php
            }
            ?>
        </ul>
    </div>

</div>
</body>