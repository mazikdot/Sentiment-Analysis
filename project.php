<?php
$curl = curl_init();
if (isset($_POST['sendData'])) {
  $getData = $_POST['inputData'];
  $getData = preg_replace('/\s+/', '', $getData);
  //กรอกข้อมูลที่กรอกมาว่า : สวย
  //$getData = สวย
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.aiforthai.in.th/ssense?text={$getData}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Apikey: TKzZbc5iNX9ZCWOfDO85dk18KgUjjj6y"
    )
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $arr = json_decode($response);
    echo var_dump($arr);
  }

  // ------------------------------------------------------------------------------------------------------
  $curl2 = curl_init();
  $emoji = array(
    '😊', '😥', '😡', '😑', '😱', '😨', '😮', '😴', '😝', '😍', '😌', '😑', '😷', '😳', '😵', '💔', '😎', '😭', '😅', '😉', '💜', '😇'
  );
  curl_setopt_array($curl2, array(
    CURLOPT_URL => "https://api.aiforthai.in.th/emoji?text=" . urlencode("{$getData}"),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Apikey: TKzZbc5iNX9ZCWOfDO85dk18KgUjjj6y"
    )
  ));

  $response2 = curl_exec($curl2);
  $err2 = curl_error($curl2);
  curl_close($curl2);
  if ($err2) {
    echo "curl2 Error #: <br>" . $err2;
  } else {
    $arr2 = json_decode($response2, true);
  }
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,500;1,400&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>วิเคราะห์ความคิดเห็นของคำแล้วแสดงอีโมจิ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    body {
    background-image:url("3.jpg");
    background-repeat: no-repeat;
    background-size: 100% 100%;
    z-index: 0;
    position: sticky   

}
html {
    height: 100%
}
  </style>
</head>

<body style="font-family: 'Kanit', sans-serif;">
  <div class="card" style="background-color:#FEC200">
    <div style="background-color:#FEC200" class="card-body">
   
      <h1 class="text-center" style="color:white" >
       
      
      <marquee direction="left" Scrollamount=12>
      <img src="image3.png" alt="Trulli" width="50" height="50">   
      วิเคราะห์ความคิดเห็นของคำ และ ความรู้สึกของอิโมจิ
      <img src="image3.png" alt="Trulli" width="50" height="50">  
    </marquee>
      
    </h1>
      
    </div>
  </div>

  <div class="container">
    <form method="POST">
      <div class="form-group" style="color:#FFFFFF">
        <label class="mt-5" style="margin-bottom:10px;" for="inputData" >ช่องกรอกข้อมูลเพื่อทำการวิเคราะห์</label>
        <input type="text" class="form-control" id="inputData" name="inputData" aria-describedby="emailHelp" placeholder="กรอกข้อมูล">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>

      <button style="margin-top:20px;" name="sendData" type="submit" class="btn btn-info" ><p style="color:white; height: 17px;">ประมวลผล</p></button>
    </form>
    <div class="row">
    <hr  style="margin-top: 20px; color:white; border: 10px solid white;">
      <h3 class="text-center"><p style="color:	#FFFFFF;">ผลลัพธ์การวิเคราะห์</p></h3>
      
      <div class="col-sm-4">
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
          <div class="card-header" class="text-center">
            <p class="text-center">
              วิเคราะห์ความคิดเห็น<br>เชิงบวกหรือเชิงลบ
            </p>
          </div>
          <div class="card-body">
            <!-- <h5 class="card-title">Info card title</h5> -->
            <p class="card-text"><?php
                                  if (isset($_POST['sendData'])) {
                                
                                    echo " ร้อยละคะแนนความมั่นใจ : {$arr->sentiment->score} % <br> ขั้วอารมณ์ความคิดเห็น : {$arr->sentiment->polarity} ";
                                  } else {
                                    echo " ";
                                  }
                                  ?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <form method="POST">
          <button class="btn btn-danger" name="hiddenData" style="width:80%">ล้างข้อมูล</button>
        </form>
      </div>

      <div class="col-sm-4">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
          <div class="card-header">
            <p class="text-center">
              อิโมจิสื่อถึงข้อความ
            </p>
          </div>
          <div class="card-body">

            <p class="card-text"><?php
              if (isset($_POST['sendData'])) {
                                  foreach ($arr2 as $x => $val) {
                                    if ($x == 0) {
                                      echo "😊";
                                    }
                                    if ($x == 1) {
                                      echo "😥";
                                    }
                                    if ($x == 2) {
                                      echo "😡";
                                    }
                                    if ($x == 3) {
                                      echo "😑";
                                    }
                                    if ($x == 4) {
                                      echo "😱";
                                    }
                                    if ($x == 5) {
                                      echo "😨";
                                    }
                                    if ($x == 6) {
                                      echo "😮";
                                    }
                                    if ($x == 7) {
                                      echo "😴";
                                    }
                                    if ($x == 8) {
                                      echo "😝";
                                    }
                                    if ($x == 9) {
                                      echo "😍";
                                    }
                                    if ($x == 10) {
                                      echo "😌";
                                    }
                                    if ($x == 11) {
                                      echo "😑";
                                    }
                                    if ($x == 12) {
                                      echo "😷";
                                    }
                                    if ($x == 13) {
                                      echo "😳";
                                    }
                                    if ($x == 14) {
                                      echo "😵";
                                    }
                                    if ($x == 15) {
                                      echo "💔";
                                    }
                                    if ($x == 16) {
                                      echo "😎";
                                    }
                                    if ($x == 17) {
                                      echo "😭";
                                    }
                                    if ($x == 18) {
                                      echo "😅";
                                    }
                                    if ($x == 19) {
                                      echo "😉";
                                    }
                                    if ($x == 20) {
                                      echo "💜";
                                    }
                                    if ($x == 21) {
                                      echo "😇";
                                    }
                                  }
                                }
                                  ?></p>
          </div>
          
        </div>

      </div>

    </div>
    <hr style="color:white; border: 10px solid white;">

</body>

</html>