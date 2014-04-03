<ul class="stepIndicator current-$CurrentStep.class">
<% loop AllStepsLinear %>
	<li class="$ClassName<% if LinkingMode %> $LinkingMode<% end_if %><% if FirstLast %> $FirstLast<% end_if %>">
		<% if LinkingMode = link %><% if $ID != 0 %><a href="{$Top.URLSegment}/?MultiFormSessionID={$session.Hash}&amp;StepID={$ID}"><% end_if %><% end_if %>
		<% if Title %>$Title<% else %>$ClassName<% end_if %>
		<% if LinkingMode = link %><% if $ID != 0 %></a><% end_if %><% end_if %>
	</li>
<% end_loop %>
</ul>