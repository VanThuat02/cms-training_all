<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
$has_sidebar_11 = is_active_sidebar('sidebar-11');
$has_sidebar_12 = is_active_sidebar('sidebar-12');
?>

<main id="site-content" class="site-main">
	<div class="layout-wrapper">
		<!-- CỘT TRÁI: Archive -->
		<aside class="sidebar-left">
			<?php if (is_active_sidebar('sidebar-11')): ?>
				<div class="widget-categories">
					<?php dynamic_sidebar('sidebar-11'); ?>
				</div>

			<?php endif; ?>
		</aside>

		<div class="post-list">
			<!-- Search Header -->
			<?php if (is_search()): ?>
				<div class="search-header" style="margin: 20px 0; text-align: center;">
					<h2 >
						Search: "<span><?php echo get_search_query(); ?></span>"
					</h2>
					<?php if (!have_posts()): ?>
						<p style="color: #666;">We could not find any results for your search. You can try it again through the
							form below.</p>
						<div class="search-wrapper">
							<div class="search-form-wrapper" >
								<!-- Bootstrap-inspired search form (adapted from snippet) -->
								<form class="card card-sm search-form-custom" role="search" method="get"
									action="<?php echo home_url('/'); ?>">
									<div class="card-body row no-gutters align-items-center">
										<div class="col-auto">
											<i class="fas fa-search h4 text-body"></i>
										</div>
										<!--end of col-->
										<div class="col">
											<input class="form-control form-control-lg form-control-borderless" type="search"
												name="s" placeholder="Search topics or keywords"
												value="<?php echo get_search_query(); ?>"><i class="fa-solid fa-magnifying-glass"></i>
										</div>
										<!--end of col-->
										<div class="col-auto">
											<button class="btn btn-lg btn-success" type="submit">Search</button>
										</div>
										<!--end of col-->
									</div>
								</form>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if (have_posts()): ?>
				<?php while (have_posts()):
					the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>

						<!-- Ảnh thumbnail -->
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php
								if (has_post_thumbnail()) {
									the_post_thumbnail('medium');
								} else {
									echo '<img src="https://via.placeholder.com/280x180?text=No+Image" alt="No image">';
								}
								?>
							</a>
						</div>

						<!-- Cột ngày -->
						<div class="post-date">
							<span class="day"><?php echo get_the_date('d'); ?></span>
							<span class="month"><?php echo strtoupper(get_the_date('M')); ?></span>
							<span class="year"><?php echo get_the_date('Y'); ?></span>
						</div>

						<!-- Nội dung -->
						<div class="post-content">
							<div class="post-category"><?php the_category(', '); ?></div>

							<h2 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<div class="post-meta">
								<span class="author">Bởi <?php the_author(); ?></span> |
								<span
									class="comments"><?php comments_number('0 bình luận', '1 bình luận', '% bình luận'); ?></span>
							</div>

							<div class="post-excerpt">
								<?php the_excerpt(); ?>
							</div>
						</div>

					</article>

				<?php endwhile; ?>

				<!-- Pagination -->
				<div class="pagination">
					<?php the_posts_pagination(array(
						'mid_size' => 2,
						'prev_text' => __('« Trước'),
						'next_text' => __('Sau »'),
					)); ?>
				</div>



			<?php endif; ?>

		</div>

		<!-- CỘT PHẢI: Coment -->
		<aside class="sidebar-left">
			<?php if (is_active_sidebar('sidebar-12')): ?>
				<div class="widget-categories">
					<?php dynamic_sidebar('sidebar-12'); ?>
				</div>

			<?php endif; ?>
		</aside>
	</div> <!-- layout-wrapper -->

</main>