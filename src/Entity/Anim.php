<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity("title")
 * @ORM\Entity(repositoryClass="App\Repository\AnimRepository")
 */
class Anim
{

    const DIRECTOR = [
        1 => 'Hayao Miyazaki',
        2 => 'Isao Takahata',
        3 => 'Tomomi Mochizuki'
    ];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotNull(message = "Le titre doit être renseigné")
     * @Assert\Length(min=15, max=255, minMessage = "Le titre doit avoir au moins {{ limit }} caractères",)
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $kanjiTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $japTitle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message = "L'année doit être renseignée")
     * @Assert\Range(
     *      min = 1986,
     *      minMessage = "Le tout premier animé est sorti en {{ limit }}",
     * )
     */
    private $year;

    // public function __construct()
    // {
    //     $this->year= new \DateTime();
    // }

    /**
     * @ORM\Column(type="smallint")
     */
    private $director;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getSlug(): ?string
    {
        return (new AsciiSlugger())->slug($this->title)->lower();
    }

    public function getKanjiTitle(): ?string
    {
        return $this->kanjiTitle;
    }

    public function setKanjiTitle(?string $kanjiTitle): self
    {
        $this->kanjiTitle = $kanjiTitle;

        return $this;
    }

    public function getJapTitle(): ?string
    {
        return $this->japTitle;
    }

    public function setJapTitle(?string $japTitle): self
    {
        $this->japTitle = $japTitle;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getFormattedYear(): string
    {
        return number_format($this->year, 0, '', '.');
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDirector(): ?int
    {
        return $this->director;
    }

    public function setDirector(int $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getDirectorSelect(): string
    {
        return self::DIRECTOR[$this->director];
    }

}
