<?php


/**
 * @file
 * Contains \Drupal\links_example\Controller\LinksExampleController
 */

namespace Drupal\links_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class LinksExampleController extends ControllerBase
{
    public function links()
    {
        //Link to /admin/structure/blocks.
        $url1 = Url::fromRoute('block.admin_display');
        $link1 = Link::fromTextAndUrl(t('Go to the Block admin page'), $url1);
        $list[] = $link1;
 
        //Link to /admin/content
        $url2 = Url::fromRoute('system.admin_content');
        $link2 = Link::fromTextAndUrl(t('Go to the content admin page'), $url2);
        $list[] = $link2;

        //Link to /admin/people
        $url3 = Url::fromRoute('entity.user.collection');
        $link3 = Link::fromTextAndUrl(t('Go to the user admin page'), $url3);
        $list[] = $link3;

        //Link to the front page      
        $url4 = Url::fromRoute('<front>');
        $link4 = Link::fromTextAndUrl(t('Go to the front page of our site'), $url4);
        $list[] = $link4;
        
        //Link to external site      
        $url5 = Url::fromUri('https://drupal.org');
        $link_options = [
            'attributes'=> [
                'target' => '_blank',
                'title' => 'Link to Drupal official home page',
            ],
        ];
        $url5->setOptions($link_options);
        $link5 = Link::fromTextAndUrl(t('Go to the Drupal.org site'), $url5);
        $list[] = $link5;

        // mout the render output
        $output['links_example'] = [
            '#theme' => 'item_list',
            '#items' => $list,
            '#items' => $this->t('Example of links in Drupal 9:'),
        ];
        return $output;
    }

}