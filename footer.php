
				<!-- #mainCollumn -->
				</div>
				<?php get_sidebar(); ?>
			<!-- .main-container -->
			</div>
		<!-- .content-inner -->
		</div>
	<!-- #container -->
	</div>


	<footer id="footer" class="globalFooter">
		<div class="content-inner">
			<div class="globalFooter__widgets">
				<?php if ( ! dynamic_sidebar( 'footbar-1' ) ) ; ?>
				<?php if ( ! dynamic_sidebar( 'footbar-2' ) ) ; ?>
				<?php if ( ! dynamic_sidebar( 'footbar-3' ) ) ; ?>
			</div>
			<div class="globalFooter__menu">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
			</div>
	    </div>
		<p class="copyright">Copyright <?php bloginfo('name'); ?> All Rights Reserved.</p>
	<!-- #footer -->
	</footer>

	<div id="goTop">
		<div class="gotop">
			<span class="ov"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
		</div>
	</div>

<!-- #wrapper -->
</div>


<?php if( wp_is_mobile() ) get_template_part( 'include/menu' );  ?>


<?php wp_footer(); ?>
</body>
</html>
