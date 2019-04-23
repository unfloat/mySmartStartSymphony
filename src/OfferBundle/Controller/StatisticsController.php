<?php

namespace OfferBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use OfferBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class StatisticsController extends Controller
{
    /**
     * @security("has_role('ROLE_FREELANCER')")
     */
    public function statisticAction()
    {  $em = $this->getDoctrine()->getManager();
        $offers= $em->getRepository(Offer::class)->findAll();
        $acceptedOffers = array_filter($offers, function ($offer) {
            return (($offer->getStatus()== 'accepted') === true);
        });
        $rejectedOffers = array_filter($offers, function ($offer) {
            return (($offer->getStatus()== 'rejected') === true);
        });
        $pendingOffers = array_filter($offers, function ($offer) {
            return (($offer->getStatus()== 'En Attente') === true);
        });
        $chart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();
        $chart->getData()->setArrayToDataTable([
            ['Year', 'All offers', 'Accepted offers', 'Rejected offers','Pending offers'],
            ['2019', sizeof($offers), sizeof($acceptedOffers), sizeof($rejectedOffers),sizeof($pendingOffers)],

        ]);

        $chart->getOptions()->getChart()
            ->setTitle('Offer Statistics')
            ->setSubtitle('Sales, Expenses, and Profit: 2014-2017');
        $chart->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(900)
            ->setColors(['#f1c40f', '#2E9AFE', '#FF0000','#e67e22'])
            ->getVAxis()
            ->setFormat('decimal');
        return $this->render('@Offer/Offer/statistics.html.twig', array('piechart'=>$chart));
    }


}
