<?php

namespace HookMatomoAnalytics\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Model\ConfigQuery;

/**
 * Class ConfigurationController
 *
 * @author ANIMAL <studio@animal.at>
 */
class ConfigurationController extends BaseAdminController
{
    public function saveAction()
    {
        if ($response = $this->checkAuth(array(AdminResources::MODULE), array('hookmatomoanalytics'), AccessManager::UPDATE) !== null) {
            return $response;
        }

        $form = new \HookMatomoAnalytics\Form\Configuration($this->getRequest());
        $resp = array(
            'error' => 0,
            'message' => '',
        );
        $response = null;

        try {
            $vform = $this->validateForm($form);
            $data = $vform->getData();

            ConfigQuery::write('hookmatomoanalytics_url', $data['hookmatomoanalytics_url']);
            ConfigQuery::write('hookmatomoanalytics_website_id', $data['hookmatomoanalytics_website_id']);
            ConfigQuery::write('hookmatomoanalytics_enable_subdomains', is_bool($data['hookmatomoanalytics_enable_subdomains']) ? (int) ($data['hookmatomoanalytics_enable_subdomains']) : $data['hookmatomoanalytics_enable_subdomains']);
            ConfigQuery::write('hookmatomoanalytics_enable_contenttracking', is_bool($data['hookmatomoanalytics_enable_contenttracking']) ? (int) ($data['hookmatomoanalytics_enable_contenttracking']) : $data['hookmatomoanalytics_enable_contenttracking']);
            ConfigQuery::write('hookmatomoanalytics_enable_contenttracking_visible_only', is_bool($data['hookmatomoanalytics_enable_contenttracking_visible_only']) ? (int) ($data['hookmatomoanalytics_enable_contenttracking_visible_only']) : $data['hookmatomoanalytics_enable_contenttracking_visible_only']);
            ConfigQuery::write('hookmatomoanalytics_custom_campaign_name', $data['hookmatomoanalytics_custom_campaign_name']);
            ConfigQuery::write('hookmatomoanalytics_custom_campaign_keyword', $data['hookmatomoanalytics_custom_campaign_keyword']);
        } catch (\Exception $e) {
            $resp['error'] = 1;
            $resp['message'] = $e->getMessage();
        }

        return JsonResponse::create($resp);
    }
}
