
<div class="container containerr">
    <div class="background-imagee">
        <div class="image-roww" >

        {foreach $bd as $b_user}
         <div class="textwrap">
         <span class="js_user-popover" data-type="{$b_user['user_type']}" data-uid="{$b_user['user_id']}">
         {if $b_user['user_picture'] != null}
           <a href="https://whatson.plus/{$b_user['user_name']}" target="_blank"> <img src="https://whatson.plus/content/uploads/{$b_user['user_picture']}" alt="Image 1" class="circle-imagee"></a>
         {else }
            {if $b_user['user_gender']==2}
            <a href="https://whatson.plus/{$b_user['user_name']}" target="_blank"> <img src="https://whatson.plus/content/themes/default/images/blank_profile_female.svg" alt="Image 1" class="circle-imagee"></a>
            {else}
            <a href="https://whatson.plus/{$b_user['user_name']}" target="_blank"> <img src="https://whatson.plus/content/themes/default/images/blank_profile_male.svg" alt="Image 1" class="circle-imagee"></a>
            {/if}
         {/if}
           </span>
           </div>
        {/foreach}
        </div>
      
    </div>
</div>


