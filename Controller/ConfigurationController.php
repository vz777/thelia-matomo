<?php

namespace HookMatomoAnalytics\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Model\ConfigQuery;
use HookMatomoAnalytics\Form\Configuration;

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

        $form = $this->createForm(Configuration::getName());

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
            ConfigQuery::write('hookmatomoanalytics_container_id', $data['hookmatomoanalytics_container_id']);
        } catch (\Exception $e) {
            $resp['error'] = 1;
            $resp['message'] = $e->getMessage();
        }

        return new JsonResponse($resp);
    }
}
