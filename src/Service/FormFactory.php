<?php

namespace Opstalent\CrudBundle\Service;

use Opstalent\CrudBundle\Model\Field;
use Opstalent\CrudBundle\Model\Form;
use Opstalent\CrudBundle\Traits\MethodResolverTrait;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Opstalent\CrudBundle\Exception\MethodNotAllowedException;

/**
 * Class FormFactory
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class FormFactory
{
    use MethodResolverTrait;

    /**
     * @var FormBuilderInterface
     */
    protected $builder;

    /**
     * FormFactoryService constructor.
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->builder = $formFactory->createBuilder();
    }

    /**
     * @param Form $formModel
     * @return FormInterface
     */
    public function createForm(Form $formModel): FormInterface
    {
        $this->parse($formModel);
        return $this->getForm();
    }

    /**
     * @return FormInterface
     */
    public function getForm(): FormInterface
    {
        return $this->builder->getForm();
    }

    /**
     * @param Form $formModel
     * @return FormFactory
     * @throws MethodNotAllowedException
     */
    protected function parse(Form $formModel): FormFactory
    {
        $this->builder->setMethod(
            $this->resolveMethod(
                $formModel->getAction()
            )
        );
        foreach ($formModel->getFields() as $field) {
            $this->addField($field);
        }
        return $this;
    }

    /**
     * @param Field $fieldModel
     * @return FormFactory
     */
    protected function addField(Field $fieldModel): FormFactory
    {
        $this->builder->add(
            $fieldModel->getName(),
            $fieldModel->getType(),
            $fieldModel->getOptions()
        );
        return $this;
    }
}
