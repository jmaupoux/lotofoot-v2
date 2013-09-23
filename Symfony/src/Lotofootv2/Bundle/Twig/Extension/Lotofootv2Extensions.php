<?php

namespace Lotofootv2\Bundle\Twig\Extension;

use Lotofootv2\Bundle\Service\RewardService;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityManager;


class Lotofootv2Extensions extends \Twig_Extension
{
	protected $rewardService;

    public function __construct(RewardService $rewardService)
    {
        $this->rewardService = $rewardService;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'rewards' => new \Twig_Function_Method($this, 'getRewards', array('is_safe' => array('html'))),
        );
    }
    
    public function getRewards($accountId){
    	return $this->rewardService->getAccountRewards($accountId);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'lotofootv2';
    }
}
