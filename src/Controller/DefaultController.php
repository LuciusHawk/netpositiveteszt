<?php

namespace App\Controller;

use App\Entity\Helper\FormHelper;
use App\Service\TableMaker;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     */
    public function index(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $helper = new FormHelper();


        $form = $this->createFormBuilder($helper)
            ->add('handle1', TextType::class)
            ->add('handle2', TextType::class)
            ->add('method', ChoiceType::class, array(
                'choices' => array(
                    'mod' => 'mod',
                    'fib' => 'fib',
                )))
            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();
        $form->handleRequest($request);

        $tableArray = array();

        if ($form->isSubmitted() && $form->isValid()) {
            $helper = $form->getData();
            $tableMaker = new TableMaker();
            $tableArray = $tableMaker->createTable($helper);

        }

        return $this->render('base.html.twig', array(
            'form' => $form->createView(),
            'tableArray' => $tableArray,
        ));
    }
}