<?php

/**
 * ajax -> chat -> post

 */

// fetch bootstrap
require('../../../bootstrap.php');

// check AJAX Request
is_ajax();

// user access
user_access(true);

// check demo account
if ($user->_data['user_demo']) {
  modal("ERROR", __("Demo Restriction"), __("You can't do this with demo account"));
}

if (!isset($_POST['user_id'])) {
  _error(400);
}

try {
    $_POST['message']="Happy Birthday Friend!";
    $_POST['photo']="photos/2023/10/bdd.gif";
    $_POST['voice_note']=null;
    $_POST['conversation_id']=$_POST['conversation_id'];
    $_POST['recipients']=$_POST['user_id'];
 
  $conversation = $user->post_conversation_message_wish($_POST['message'], $_POST['photo'], $_POST['voice_note'], $_POST['conversation_id'], $_POST['recipients']);

  return_json($conversation);
} catch (Exception $e) {
  modal("ERROR", __("Error"), $e->getMessage());
}
