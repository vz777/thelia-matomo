<?php

namespace HookMatomoAnalytics\Form;

use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\ConfigQuery;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class Configuration.
 *
 * @author ANIMAL <studio@animal.at>
 */
class Configuration extends BaseForm
{
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                'hookmatomoanalytics_url',
                'text',
                array(
                    'constraints' => array(
                        new NotBlank(),
                    ),
                    'data' => ConfigQuery::read('hookmatomoanalytics_url', ''),
                    'label' => $this->translator->trans('Matomo URL'),
                    'label_attr' => array(
                        'for' => 'hookmatomoanalytics_url',
                    ),
                )
            )
            ->add(
                'hookmatomoanalytics_website_id',
                'number',
                array(
                    'constraints' => array(
                        new NotBlank(),
                    ),
                    'data' => ConfigQuery::read('hookmatomoanalytics_website_id', 0),
                    'label' => $this->translator->trans('Website ID'),
                    'label_attr' => array(
                        'for' => 'hookmatomoanalytics_website_id',
                    ),
                )
            )
            ->add(
                'hookmatomoanalytics_enable_subdomains',
                'checkbox',
                array(
                    'required' => false,
                    'value' => (bool)ConfigQuery::read('hookmatomoanalytics_enable_subdomains', false),
                    'label' => $this->translator->trans('Enable tracking across subdomains'),
                    'label_attr' => array(
                        'for' => 'hookmatomoanalytics_enable_subdomains',
                    ),
                )
            )
            ->add(
                'hookmatomoanalytics_enable_contenttracking',
                'checkbox',
                array(
                    'required' => false,
                    'value' => (bool)ConfigQuery::read('hookmatomoanalytics_enable_contenttracking', false),
                    'label' => $this->translator->trans('Enable Content Tracking'),
                    'label_attr' => array(
                        'for' => 'hookmatomoanalytics_enable_contenttracking',
                    ),
                )
            )
            ->add(
                'hookmatomoanalytics_enable_contenttracking_visible_only',
                'checkbox',
                array(
                    'required' => false,
                    'value' => (bool)ConfigQuery::read('hookmatomoanalytics_enable_contenttracking_visible_only', false),
                    'label' => $this->translator->trans('Only track visible content'),
                    'label_attr' => array(
                        'for' => 'hookmatomoanalytics_enable_contenttracking_visible_only',
                    ),
                )
            )
            ->add(
                'hookmatomoanalytics_custom_campaign_name',
                'text',
                array(
                    'required' => false,
                    'data' => ConfigQuery::read('hookmatomoanalytics_custom_campaign_name', ''),
                    'label' => $this->translator->trans('Custom campaign name parameter'),
                    'label_attr' => array(
                        'for' => 'hookmatomoanalytics_custom_campaign_name',
                    ),
                )
            )
            ->add(
                'hookmatomoanalytics_custom_campaign_keyword',
                'text',
                array(
                    'required' => false,
                    'data' => ConfigQuery::read('hookmatomoanalytics_custom_campaign_keyword', ''),
                    'label' => $this->translator->trans('Custom campaign keyword parameter'),
                    'label_attr' => array(
                        'for' => 'hookmatomoanalytics_custom_campaign_keyword',
                    ),
                )
            );
    }

    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return 'hookmatomoanalytics';
    }
}
