<?php

namespace Sensio\StoreBundle\Controller;

use Sensio\StoreBundle\Model\Quotation;
use Sensio\StoreBundle\Form\QuotationType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/quotation/new", name="new_quotation")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $quotation = new Quotation();
        $form = $this->createForm(new QuotationType(), $quotation);

        $form->handleRequest($request);
        if ($form->isValid()) {

            $body = $this->renderView(
                'SensioStoreBundle:Default:mail.txt.twig',
                array(
                    'quotation' => $quotation,
                    'customer' => $quotation->getCustomer()
                )
            );

            $message = \Swift_Message::newInstance()
                ->setFrom('store@domain.com')
                ->setTo($quotation->getRecipient())
                ->setSubject('[Sensio Store] your quotation')
                ->setBody($body);

            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('quotation_success'));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/quotation_success/", name="quotation_success")
     * @Template()
     */
    public function quotationSuccessAction()
    {
        return array();
    }
}
