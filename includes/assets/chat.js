/* chat */

$("body").on("click", ".js_chat-start", function (e) {
  /* get data from (header conversation feeds || chat sidebar) */
  /* mandatory */
  var user_id = $(this).data("uid") || false;
  var conversation_id = $(this).data("cid") || false;
  /* optional */
  var name = $(this).data("name");
  var name_list = $(this).data("name-list") || name;
  var multiple = $(this).data("multiple") ? true : false;
  var link = $(this).data("link");
  /* load previous conversation */
  /* check if the viewer in the messages page & open already conversation */
  if (window.location.pathname.indexOf("messages") != -1 && conversation_id) {
    e.preventDefault();
    $(".js_conversation-container").html(
      '<div class="loader loader_medium pr10"></div>'
    );
    $.getJSON(
      api["conversation/get"],
      { conversation_id: conversation_id },
      function (response) {
        /* check the response */
        if (response.callback) {
          eval(response.callback);
        } else {
          $(".js_conversation-container").html(response.conversation_html);
          $(".panel-messages").attr(
            "data-color",
            response.conversation.color
          );
          color_chat_box($(".panel-messages"), response.conversation.color);
        }
      }
    ).fail(function () {
      modal("#modal-message", {
        title: __["Error"],
        message: __["There is something that went wrong!"],
      });
    });
  } else {
    /* check if chat disabled or opened from mobile */
    if (!chat_enabled || $(window).width() < 970) {
      // Desktops (≥992px)
      /* chat dissabled or mobile view */
      if (conversation_id) {
        /* conversation_id is set so return (return will allow default behave of anchor tag) */
        return;
      } else {
        e.preventDefault();
        $.getJSON(
          api["conversation/check"],
          { uid: user_id },
          function (response) {
            /* check the response */
            if (!response) return;
            if (response.callback) {
              eval(response.callback);
            } else {
              if (response.conversation_id) {
                window.location =
                  site_path + "/messages/" + response.conversation_id;
              } else {
                window.location = site_path + "/messages/new?uid=" + user_id;
              }
            }
          }
        ).fail(function () {
          modal("#modal-message", {
            title: __["Error"],
            message: __["There is something that went wrong!"],
          });
        });
      }
    } else {
      /* desktop view */
      e.preventDefault();
      /* load chat-box */
      chat_box(user_id, conversation_id, name, name_list, multiple, link);
    }
  }
});

$("body").on("click", ".js_chat-startt", function (e) {
  /* get data from (header conversation feeds || chat sidebar) */
  /* mandatory */
  var user_id = $(this).data("uid") || false;
  var conversation_id = $(this).data("cid") || false;
  /* optional */
  var name = $(this).data("name");
  console.log(user_id+conversation_id);
  /* load previous conversation */
  /* check if the viewer in the messages page & open already conversation */
  $.post(
  api["chat/send_wish"],
    { 
      user_id: user_id, 
      conversation_id: conversation_id,
    },
    function (response) {
     
      /* check the response */
      if (response.callback) {
        eval(response.callback);
      }
      else{
        window.location.reload();
      }
      
    },
    "json"
  ).fail(function () {
    modal("#modal-message", {
      title: __["Error"],
      message: __["There is something that went wrong!"],
    });
  });
  //add new code 

  var name = $(this).data("name");
  var name_list = $(this).data("name-list") || name;
  var multiple = $(this).data("multiple") ? true : false;
  var link = $(this).data("link");
  /* load previous conversation */
  /* check if the viewer in the messages page & open already conversation */
  if (window.location.pathname.indexOf("messages") != -1 && conversation_id) {
    e.preventDefault();
    $(".js_conversation-container").html(
      '<div class="loader loader_medium pr10"></div>'
    );
    $.getJSON(
      api["conversation/get"],
      { conversation_id: conversation_id },
      function (response) {
        /* check the response */
        if (response.callback) {
          eval(response.callback);
        } else {
          $(".js_conversation-container").html(response.conversation_html);
          $(".panel-messages").attr(
            "data-color",
            response.conversation.color
          );
          color_chat_box($(".panel-messages"), response.conversation.color);
        }
      }
    ).fail(function () {
      modal("#modal-message", {
        title: __["Error"],
        message: __["There is something that went wrong!"],
      });
    });
  } else {
    /* check if chat disabled or opened from mobile */
    if (!chat_enabled || $(window).width() < 970) {
      // Desktops (≥992px)
      /* chat dissabled or mobile view */
      if (conversation_id) {
        /* conversation_id is set so return (return will allow default behave of anchor tag) */
        return;
      } else {
        e.preventDefault();
        $.getJSON(
          api["conversation/check"],
          { uid: user_id },
          function (response) {
            /* check the response */
            if (!response) return;
            if (response.callback) {
              eval(response.callback);
            } else {
              if (response.conversation_id) {
                window.location =
                  site_path + "/messages/" + response.conversation_id;
              } else {
                window.location = site_path + "/messages/new?uid=" + user_id;
              }
            }
          }
        ).fail(function () {
          modal("#modal-message", {
            title: __["Error"],
            message: __["There is something that went wrong!"],
          });
        });
      }
    } else {
      /* desktop view */
      e.preventDefault();
      /* load chat-box */
      chat_box(user_id, conversation_id, name, name_list, multiple, link);
    }
  }
  // console.log(user_id+conversation_id);
});
