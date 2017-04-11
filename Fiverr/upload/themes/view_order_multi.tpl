{if $smarty.session.USERID GT "0"}
    {if $p.scriptolution_add_multiple GT "0"}
        {if $smarty.session.USERID ne $p.USERID}  
            {literal}
            <script language="javascript" type="text/javascript">
            function showbuymore() 
            {										
            $('#buyone').hide();
            $('#buymore').show();
            $('#buymore2').show();
            }
            function showbuyone() 
            {										
            $('#buymore').hide();
            $('#buymore2').hide();
            $('#buyone').show();
			ddl = document.getElementById("multi");
			ddl.value = 1;
            }
            </script>
            {/literal}
            <div style="clear:both;"></div>
            <div id="buyone" style="float:right; margin-top:-20px;">
            <a href="#" onclick="showbuymore();" style="color:#C60;">{$lang485}</a>
            </div>
            <div id="buymore" style="float:right; margin-top:-20px; display:none;">
            <a href="#" onclick="showbuyone();" style="color:#C60;">{$lang486}</a>
            </div>
            <div id="buymore2" style="float:right; display:none;">
            <form name="ordermulti" id="ordermulti" action="{$baseurl}/ordering.php" method="post">
            {$lang487} <select id="multi" name="multi">
            {section name=i start=1 loop=$p.scriptolution_add_multiple+1}
            <option value="{$smarty.section.i.index}">{$smarty.section.i.index}</option>
            {/section}
            </select> {$lang488}
            <input type="hidden" name="id" value="{$p.PID}" />
            </form>
            </div>
        {/if}
    {else}
    <form name="ordermulti" id="ordermulti" action="{$baseurl}/ordering.php" method="post">
    <input type="hidden" name="id" value="{$p.PID}" />
    </form>
    {/if}
{/if}