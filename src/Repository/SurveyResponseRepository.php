<?php

namespace App\Repository;

use App\Entity\SurveyResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SurveyResponse>
 *
 * @method SurveyResponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveyResponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveyResponse[]    findAll()
 * @method SurveyResponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyResponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SurveyResponse::class);
    }
}
