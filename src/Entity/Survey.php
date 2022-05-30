<?php

namespace App\Entity;

use App\Repository\SurveyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Zikula\Bundle\DynamicFormPropertyBundle\DynamicPropertiesContainerInterface;

#[ORM\Entity(repositoryClass: SurveyRepository::class)]
class Survey implements DynamicPropertiesContainerInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'survey', targetEntity: Question::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['id' => 'ASC'])]
    #[Assert\Valid]
    private Collection $questions;

    #[ORM\Column]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'survey', targetEntity: SurveyResponse::class, orphanRemoval: true)]
    #[Assert\Valid]
    private Collection $responses;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->responses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropertySpecifications(array $params = []): array
    {
        $expressionBuilder = Criteria::expr();
        $criteria = new Criteria();
        $criteria->where($expressionBuilder->eq('active', true));

        return $this->getQuestions()->matching($criteria)->toArray();
    }

    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setSurvey($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getSurvey() === $this) {
                $question->setSurvey(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(SurveyResponse $response): self
    {
        if (!$this->responses->contains($response)) {
            $this->responses[] = $response;
            $response->setSurvey($this);
        }

        return $this;
    }

    public function removeResponse(SurveyResponse $response): self
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getSurvey() === $this) {
                $response->setSurvey(null);
            }
        }

        return $this;
    }

    public function getLabels(): array
    {
        $labels = [];
        foreach ($this->getPropertySpecifications() as $specification) {
            $labels[$specification->getName()] = $specification->getLabel();
        }

        return $labels;
    }
}
