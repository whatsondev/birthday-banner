<?php

 /**
   * Birthday Banner
   * 
   * @return array
   */
 /* birthday count to json */
  public function birthdays(){
    global $db;
  
    $picture=[];
    global $gender;
    $url=[];
    $name=[];
    $notification=[];
    $friends = [];
    global $date;
    $bd = $db->query("SELECT * from users where user_privacy_birthdate != 'me' and DAY(user_birthdate) = DAY(CURDATE()) and MONTH(user_birthdate) = MONTH(CURDATE())") or _error("SQL_ERROR_THROWEN");
    if ($bd->num_rows == 0) {
      return false;
    }
    $i=0;
    if ($bd->num_rows > 0) {
      while ($video = $bd->fetch_assoc()) {
        $i++;
      
       
        $message = $video['user_name']." happy birthday! ";
        $picture= $video['user_picture'];
        $gender= $video['user_gender'];
        $email= $video['user_email'];
        $date = date("l jS \of F Y ");
        $url[$i]=$video['user_name'];
        $urll = $video['user_name'];
        $name[$i] = $video['user_firstname']." ".$video['user_lastname'];
        if($picture != null){
                  $picture = "https://whatson.plus/content/uploads/".$picture[$i];
                  $video['user_picture']=$video['user_picture'];
                }
                else{
                  if($gender== 1){
                    $picture = 'https://whatson.plus/content/uploads/photos/2021/04/sngine_33ac77a5727c7ca79b07c23f8df291db.png';
                    $video['user_picture']='photos/2021/04/sngine_33ac77a5727c7ca79b07c23f8df291db.png';
                  }
                  else 
                  $picture= 'https://whatson.plus/content/uploads/photos/2021/04/sngine_33ac77a5727c7ca79b07c23f8df291db.png';
                  $video['user_picture']='photos/2021/04/sngine_33ac77a5727c7ca79b07c23f8df291db.png';
        
                } 
                $videos[] = $video;
      }
    return $videos;

  }
}

 /* birthday post to wall */
public function post_birthdays($user_id){
  global $db,$date;
  $text = "Happy Birthday..!";
 
$db->query(sprintf("INSERT INTO posts (user_id, user_type, in_wall,wall_id ,post_type,privacy,text, time) VALUES (%s, 'user','1',%s,'wish','public',%s , %s)", secure($this->_data['user_id'], 'int'),secure($user_id, 'int'),secure($text),secure($date))) or _error("SQL_ERROR_THROWEN");
$post_id = $db->insert_id;

$this->post_notification(array('to_user_id' => $user_id, 'action' => 'wall', 'node_type' => 'post', 'node_url' => $post_id ,'date'=>$date));

}
 /* birthday message to the birthday boy/girl */
public function post_conversation_message_wish($message, $image, $voice_note, $conversation_id = null, $recipients = null)
{
  global $db, $system, $date;

  $hashtags = [];
  $con_id=null;
  
  $get_id = $db->query(sprintf(" SELECT conversation_id,user_id from conversations_users where conversation_id in (SELECT conversation_id FROM `conversations_users` WHERE user_id=%s) and user_id=%s", secure($this->_data['user_id'], 'int'), secure($recipients, 'int'))) or _error("SQL_ERROR_THROWEN");
  if ($get_id->num_rows > 0) {
    while ($conid = $get_id->fetch_assoc()) {
      $conversation_id = $conid['conversation_id'];
    }
  }
  else{
    $db->query("INSERT INTO conversations (last_message_id) VALUES ('0')") or _error("SQL_ERROR_THROWEN");
    $conversation_id = $db->insert_id;
    /* insert the sender (viewer) */
    $db->query(sprintf("INSERT INTO conversations_users (conversation_id, user_id, seen) VALUES (%s, %s, '1')", secure($conversation_id, 'int'), secure($this->_data['user_id'], 'int'))) or _error("SQL_ERROR_THROWEN");
    /* insert recipients */
    $db->query(sprintf("INSERT INTO conversations_users (conversation_id, user_id) VALUES (%s, %s)", secure($conversation_id, 'int'), secure($recipients, 'int'))) or _error("SQL_ERROR_THROWEN");
    $con_id=$conversation_id;
  }

  $db->query(sprintf("INSERT INTO conversations_messages (conversation_id, user_id, message, image, voice_note, time) VALUES (%s, %s, %s, %s, %s, %s)", secure($conversation_id, 'int'), secure($this->_data['user_id'], 'int'), secure($message), secure($image), secure($voice_note), secure($date))) or _error("SQL_ERROR_THROWEN");
  $message_id = $db->insert_id;
  $db->query(sprintf("UPDATE conversations SET last_message_id = %s WHERE conversation_id = %s", secure($message_id, 'int'), secure($conversation_id, 'int'))) or _error("SQL_ERROR_THROWEN");
  /* update sender (viewer) with last message id */
  $db->query(sprintf("UPDATE users SET user_live_messages_lastid = %s WHERE user_id = %s", secure($message_id, 'int'), secure($this->_data['user_id'], 'int'))) or _error("SQL_ERROR_THROWEN");
  /* get conversation */
  $conversation = $this->get_conversation($conversation_id);
  /* update all recipients with last message id & only offline recipient messages counter */
  $db->query(sprintf("UPDATE users SET user_live_messages_lastid = %s, user_live_messages_counter = user_live_messages_counter + 1 WHERE user_id = %s", secure($message_id, 'int'), secure($recipients, 'int'))) or _error("SQL_ERROR_THROWEN");
  /* update typing status of the viewer for this conversation */
  $is_typing = '0';
  $db->query(sprintf("UPDATE conversations_users SET typing = %s WHERE conversation_id = %s AND user_id = %s", secure($is_typing), secure($conversation_id, 'int'), secure($this->_data['user_id'], 'int'))) or _error("SQL_ERROR_THROWEN");
  

  return 0;
}


?>
