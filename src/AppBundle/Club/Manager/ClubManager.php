<?php

namespace AppBundle\Club\Manager;

use AppBundle\Entity\Club;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;

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

        if ($club->getPlayers() != null) {
            foreach ($club->getPlayers() as $player) {
                $player->setClub($club);
            }
        }

        $this->emr->persist($club);
        $this->emr->flush();

        return true;
    }

    /**
     * Modifica la información de un club
     * @param  Club   $club Club que se modifica
     * @return boolean
     */
    public function edit(Club $club, ArrayCollection $originalPlayers)
    { 
        foreach ($originalPlayers as $player) {
            if (false === $club->getPlayers()->contains($player)) {
                $player->setClub(null);
                $club->removePlayer($player);
                $this->emr->remove($player);
            }
        }

        if ($club->getPlayers() != null) {
            foreach ($club->getPlayers() as $player) {
                $player->setClub($club);
            }
        }

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
