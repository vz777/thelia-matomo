<?php

namespace HookMatomoAnalytics\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Model\ConfigQuery;
use Thelia\Model\ProductQuery;
use Thelia\Model\ProductCategoryQuery;
use Thelia\Model\CategoryQuery;
use Thelia\Model\OrderQuery;

/**
 * Class FrontHook.
 *
 * @author ANIMAL <studio@animal.at>
 */
class FrontHook extends BaseHook
{
    protected $url;
    protected $website_id;

    public function __construct()
    {
        $this->url = ConfigQuery::read('hookmatomoanalytics_url', false);
        $this->container_id = ConfigQuery::read('hookmatomoanalytics_container_id', false);
    }

    /* Include tracking bug
     */
    public function onMainBodyBottom(HookRenderEvent $event)
    {
        $options = array();

        switch ($this->getRequest()->get('_view')) {
            // Category page viewed
            case 'category':
                $categoryId = $this->getRequest()->get('category_id');

                $defaultCategory = CategoryQuery::create()
                    ->findPk($categoryId);
                
                $options[] = [
                'event' => 'view_item_list',
                'ecommerce' => [
                    'item_list_name' => $defaultCategory->getTitle()
                ]
                ];
                
                break;

            // Product detail page viewed
            case 'product':
                $productId = $this->getRequest()->getProductId();
                $product = ProductQuery::create()
                    ->findPk($productId);

                if ($defaultCategoryId = $product->getDefaultCategoryId()) {
                    $defaultCategory = CategoryQuery::create()
                        ->findPk($defaultCategoryId);
                }

                $options[] = [
                'event' => 'view_item',
                'ecommerce' => [
                    'item_id' => $product->getRef() ?: $product->getId(),
                    'item_list_name' => $defaultCategory ? $defaultCategory->getTitle() : 'false',
                                 'items' => [[
                                'item_id' => $product->getRef() ?: (string)$product->getId(),
                                'item_name' => $product->getTitle(),
                                'item_category' => $defaultCategory ? $defaultCategory->getTitle() : 'false',
                                'price' => $product->getPrice() ?? false
                            ]]
                ]
                ];

                break;
        }

        if ($code = $this->generateTrackingCode($options)) {
            $event->add($code);
        }
    }

    private function generateTrackingCode($options)
    {
        if (!empty($this->url) && (!empty($this->container_id))) {
            // remove / after url
            $this->url = rtrim($this->url, '/') . '/';

        $code = '<script>
          var _mtm = window._mtm = window._mtm || [];
          _mtm.push({\'mtm.startTime\': (new Date().getTime()), \'event\': \'mtm.Start\'});
          (function() {
            var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0];
            g.async = true;
            g.src = "' . $this->url . 'js/container_' . $this->container_id . '.js";
            s.parentNode.insertBefore(g, s);
          })();
        </script>';
        
        foreach ($options as $option) {
            $code .= '<script>window._mtm.push(' . json_encode($option) . ');</script>';
        }
        return $code;
        }

        return false;
    }
}
