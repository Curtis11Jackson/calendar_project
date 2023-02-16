<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\SalesRepRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AppointmentType;

class AppointmentCalendarController extends AbstractController
{
    #[Route('/appointment/calendar', name: 'app_appointment_calendar')]
    public function index(SalesRepRepository $salesRepRepository, ClientRepository $clientRepository, Request $request): Response
    {

        if(!empty($this->getUser())){

            $connectedUserEmail = $this->getUser()->getEmail();
            $infosConnectedUserAsSalesRep = $salesRepRepository->findOneBy(['email' => $connectedUserEmail]);

            if (!empty($infosConnectedUserAsSalesRep)) {

                $addAppointment = $this->createForm(AppointmentType::class);
                $addAppointment->handleRequest($request);




                return $this->render('appointment_calendar/rep_space.html.twig', [
                    'controller_name' => 'AppointmentCalendarController',
                    'infosConnectedUserAsSalesRep' => $infosConnectedUserAsSalesRep,
                    'addAppointment' => $addAppointment->createView()
                ]);

            } else {
                $infosConnectedUserAsClient = $clientRepository->findOneBy(['email' => $connectedUserEmail]);

                $repList = $salesRepRepository->findAll();

                return $this->render('appointment_calendar/client_space.html.twig', [
                    'controller_name' => 'AppointmentCalendarController',
                    'infosConnectedUserAsClient' => $infosConnectedUserAsClient,
                    'repList' => $repList
                ]);
            }

        } else {
            return $this->redirectToRoute('app_login');
        }
    }


    #[Route('/appointment/availabilities/{id}', name: 'app_appointment_calendar_availabilities')]
    public function availabilities(SalesRepRepository $salesRepRepository, ClientRepository $clientRepository, Request $request): Response
    {

        $idSalesRep = $request->get('id');

        $getSalesRep = $salesRepRepository->findOneById($idSalesRep);

        return $this->render('appointment_calendar/calendar_availabilities.html.twig', [
            'controller_name' => 'AppointmentCalendarController',
            'salesRep' => $getSalesRep,

        ]);
    }
}
