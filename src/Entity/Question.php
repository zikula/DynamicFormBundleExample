<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Zikula\Bundle\DynamicFormPropertyBundle\Entity\AbstractPropertyEntity;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question extends AbstractPropertyEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    #[ORM\ManyToOne(targetEntity: Survey::class, inversedBy: 'questions')]
    protected Survey $survey;

    public function __construct()
    {
        $this->formType = TextType::class;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey): void
    {
        $this->survey = $survey;
    }
}
