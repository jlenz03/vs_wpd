<?php

namespace BookPlugin;

class BookMeta extends Singleton
{
    const PUBLISHER ='publisher';
    const DATE ='date';
    const PAGECOUNT ='pagecount';
    const PRICE ='price';


    protected static $instance;


    protected function __construct(){
        add_action('admin_init', array($this, 'registerMetaBoxes'));
        add_action('save_post_' . BookPostType:: POST_TYPE, array($this,'saveBookMeta'));
    }

    public function registerMetaBoxes(){
        add_meta_box(
            'book_about_meta',
            'About',
            array($this, 'aboutMetaBox'),
            BookPostType::POST_TYPE,
            'side');


        }

        public function aboutMetaBox(){
        //get current post and meta values
        $post = get_post();
        $publisher = get_post_meta($post->ID, self::PUBLISHER, true);
        $date = get_post_meta($post->ID, self::DATE, true);
        $pagecount = get_post_meta($post->ID, self::PAGECOUNT, true);
        $price = get_post_meta($post->ID, self::PRICE, true);

        ?>
            <div>
                <label for="publisher">Publisher:</label>
                <input type="text" name="publisher" id="publisher" value="<?= $publisher ?>">
            </div>

            <div>
                <label for="date">Date:</label>
                <input type="text" name="date" id="date" value="<?= $date ?>">
            </div>

            <div>
                <label for="pagecount">Page Count:</label>
                <input type="text" name="pagecount" id="pagecount" value="<?= $pagecount ?>">
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" value="<?= $price ?>">
            </div>


            <?php
        }
        public function saveBookMeta()
        {

//get the current post
            $post = get_post();
            //get and save each field individually
            if (isset($_POST['publisher'])) {
                $publisher = sanitize_text_field($_POST['publisher']);

                //insert/update database
                update_post_meta($post->ID, self::PUBLISHER, $publisher);
    }
            if (isset($_POST['date'])) {
                $date = sanitize_text_field($_POST['date']);

                //insert/update database
                update_post_meta($post->ID, self::DATE, $date);
            }
            if (isset($_POST['pagecount'])) {
                $pagecount = sanitize_text_field($_POST['pagecount']);

                //insert/update database
                update_post_meta($post->ID, self::PAGECOUNT, $pagecount);
            }

            if (isset($_POST['price'])) {
                $price = sanitize_text_field($_POST['price']);

                //insert/update database
                update_post_meta($post->ID, self::PRICE, $price);
            }
        }
}