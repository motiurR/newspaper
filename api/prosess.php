
<?php
include_once('inc/dbConnect.inc.php');
       $max_min_query="select min(id) as min,max(id) as max from poll_question";
       $max_min_res=mysql_query($max_min_query);
       $check=mysql_num_rows($max_min_res);
       global $maxId;
       global $minId;
       if($check > 0){
          $max_min_result=mysql_fetch_array($max_min_res);
          $maxId=$max_min_result['max'];
          $minId=$max_min_result['min'];
       }
 mysql_query('SET CHARACTER SET utf8'); 
 mysql_query("SET SESSION collation_connection ='utf8_general_ci'");

if(isset($_POST['type']) && $_POST['type']=='addPoll'){
      $id=$_POST['id'];
      $qid=$_POST['qid'];
      addPoll($id,$qid);

}elseif(isset($_POST['type']) && $_POST['type']=='viewPoll'){
      $id=$_POST['id'];
      showPollResult($id,'',$maxId,$minId);
}else{
    if(isset($_POST['type']) && $_POST['type']=='showPoll'){
            $id=$_POST['id'];
            $condition=' where id = '. $id;
      }else{
           $condition='limit 1';
      }
      $queryQuestion="select * from poll_question where status='1'". $condition;

      $resQuestion=mysql_query($queryQuestion);
      $countQuestion=mysql_num_rows($resQuestion);
      if($countQuestion > 0){
            $questiont=mysql_fetch_array($resQuestion);
            $id=$questiont['id'];
            if(isset($_COOKIE['poll_done'."_".$id])){

                 showPollResult($id,'already_done',$maxId,$minId);;
            }else{
                  $question=$questiont['question'];

                  $html='<div id="pollBox"><span style="font-size:25px;" id="question">'.$question.'</span><br/><br/>';
                  $queryPoll="select `id`,`option` from poll_option where poll_id='$id'";
                  $resPoll=mysql_query($queryPoll);
                  $countPoll=mysql_num_rows($resPoll);
                  if($countPoll > 0){
                       while($pollOption=mysql_fetch_array($resPoll)){
                             $html.='<div class="option"><input type="radio" name="pollOption" id="pollOption" value="'.$pollOption['id'].'"> <span style="font-size:23px;">'.$pollOption['option'].'</span></div>';
                       }

                      $html.='<input style="font-size:20px;margin-top:20px;" type="button" onclick=submitPoll("'.$id.'") class="button" value="Submit">';

                  }else{
                       $html.= 'No Option Found';
                  }
                  echo $html;
            }
      }else{
             echo 'No Question Found';
      }

}

function addPoll($id,$qid){
      $query="update poll_option set click=click+1 where id='$id'";
      mysql_query($query);
      
      $expire=time()+60*60*24*30;
      setcookie("poll_done"."_".$qid, "poll_done"."_".$qid, $expire);
}

function showPollResult($id,$type,$maxId,$minId){
      $queryQuestion="select question from poll_question where id='$id'";
      $resQuestion=mysql_query($queryQuestion);
      $questiont=mysql_fetch_array($resQuestion);
      $question=$questiont['question'];

      $queryTCQ="select sum(click) as totalClick from  poll_option where poll_id='$id'";
      $resTCQ=mysql_query($queryTCQ);
      $resultTCQ=mysql_fetch_array($resTCQ);
      $totalClick=$resultTCQ['totalClick'];

      $html='<div id="pollBox"><span style="font-size:25px;" id="question">'.$question.'</span><br/><br/>';
      
      $queryPoll="select `click`,`option` from poll_option where poll_id='$id'";
      $resPoll=mysql_query($queryPoll);
      while($pollOption=mysql_fetch_array($resPoll)){

          $click=$pollOption['click'];
          if($totalClick > 0){
               $percentageSize= ($click * 100) /  $totalClick;
          }else{
               $backgroundSize=0;
          }

          $html.='<div class="option" style="font-size:20px;"><div $percentageSize> </div> ('.$click.' ভোট) '. $pollOption['option'].'</div>';
      }

      /*total vot count show*/
      $html.='<div><span style="font-size:30px;padding-top:50px;" id="question">মোট ভোট : '.$totalClick.'</span>';

      $html.='<span id="refresh"></span></div>';


      echo $html;
}
?>