<?php

namespace Lotofootv2\Bundle\Controller\User\Stats;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TeamsController extends Controller
{
	
	/**
     * @Route("/stats/teams", name="_stats_teams")
     */
    public function indexAction()
    {
    	$registry = array();
    	
    	//[0] = ['A', [ ['Ajaccio', 70], ['Arsenal', 71]...
    	foreach( range('A', 'Z') as $letter){
    		array_push($registry, array($letter, array()));
    	}
    	
		$registry = $this->register($registry,'AC Milan','127');
    	$registry = $this->register($registry, 'Ajaccio', '35');
		$registry = $this->register($registry,'Almeria','3463');
    	$registry = $this->register($registry, 'Arsenal', '71');
    	$registry = $this->register($registry,'Athletic Bilbao','2062');
		$registry = $this->register($registry,'Athletico Madrid','111');
		$registry = $this->register($registry,'AS Roma','125');
		$registry = $this->register($registry, 'Aston Villa', '70');
    	$registry = $this->register($registry,'Atalanta Bergame','655');
		$registry = $this->register($registry,'Augsburg','5148');

    	$registry = $this->register($registry, 'Bastia', '16');
    	$registry = $this->register($registry,'Bayer Leverkusen','67');
		$registry = $this->register($registry,'Bayern Munich','50');
		$registry = $this->register($registry,'Betis Seville','99');
		$registry = $this->register($registry,'Bologne','121');
		$registry = $this->register($registry, 'Bordeaux', '18');
    	$registry = $this->register($registry,'Borussia Dortmund','53');
		$registry = $this->register($registry,'Borussia M\'Gladbach','400');

    	$registry = $this->register($registry,'Cagliari','118');
		$registry = $this->register($registry, 'Cardiff City', '789');
    	$registry = $this->register($registry,'Catane','10000000000000000000002447');
		$registry = $this->register($registry, 'Chelsea', '73');
    	$registry = $this->register($registry,'Chievo Verone','1127');
		$registry = $this->register($registry, 'Crystal Palace', '589');
    	
    	$registry = $this->register($registry, 'Everton', '68');
    	$registry = $this->register($registry, 'Evian', '1897');
    	$registry = $this->register($registry,'Eiche','1066');
		$registry = $this->register($registry,'Eintracht Brunswick','5335');
		$registry = $this->register($registry,'Eintracht Francfort','52');
		$registry = $this->register($registry,'Espanyol Barcelone','117');
    	
		$registry = $this->register($registry,'FC Barcelone','98');
		$registry = $this->register($registry,'FC Nuremberg','64');
		$registry = $this->register($registry,'FC Seville','677');
		$registry = $this->register($registry,'Fiorentina','119');
		$registry = $this->register($registry,'FSV Mayence 05','571');
		$registry = $this->register($registry, 'Fulham', '748');
		
		$registry = $this->register($registry,'Genoa','766');
		$registry = $this->register($registry,'Getafe','2444');
    	$registry = $this->register($registry, 'Guingamp', '37');
		$registry = $this->register($registry,'Grenade','1290');
		
		$registry = $this->register($registry,'Hambourg SV','63');
		$registry = $this->register($registry,'Hanovre 96','776');
		$registry = $this->register($registry,'Hellias Verone','673');
		$registry = $this->register($registry,'Hertha Berlin','62');
		$registry = $this->register($registry,'Hoffenheim','4080');
    	$registry = $this->register($registry, 'Hull City', '4441');
    	
		$registry = $this->register($registry,'Inter Milan','120');
    	
		$registry = $this->register($registry,'Juventus Turin','128');
		
		$registry = $this->register($registry,'Lazio Rome','132');
		$registry = $this->register($registry,'Levante','1021');
		$registry = $this->register($registry, 'Lille', '43');
    	$registry = $this->register($registry, 'Liverpool', '2084');
    	$registry = $this->register($registry,'Livourne','1297');
		$registry = $this->register($registry, 'Lorient', '11');
    	$registry = $this->register($registry, 'Lyon', '22');
    	
		$registry = $this->register($registry,'Malaga','676');
    	$registry = $this->register($registry, 'Manchester City', '725');
    	$registry = $this->register($registry, 'Manchester United', '87');
    	$registry = $this->register($registry, 'Marseille', '6');
    	$registry = $this->register($registry, 'Monaco', '25');
    	$registry = $this->register($registry, 'Montpellier', '17');

    	$registry = $this->register($registry, 'Nantes', '15');
    	$registry = $this->register($registry,'Naples','647');
		$registry = $this->register($registry, 'Newscastle United', '75');
    	$registry = $this->register($registry, 'Nice', '46');
    	$registry = $this->register($registry, 'Norwich City', '678');
    	
		$registry = $this->register($registry,'Osasuna','1303');
		
    	$registry = $this->register($registry, 'Paris Saint-Germain', '26');
    	$registry = $this->register($registry,'Parme','133');
    	
		$registry = $this->register($registry,'Rayo Vallecano','692');		
		$registry = $this->register($registry,'Real Madrid','108');
		$registry = $this->register($registry,'Real Sociedad','102');
		$registry = $this->register($registry,'Real Valladolid','105');
		$registry = $this->register($registry, 'Reims', '211');
    	$registry = $this->register($registry, 'Rennes', '15');

    	$registry = $this->register($registry, 'Saint-Etienne', '38');
    	$registry = $this->register($registry,'Sampdoria Gênes','134');
		$registry = $this->register($registry,'Sassuolo','4494');
		$registry = $this->register($registry,'SC Fribourg','65');
		$registry = $this->register($registry,'Schalke 04','54');
		$registry = $this->register($registry, 'Sochaux', '10');
    	$registry = $this->register($registry, 'Southampton', '69');
    	$registry = $this->register($registry, 'Stoke City', '564');
    	$registry = $this->register($registry, 'Sunderland', '686');
    	$registry = $this->register($registry, 'Swansea', '10000000000000000000001885');
    	
		$registry = $this->register($registry,'Torino','674');
    	$registry = $this->register($registry, 'Tottenham', '86');
    	$registry = $this->register($registry, 'Toulouse', '12');
    	
		$registry = $this->register($registry,'Udinese','123');
    	
		$registry = $this->register($registry,'Valence CF','112');
		$registry = $this->register($registry, 'Valenciennes', '415');
		$registry = $this->register($registry,'VfB Stuttgart','60');
		$registry = $this->register($registry,'VfL Wolfsburg','57');
    	$registry = $this->register($registry,'Villareal','107');
		
		$registry = $this->register($registry,'Werder Brême','61');
		$registry = $this->register($registry, 'West Bromwich Albion', '750');
    	$registry = $this->register($registry, 'West Ham', '77');
    	
       	return $this->render('Lotofootv2Bundle:User/Stats:teams.html.twig', array('registry' => $registry));
    }
    
    private function register($registry, $name, $code){
    	array_push($registry[ord($name[0])-65][1], array($name, $code));
    	return $registry;
    }

}
