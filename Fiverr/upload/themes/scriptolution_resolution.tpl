{if $hide_catnav eq "0"}

{elseif $hide_catnav eq "1"}
	{literal}
    <script type="text/javascript">
	document.getElementById('scriptolution_floating_categories').style.display = 'none';
	</script>
    {/literal}
{elseif $hide_catnav eq "2"}
    {literal}
    <script type="text/javascript">
	var windowsize = $(window).width();	
	if (windowsize < 1423)
	{
		document.getElementById('scriptolution_floating_categories').style.display = 'none';
	}
	</script>
    {/literal}
{/if}