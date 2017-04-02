<?php

namespace AppBundle\Club\Manager;

use AppBundle\Entity\Club;
use Doctrine\ORM\EntityManagerInterface;

class ClubManager
{
	/**
	 * Entity Manager
	 * @var EntityManagerInterface
	 */
	protected $emr;

	/**
	 * Constructor
	 * @param EntityManagerInterface $emr Entity manager
	 */
	public function __construct(EntityManagerInterface $emr)
	{
		$this->emr = $emr;
	}

	/**
	 * Crea en BBDD un nuevo club
	 * @param  Club   $club Club que se va a persistir
	 * @return boolean
	 */
	public function create(Club $club)
	{
		$club->setDeleted(false);

		foreach ($club->getPlayers() as $player) {
			$player->setClub($club);
		}
		$this->emr->persist($club);
		$this->emr->flush();

		return true;
	}
	/**
	 * Elimina un club (de forma lógica)
	 * @param  Club    $club Club que se elimina
	 * @return boolean
	 */
	public function remove(Club $club)
	{
        $club->setDeleted(true);
        $this->emr->flush();

        return true;
	}
}
