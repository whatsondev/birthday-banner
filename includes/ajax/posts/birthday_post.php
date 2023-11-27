<?php

/**
 * ajax -> posts -> story
 * 
 * @package Sngine
 * @author Zamblek
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

// check if stories enabled
// if (!$system['stories_enabled']) {
//   modal("MESSAGE", __("Error"), __("This feature has been disabled by the admin"));
// }

try {

  // initialize the return array
    $return = array();
    $user_id = $_POST['user_id'];
    $bdd= $user->post_birthdays($user_id);
    $smarty->assign('bdd', $bdd);

    $return['callback'] = "window.location.reload();";
  // return & exit
  return_json($return);
} catch (Exception $e) {
  modal("ERROR", __("Error"), $e->getMessage());
}
