 <li class="feeds-item" {if $_user['id']}data-id="{$_user['id']}" {/if}>
    <div class="data-container {if $_small}small{/if}">
      <a class="data-avatar" href="{$system['system_url']}/{$_user['user_name']}{if $_search}?ref=qs{/if}">
        
        <img src="{$_user['user_picture']}" alt="user">
        {if $_reaction}
          <div class="data-reaction">
            <div class="inline-emoji no_animation">
              {include file='__reaction_emojis.tpl' _reaction=$_reaction}
            </div>
          </div>
        {/if}
      </a>
      <div class="data-content">
        <div class="float-right">
          <!-- buttons -->
          {if $_connection == "send-wish"}
    
            <button type="button" class="btn btn-sm btn-success js_chat-startt" data-uid="{$_user['user_id']}" style="background-color:#fd7e14;border:none;" data-name="{if $system['show_usernames_enabled']}{$_user['user_name']}{else}{$_user['user_firstname']} {$_user['user_lastname']}{/if}" data-link="{$_user['user_name']}">
              <i class="fa fa-comment mr5"></i>{if $_small}{__("Chat")}{else}{__("Send Wish")}{/if}
            </button>
            <button type="button" class="btn btn-sm btn-success js_post-wall" data-uid="{$_user['user_id']}"  style="background-color:#6610f2;" data-name="{if $system['show_usernames_enabled']}{$_user['user_name']}{else}{$_user['user_firstname']} {$_user['user_lastname']}{/if}" data-link="{$_user['user_name']}">
              <i class="fa fa-comment mr5"></i>{if $_small}{__("Chat")}{else}{__("Post on wall")}{/if}
            </button>
            
         
{/if}
 </div>
          </div>
