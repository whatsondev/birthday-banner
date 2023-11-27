<?php

/**
 * ajax -> posts -> story

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
try {

  // initialize the return array
    $return = array();
    // $bd = $GET['id'];
    $bdd= $user->birthdays();
    $smarty->assign('bdd', $bdd);

    $return['interest_publisher'] = $smarty->fetch("ajax.birthday.wish.tpl");
    $return['callback'] = "$('#modal').modal('show'); $('.modal:last').html(response.interest_publisher);";
       
  // return & exit
  return_json($return);
} catch (Exception $e) {
  modal("ERROR", __("Error"), $e->getMessage());
}
