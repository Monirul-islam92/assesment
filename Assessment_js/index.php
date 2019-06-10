
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
<div class="divouter">
   

</div>
</body>
<script type="application/javascript">


    $.ajax({
        url: 'landscapes.json',
        dataType: 'json',
        success: function(data) {
            $('.divouter').append('<div class="profileouter "><div class="profilepictureouter"><img class="profileimg" src="'+data['profile_picture'].replace(".jpg", ".jpeg")+'"/></div><div class="nameandbioholder"><div class="nameholder">'+data['name']+'</div><div class="bioholder"><div class="bioheader">Bio</div><div class="biodescription">'+data['bio']+'</div></div></div> <div class="phoneandemailholder"> <div class="phoneouter"> <div class="phoneholder">Phone</div> <div class="phonenumber">'+data['phone']+'</div></div><div class="emailouter"><div class="emailholder">Email</div><div class="emailaddress">'+data['email']+'</div></div></div></div>');
            var album=data['album'];
            var length=album.length;
            $('.divouter').append(' <div class="albumouter"><ul class="albumcontents"></ul></div>');
                for(i=0;i<length;i++){
                    if(album[i]['featured']){
                        var isfeature='<div class="contentfeature" title="Featured"><img width="22px" height="20px" class="contentimage" src="img/heart.png"/></div>';
                    }
                    else{
                        var isfeature='';
                    }

                    $('.albumcontents').append(' <li class="albumcontentli"><div class="theouterli"><div class="liimageouter"><img width="280px" height="180px" class="contentimage" src="'+album[i]['img'].replace(".jpg", ".jpeg")+'"/><div class="transparenthalf"></div><div class="titlediv">'+album[i]['title']+'</div> </div><div class="contentdescription">'+album[i]['description']+' </div><div class="contentfeatureandpublishdate">'+isfeature+'<div class="contentpublishdate">'+album[i]['date']+'</div></div></div></li>');
                }
        },
        statusCode: {
            404: function() {
                alert('There was a problem with the server.  Try again soon!');
            }
        }
    });

</script>