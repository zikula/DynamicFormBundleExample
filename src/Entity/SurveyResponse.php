<?php

namespace App\Entity;

use App\Repository\SurveyResponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Zikula\Bundle\DynamicFormBundle\Entity\AbstractDynamicPropertyData;

#[ORM\Entity(repositoryClass: SurveyResponseRepository::class)]
class SurveyResponse extends AbstractDynamicPropertyData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'responses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Survey $survey = null;

    #[ORM\Column]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
