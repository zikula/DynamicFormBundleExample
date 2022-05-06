<?php

namespace App\Entity;

use App\Repository\SurveyResponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Zikula\Bundle\DynamicFormPropertyBundle\Entity\AbstractDynamicPropertyDataEntity;

#[ORM\Entity(repositoryClass: SurveyResponseRepository::class)]
class SurveyResponse extends AbstractDynamicPropertyDataEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Survey::class, inversedBy: 'responses')]
    #[ORM\JoinColumn(nullable: false)]
    private $survey;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurvey(): ?Survey
    {
        return $this->survey;
    }

    public function setSurvey(?Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
