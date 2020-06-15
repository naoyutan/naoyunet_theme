<input class="toggler" type="checkbox" autocomplete="off" id="toggle_menu-check">
<label for="toggle_menu-check" class="toggle-overlay"></label>

<div class="toggle-menu-switch">
	<label for="toggle_menu-check">
		<i class="fas fa-search"></i>
		<i class="fas fa-times"></i>
	</label>
</div>

<div id="toggle-global_menu">
	<div class="navi">
		<div class="navi-inner">
			<?php if ( ! dynamic_sidebar( 'footbar-1' ) ) ; ?>
			<?php if ( ! dynamic_sidebar( 'footbar-2' ) ) ; ?>
			<?php if ( ! dynamic_sidebar( 'footbar-3' ) ) ; ?>
		</div>
	</div>
</div>
