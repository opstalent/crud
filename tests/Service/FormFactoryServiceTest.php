<?php

namespace Opstalent\CrudBundle\Tests\Service;

use Opstalent\CrudBundle\Exception\ActionUnavailableException;
use Opstalent\CrudBundle\Exception\MethodNotAllowedException;
use Opstalent\CrudBundle\Model\Field;
use Opstalent\CrudBundle\Model\Form;
use Opstalent\CrudBundle\Service\FormFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Forms;
=======
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\Form\Forms;
use Opstalent\CrudBundle\Service\FormFactory;
>>>>>>> 4bf1499... Create FormFactory

/**
 * Class FormFactoryTest
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class FormFactoryTest extends TestCase
{
    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * setUp FormFactory
     * @before
     */
    public function setUpFormFactory()
    {
        $baseFactory = Forms::createFormFactoryBuilder();
        $this->formFactory = new FormFactory($baseFactory->getFormFactory());
    }

    /**
     * @group FormFactory
     * @test
     */
    public function returnFormInstanceWhenCreatingForm()
    {
        $formModel = new Form();
        $formModel->setName('user');
        $formModel->setAction('addable');
        $form = $this->formFactory->createForm($formModel);
        $this->assertInstanceOf(FormInterface::class, $form);
    }

    /**
     * @group FormFactory
     * @test
     */
    public function throwingExceptionWhenCreatingFormWithDummyAction()
    {
        $this->expectException(ActionUnavailableException::class);
        $formModel = new Form();
        $formModel->setName('user');
        $formModel->setAction('adorable');
    }

    /**
     * @group FormFactory
     * @test
     * @depends returnFormInstanceWhenCreatingForm
     */
    public function generateFormWithFieldsWhenFieldsModelGiven()
    {
        $formModel = new Form();
        $formModel->setName('user');
        $formModel->setAction('addable');
        $field = new Field();
        $field->setName('firstName');
        $field->setType(TextType::class);
        $formModel->addField($field);
        $form = $this->formFactory->createForm($formModel);
        $this->assertArrayHasKey('firstName', $form->all());
        $this->assertInstanceOf(FormInterface::class, $form->all()['firstName']);
    }

    /**
     * @group FormFactory
     * @test
     */
    public function throwingExceptionWhenNotAllowedMethodPassed()
    {
        $this->expectException(MethodNotAllowedException::class);
        $this->formFactory->resolveMethod('fakeMethod');
    }
}
