<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Stripe\StripeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trainings;
use App\Repository\TrainingsRepository;

class PaiementController extends AbstractController
{
    private $manager;
    private $gateway;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
        $this->gateway = new StripeClient($_ENV['STRIPE_SECRETKEY']);
    }

    /**
     * @Route("/checkout", name="app_checkout", methods={"POST", "GET"})
    */
    public function checkout(EntityManagerInterface $manager, Request $request): Response
    {
        
        $price = $request->request->get("price");
        $quantity = $request->request->get("quantity"); 
        $name = $request->request->get("name");
        $description = $request->request->get("description");  

        //creation de la checkout
        $checkout = $this->gateway->checkout->sessions->create(
            [
                'line_items'=>[[
                    'price_data'=>[
                        'currency'=>$_ENV['STRIPE_CURRENCY'],
                        'product_data'=>[
                            'name'=>$name,
                            'description'=>$description,
                        ],

                        'unit_amount'=>intval($price*100),
                    ],
                    'quantity'=>$quantity
                ]],

                'mode'=>'payment',
                'success_url'=>'http://127.0.0.1:8000/success?id_sessions={CHECKOUT_SESSION_ID}',
                'cancel_url'=>'http://127.0.0.1:8000/cancel?id_sessions={CHECKOUT_SESSION_ID}',
            ]);

            return $this->redirect($checkout->url);       
            

    }  
    
     /**
     * @Route("/success", name="app_success")
    */
    public function success(Request $request): Response
    {
        $id_session = $request->query->get('id_sessions');

        //Récuperation du client via l'id de la session
        $customer = $this->gateway->checkout->sessions->retrieve(
            $id_session,
            []
        );

        //Récuperation des données du client
        $name = $customer["customer_details"]["name"];
        $email = $customer["customer_details"]["email"];
        $payment_status = $customer["payment_status"];
        $amount = $customer["amount_total"];

        // dd($payment_status);

        return $this->render('paiement/success.html.twig',[
            'payment_status'=> $payment_status,
            'name'=> $name
        ]);

    }

    /**
     * @Route("/cancel", name="app_cancel")
    */
    public function cancel(Request $request): Response
    {
        dd($request);
    }
    
}
