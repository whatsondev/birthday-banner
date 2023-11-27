
<div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">{__("People Who have birthdays today")}</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              {if $bdd}
                <ul>
                  {foreach $bdd as $_user}
                    {include file='__feeds_user.tpl' _tpl="list" _connection="send-wish"}
                  {/foreach}
                </ul>

              {else}
                <p class="text-center text-muted">
                  {__("No people voted for this")}
                </p>
              {/if}
        </div>
    </div>
</div>
