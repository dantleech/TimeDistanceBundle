<?php
namespace DTL\Bundle\TimeDistanceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;
use DTL\Bundle\TimeDistanceBundle\Form\DataTransformer\DistanceToMetersTransformer;
use DTL\Bundle\TimeDistanceBundle\Util\TimeDistanceHelper;

class DistanceType extends AbstractType
{
    protected $tdh;

    public function __construct(TimeDistanceHelper $tdh)
    {
        $this->tdh = $tdh;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addViewTransformer(new DistanceToMetersTransformer($this->tdh))
            ->setAttribute('value', $options['value'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->set('value', $form->getClientData());
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'value' => '',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'distance';
    }
}

