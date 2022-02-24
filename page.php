<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 */

get_header(); ?>

	<video id="home-screen-video" loop autoplay muted onclick="homeScreenClose()">
		<source src="<?php echo get_field('home_screen_video'); ?>" type="video/mp4">
	</video>

	<div class="bg" id="main-map">

		<?php
		$markers = get_field('map_points');
		if($markers):
			foreach($markers as $marker):?>
				<div class="marker-container" style="left:<?php echo $marker['marker_x']; ?>px; top:<?php echo $marker['marker_y']; ?>px;">
					<img onclick="openModal(<?php echo $marker['marker_slide_id']; ?>)" class="marker-image" src="<?php echo $marker['marker_image']; ?>"/>	
					<?php if($marker['name_position'] == "left"): ?>
						<p class="marker-title" style="right: 105%; text-align: right;"><?php echo $marker['marker_name']; ?></p>
					<?php else: ?>
						<p class="marker-title" style="left: 105%; text-align: left;"><?php echo $marker['marker_name']; ?></p>
					<?php endif; ?>
					<!-- Hidden values -->
					<span class="x-val"><?php echo $marker['marker_x']; ?></span>
					<span class="y-val"><?php echo $marker['marker_y']; ?></span>
				</div>
				
			<?php endforeach; ?>
		<?php endif; ?>
		
		<div class="close cursor icon-button" onclick="homeScreenOpen()">
			<img src="<?php echo get_field('home_button'); ?>"/>
		</div>

		<?php
		$legends = get_field('legend_points');
		if($legends):?>
			<div class="legend-container">
			<?php foreach($legends as $legend):?>
				<div class="legend-line">
					<div class="legend_marker_container">
						<img onlick="changeMap(<?php echo $legend['map_image_change']; ?>)" src="<?php echo $legend['legend_marker_image']; ?>"/>
					</div>
					<p><?php echo $legend['legend_marker_title']; ?></p>
				</div>				
			<?php endforeach; ?>
				<div class="legend_footer">
					<div class="legend_footer_text">
						<h1><?php echo get_field('legend_header'); ?></h1>
						<p><?php echo get_field('legend_sub_header'); ?></p>
					</div>
					<div class="qr_code_image">
						<img src="<?php echo get_field('legend_qr_code'); ?>" alt="qr code">
					</div>
				</div>
			</div>
		<?php endif; ?>


	</div>


	<?php
	$slides = get_field('slides');
	if($slides):
		foreach($slides as $slide):?>
			<div id="myModal-<?php echo $slide['slide_id']; ?>" class="modal" style="background-image:url('<?php echo $slide['slide_image']; ?>');">
				<div class="slide-content">
					<h1 class="slide-header"><?php echo $slide['header_title']; ?></h1>
					<p class="slide-sub-header"><?php echo $slide['sub_header']; ?></p>								

					<div id="fade-<?php echo $slide['slide_id']; ?>" class="light-fade">
						<div id="light-<?php echo $slide['slide_id']; ?>" class="light-container">
							<?php if($slide['media_type']=="Video"): ?>
								<video class="light-content" id="light-video-<?php echo $slide['slide_id']; ?>" loop>
									<source src="<?php echo $slide['slide_video']; ?>" type="video/mp4">
								</video>
							<?php else: ?>
								<img class="light-content" src="<?php echo $slide['slide_light_image']; ?>" alt="Image"/>
							<?php endif; ?>
						</div>		
					</div>

					<div class="slide-icon">
						<img onclick="lightbox_open(<?php echo $slide['slide_id']; ?>);" src="<?php echo $slide['icon']; ?>" alt="Icon"/>
					</div>
				</div>
					
				
				<div class="close cursor icon-button light-close" id="light-close-<?php echo $slide['slide_id']; ?>"
				onClick="lightbox_close(<?php echo $slide['slide_id']; ?>);">
					<img src="<?php echo get_field('exit_button'); ?>"/>
				</div>

				<div class="close cursor icon-button" onclick="closeModal(<?php echo $slide['slide_id']; ?>)">
					<img src="<?php echo get_field('exit_button'); ?>"/>
				</div>

			</div>
		<?php endforeach; ?>
	<?php endif; ?>


<?php get_footer(); ?>