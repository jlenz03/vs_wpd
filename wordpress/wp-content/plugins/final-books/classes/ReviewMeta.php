<?php

namespace BookPlugin;

class ReviewMeta extends Singleton
{
    const NAME ='name';
    const LOCATION ='location';
    const RATING ='rating';
    const BOOK ='book';


    //name, state, rating, book title

    protected static $instance;


    protected function __construct(){
        add_action('admin_init', array($this, 'registerMetaBoxes'));
        add_action('save_post_' . ReviewPostType:: POST_TYPE, array($this,'saveReviewMeta'));
    }

    public function registerMetaBoxes(){
        add_meta_box(
            'review_directions_meta',
            'Directions',
            array($this, 'directionsMetaBox'),
            ReviewPostType::POST_TYPE,
            'side');


        }

        public function directionsMetaBox(){
        //get current post and meta values
        $post = get_post();
        $rating = get_post_meta($post->ID, self::RATING, true);
        $name = get_post_meta($post->ID, self::NAME, true);
        $location = get_post_meta($post->ID, self::LOCATION, true);
        $book = get_post_meta($post->ID, self::BOOK, true);
        //$bookid = get_post_meta($post->ID, self::BOOKID, true);
        ?>
            <div>
                <label for="rating">Rating:</label>
                <br>
                <select name="rating" id="rating" value="<?= $rating?>">
                    <option value="&starf;">&starf;</option>
                    <option value="&starf;&starf;">&starf;&starf;</option>
                    <option value="&starf;&starf;&starf;">&starf;&starf;&starf;</option>
                    <option value="&starf;&starf;&starf;&starf;">&starf;&starf;&starf;&starf;</option>
                    <option value="&starf;&starf;&starf;&starf;&starf;">&starf;&starf;&starf;&starf;&starf;</option>
                </select>
            </div>

            <div>
                <label for="name">Reviewer's Name:</label>
                <br>
                <input type="text" name="name" id="name" value="<?= $name ?>">
            </div>

            <div>
                <label for="location">Location:</label>
                <br>
                <input type="text" name="location" id="location" value="<?= $location ?>">
            </div>

            <div>
                <label for="book">Select a Book:</label>
                <br>
                <select name="book">
                    <option value="">Select a Book</option>
                    <?php
                    $books_query = new \WP_Query([
                        'post_type' => 'book',
                        'posts_per_page' => -1,
                    ]);

                    while ($books_query->have_posts()) {
                        $books_query->the_post();
                        $selected = ($book && $book == get_the_ID()) ? 'selected' : '';
                        ?>
                        <option value="<?php the_ID(); ?>" <?php echo $selected; ?>><?php the_title(); ?></option>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </select>
            </div>


            <?php
        }
        public function saveReviewMeta()
        {

//get the current post
            $post = get_post();
            //get and save each field individually
            if (isset($_POST['rating'])) {
                $rating = sanitize_text_field($_POST['rating']);

                //insert/update database
                update_post_meta($post->ID, self::RATING, $rating);
    }
            if (isset($_POST['name'])) {
                $name = sanitize_text_field($_POST['name']);

                //insert/update database
                update_post_meta($post->ID, self::NAME, $name);
            }

            if (isset($_POST['location'])) {
                $location = sanitize_text_field($_POST['location']);

                //insert/update database
                update_post_meta($post->ID, self::LOCATION, $location);
            }

            // Check if book ID is selected
            if (isset($_POST['book'])) {
                $book_id = intval($_POST['book']);
                // Get the book title from its ID
                $book_title = get_the_title($book_id);
                // Insert/update book title in database
                update_post_meta($post->ID, self::BOOK, $book_title);
            }

        }
}