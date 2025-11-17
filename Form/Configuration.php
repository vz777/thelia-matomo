<?php

namespace HookMatomoAnalytics\Form;

use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\ConfigQuery;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
                TextType::class,
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
                NumberType::class,
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
                'hookmatomoanalytics_container_id',
                TextType::class,
                array(
                    'constraints' => array(
                        new NotBlank(),
                    ),
                    'data' => ConfigQuery::read('hookmatomoanalytics_container_id', 0),
                    'label' => $this->translator->trans('Container ID'),
                    'label_attr' => array(
                        'for' => 'hookmatomoanalytics_container_id',
                    ),
                )
            );
    }

    /**
     * @return string the name of you form. This name must be unique
     */
    public static function getName()
    {
        return 'hookmatomoanalytics_configuration_form';
    }
}
