<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$class = '';
if (!is_single()) {
	$class = 'danh-sach';
}
?>

<article <?php post_class($class); ?> id="post-<?php the_ID(); ?>">

	<?php
	// Gọi entry-header như bình thường.
	// entry-header.php sẽ tự biết cách định dạng khi là single post nhờ class mới.
	get_template_part('template-parts/entry-header');

	if (!is_search()) {
		get_template_part('template-parts/featured-image');
	}

	?>

	<!-- PHẦN MÀU ĐỎ: Nội dung bài viết -->
	<!-- Thêm wrapper mới cho phần nội dung chỉ khi là bài viết chi tiết -->
	<?php if (is_single()): ?>
		<div class="single-post-content-wrapper">
		<?php endif; ?>

		<div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?>">
			<div class="entry-content">
				<?php
				if (is_search() || (!is_singular() && 'summary' === get_theme_mod('blog_content', 'full'))) {
					the_excerpt();
				} elseif (is_single()) { // Đây là nội dung chính của bài viết chi tiết
					the_content(__('Continue reading', 'twentytwenty'));
				} else {
					// Hiện danh sách bài viết giới hạn 30 từ
					echo wp_trim_words(get_the_content(), 30, '...');
					?>
					<a class="read-more" href="<?php the_permalink(); ?>">Xem thêm »</a>
					<?php
				}
				?>
			</div><!-- .entry-content -->
		</div><!-- .post-inner -->

		<?php if (is_single()): ?>
		</div> <!-- Kết thúc single-post-content-wrapper -->
	<?php endif; ?>


	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before' => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__('Page', 'twentytwenty') . '"><span class="label">' . __('Pages:', 'twentytwenty') . '</span>',
				'after' => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after' => '</span>',
			)
		);

		edit_post_link();

		// Single bottom post meta.
		// Vẫn giữ lại meta footer, bạn có thể CSS ẩn nó đi nếu không cần.
		twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');

		if (post_type_supports(get_post_type(get_the_ID()), 'author') && is_single()) {

			get_template_part('template-parts/entry-author-bio');

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if (is_single()) {

		get_template_part('template-parts/navigation');

	}

	/*
	 * Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 */
	if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->