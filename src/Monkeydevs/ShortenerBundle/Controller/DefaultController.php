<?php

namespace Monkeydevs\ShortenerBundle\Controller;

use LogicException;
use Monkeydevs\ShortenerBundle\Entity\Statistic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;
use GeoIp2\Database\Reader;
use Monkeydevs\ShortenerBundle\Entity\Link;

class DefaultController extends Controller {
	/**
	 * @Route("/", name="monkeydevs_shortener_index")
	 * @Method({"GET", "POST"})
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws LogicException
	 */
	public function indexAction( Request $request ) {
		/** @var Link $link */
		$link = new Link();
		$form = $this->createForm( 'Monkeydevs\ShortenerBundle\Form\LinkType', $link );
		$form->handleRequest( $request );

		$response = null;

		if ( $form->isValid() && $form->isSubmitted() ) {
			$urlLength = $this->getParameter( 'url_length' );

			$code = bin2hex( random_bytes( $urlLength ) );
			$link->setCode( $code );
			$link->setCreated( new \DateTime() );

			$em = $this->getDoctrine()->getManager();
			$em->persist( $link );
			$em->flush();

			$host = $request->getScheme() . '://' . $request->getHttpHost() . '/';

			$response = [
				'shortUrl'          => $host . $link->getCode(),
				'shortUrlStatistic' => $host . $link->getCode() . '+',
			];
		}

		return $this->render( '@MonkeydevsShortener/Default/index.html.twig', [
			'form'     => $form->createView(),
			'response' => $response,
		] );
	}

	/**
	 * @Route("/{code}+", name="monkeydevs_shortener_statistic", requirements={"code": ".+"})
	 * @param $code
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws LogicException
	 */
	public function StatisticAction( $code ) {
		$link      = $this->getDoctrine()->getRepository( Link::class )->findOneByCode( $code );
		$statistic = $this->getDoctrine()->getRepository( Statistic::class )->findByLink( $link );

		return $this->render( '@MonkeydevsShortener/Default/statistic.html.twig', [
			'statistic' => $statistic,
		] );
	}

	/**
	 * @Route("/{code}", name="monkeydevs_shortener_redirect", requirements={"code": ".+"})
	 * @param $code
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws LogicException
	 */
	public function redirectAction( $code, Request $request ) {
		$link = $this->getDoctrine()->getRepository( Link::class )->findOneByCode( $code );

		if ( ! is_null( $link ) ) {
			$statistic = new Statistic();

			$browser = new Browser();
			$os      = new Os();
			$country = 'Belarus';

			// $reader = new Reader($this->get('kernel')->getRootDir().'/Monkeysdevs/ShortenerBundle/Resources/public/GeoLite2-City.mmdb');
			// $record = $reader->city($request->getClientIp());
			// $country = $record->country->name;

			$statistic->setLink( $link );
			$statistic->setUsed( new \DateTime() );
			$statistic->setIp( $request->getClientIp() );
			$statistic->setCountry( $country );
			$statistic->setBrowser( $browser->getName() );
			$statistic->setOs( $os->getName() );

			$em = $this->getDoctrine()->getManager();
			$em->persist( $statistic );
			$em->flush();

			return $this->redirect( $link->getUrl() );
		} else {
			return $this->redirectToRoute( 'monkeydevs_shortener_index' );
		}
	}

}
