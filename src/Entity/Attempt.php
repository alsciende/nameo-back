<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="attempts",indexes={@ORM\Index(name="find_newer_than",columns={"step","presented_at"})})
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Attempt
{
    const OUTCOME_ACCEPTED = 0;
    const OUTCOME_REJECTED = 1;
    const OUTCOME_TIMEOUT = 2;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Match
     *
     * @ORM\ManyToOne(targetEntity="Match")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id", nullable=false)
     */
    private $match;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $step;

    /**
     * @var Card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id", nullable=false)
     */
    private $card;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $presentedAt;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $presentedFor;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $outcome;

    public function __construct(Match $match, int $step, Card $card, string $presentedAt, int $presentedFor, int $outcome)
    {
        $this->match = $match;
        $this->step = $step;
        $this->card = $card;
        $this->presentedAt = \DateTime::createFromFormat('U', $presentedAt);
        $this->presentedFor = $presentedFor;
        $this->outcome = $outcome;
    }

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @return \DateTime
     */
    public function getPresentedAt(): \DateTime
    {
        return $this->presentedAt;
    }

    /**
     * @return int
     */
    public function getPresentedFor(): int
    {
        return $this->presentedFor;
    }

    /**
     * @return int
     */
    public function getOutcome(): int
    {
        return $this->outcome;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
