<!-- Preload Effect -->
<div id="overlayer">
	<div class="loader_boostify">
		<span class="loader-inner"></span>
		<div class="loader-content">
			<div class="img-wrapper">
                <?php $image_preload = get_theme_mod( 'image_preload_setting_url', '' ); ?>
                <img src="<?php echo esc_url( $image_preload ); ?>" alt="Icon Loader">
			</div>
		</div>
	</div>
</div>



