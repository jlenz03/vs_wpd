<?php
/**
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
* @var array $attributes
* @var string $contents
* @var WP_Block $block
 */

$query = new WP_Query([
	'post_type' => 'review',
	'orderby' => 'post_title',
	'order' => 'asc',
	'meta_key' => 'book',
	'meta_value' => get_the_title(),
]);
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php while($query->have_posts()):
	$query->the_post(); ?>
	<div class="review-card" style="background-color: <?= $attributes['cardColor'] ?>">
            <?php if ($attributes['showTitle']): ?>
                <h2 style="color: <?= $attributes['headingColor'] ?>"><?= get_the_title() ?></h2>
            <?php endif; ?>

            <?php if ($attributes['showBook']): ?>
                <p style="color: <?= $attributes['textColor'] ?>"><strong><?= get_post_meta(get_the_ID(), 'book', true) ?></strong></p>
            <?php endif; ?>
		<StarRating rating={rating} readonly></StarRating>

            <?php if ($attributes['showMeta']): ?>
                <div class="meta" style="color: <?= $attributes['textColor'] ?>">
                    <p><i class="fa-regular fa-user"></i><?= get_post_meta(get_the_ID(), 'name', true) ?><strong><?= get_post_meta(get_the_ID(), 'rating', true) ?></strong></p>
                    <p><?= get_post_meta(get_the_ID(), 'location', true) ?></p>
                </div>
            <?php endif; ?>

            <?php if ($attributes['showDescription']): ?>
                <div class="" style="color: <?= $attributes['textColor'] ?>">
                    <p><?= get_the_excerpt() ?></p>
                </div>
            <?php endif; ?>

            <?php if ($attributes['showButton']): ?>
                <div class="review-button">
                    <a style="color: <?= $attributes['linkColor'] ?>" href="<?= get_the_permalink() ?>">Read More</a>
                </div>
            <?php endif; ?>
        </div>

<?php endwhile; ?>
</div>
