<?php
/**
 * Plugin Name: paraphrase
 * Description: paraphrasing news
 * Author: Kendrick Elmo
 * Version: 1.0.0
 */

// if( !defined('ABSPATH'))
// {
//     echo 'teascsacs';
//     exit;
// }


class Paraphrase {
    public function __construct()
    {
        
        add_action('wp_enqueue_scripts', array($this, 'enqueue_ajax_script'));
        add_action('wp_ajax_handle_request', array($this, 'handleRequest'));
        add_action('wp_ajax_nopriv_handle_request', array($this, 'handleRequest'));
        
    }

    public function handleRequest()
    {
        global $wpdb;
        $links = $this->sindoGetNewsList();
        foreach ($links as $link) {
            $data = $this->sindoGetContents($link);
            $post_exists = $wpdb->get_var( $wpdb->prepare(
                "SELECT COUNT(*) FROM wp_posts WHERE post_title = %s",
                $data['title']
            ) );
            if ( $post_exists == 0 ) {
                $now = current_time( 'mysql' );
                $wpdb->insert(
                    $wpdb->posts,
                    array(
                        'post_author'           => 1,
                        'post_excerpt'          => '',
                        'post_date'             => $now,
                        'post_title'            => $data['title'],
                        'post_content'          => $data['detail'],
                        /* translators: Default post slug. */
                        'post_name'             => sanitize_title( _x( $data['title'], 'Default post slug' ) ),
                        'to_ping'               => '',
                        'pinged'                => '',
                        'post_content_filtered' => '',
                    )
                );
            }
            
        }

        wp_send_json_success('Action completed successfully.');
    }

    public function sindoGetNewsList()
    {
        $html = file_get_contents("https://international.sindonews.com/");
        $doc = new DomDocument();
        libxml_use_internal_errors(true);
        $doc->loadHtml($html);
        libxml_clear_errors();
        $xpath = new DomXPath($doc);
        $query = '/html/body/section[5]/div/div[1]/div[2]//a';
        $nodes = $xpath->query($query);
        $links = [];
        if (!is_null($nodes)) {
            foreach ($nodes as $node) {
                // Extract the href attribute
                $href = $node->getAttribute('href');
                // Make sure the href is not empty and is a valid URL
                if (!empty($href) && filter_var($href, FILTER_VALIDATE_URL)) {
                    $links[] = $href;
                }
            }
            return $links;
        } else {
            return $links;
        }
    }

    public function sindoGetContents($link)
    {
        $html = file_get_contents($link);
        $doc = new DomDocument();
        libxml_use_internal_errors(true);
        $doc->loadHtml($html);
        libxml_clear_errors();
        $xpath = new DomXPath($doc);
        $title = $this->sindoGetTitle('/html/body/div[5]/div[2]/div[2]/article/div[2]/h1',$xpath);
        $detail = $this->sindoGetDetail('//*[@id="detail-desc"]', $xpath);

        return array(
            'title' => $title,
            'detail' => $detail
        );
    }

    public function sindoGetTitle($location, $xpath)
    {

        $query = $xpath;
        $nodes = $xpath->query($location);
        $text = '';
        if (!is_null($nodes)) {
            foreach ($nodes as $node) {
                $text .= $node->textContent . "\n";
            }
            return $text;
        } else {
            return "";
        }
    }

    public function sindoGetDetail($location, $xpath)
    {

        $query = $xpath;
        $nodes = $xpath->query($location);
        $text = '';
        if (!is_null($nodes)) {
        foreach ($nodes as $node) {
            // Clone the node to keep the original intact
            $clonedNode = $node->cloneNode(true);
            
            // Remove all div elements inside the cloned node
            $divs = $clonedNode->getElementsByTagName('div');
            while ($divs->length > 0) {
                $divs->item(0)->parentNode->removeChild($divs->item(0));
            }

            // Get the text content of the cleaned node
            $text .= $clonedNode->textContent . "\n";
            return $text;
        }
        } else {
            return "";
        }
    }

    public function enqueue_ajax_script() {
        wp_enqueue_script('ajax-script', plugin_dir_url(__FILE__) . 'js/index.js', array('jquery'), null, true);
        wp_localize_script('ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }

}

new Paraphrase;