<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Zikula\Bundle\DynamicFormBundle\Entity\AbstractFormSpecification;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question extends AbstractFormSpecification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    protected ?Survey $survey = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(?Survey $survey): void
    {
        $this->survey = $survey;
    }
}
