<?php

namespace App\Entity;

use App\Repository\TicketTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketTypeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class TicketType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ticketTypes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Festival $festival = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $totalTickets = null;

    #[ORM\Column]
    private ?\DateTime $startSaleDate = null;

    #[ORM\Column]
    private ?\DateTime $endSaleDate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(length: 3)]
    private ?string $currency = null;

    /**
     * @var Collection<int, Booking>
     */
    #[ORM\ManyToMany(targetEntity: Booking::class, mappedBy: 'ticketType')]
    private Collection $bookings;

    /**
     * @var Collection<int, IssuedTicket>
     */
    #[ORM\OneToMany(targetEntity: IssuedTicket::class, mappedBy: 'ticketType')]
    private Collection $issuedTickets;

    /**
     * @var Collection<int, TicketPayment>
     */
    #[ORM\ManyToMany(targetEntity: TicketPayment::class, mappedBy: 'ticketTypes')]
    private Collection $ticketPayments;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $updatedAt = null;

    #[ORM\PrePersist]
    public function onCreate(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function onUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->issuedTickets = new ArrayCollection();
        $this->ticketPayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFestival(): ?Festival
    {
        return $this->festival;
    }

    public function setFestival(?Festival $festival): static
    {
        $this->festival = $festival;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTotalTickets(): ?int
    {
        return $this->totalTickets;
    }

    public function setTotalTickets(int $totalTickets): static
    {
        $this->totalTickets = $totalTickets;

        return $this;
    }

    public function getStartSaleDate(): ?\DateTime
    {
        return $this->startSaleDate;
    }

    public function setStartSaleDate(\DateTime $startSaleDate): static
    {
        $this->startSaleDate = $startSaleDate;

        return $this;
    }

    public function getEndSaleDate(): ?\DateTime
    {
        return $this->endSaleDate;
    }

    public function setEndSaleDate(\DateTime $endSaleDate): static
    {
        $this->endSaleDate = $endSaleDate;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->addTicketType($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            $booking->removeTicketType($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, IssuedTicket>
     */
    public function getIssuedTickets(): Collection
    {
        return $this->issuedTickets;
    }

    public function addIssuedTicket(IssuedTicket $issuedTicket): static
    {
        if (!$this->issuedTickets->contains($issuedTicket)) {
            $this->issuedTickets->add($issuedTicket);
            $issuedTicket->setTicketType($this);
        }

        return $this;
    }

    public function removeIssuedTicket(IssuedTicket $issuedTicket): static
    {
        if ($this->issuedTickets->removeElement($issuedTicket)) {
            // set the owning side to null (unless already changed)
            if ($issuedTicket->getTicketType() === $this) {
                $issuedTicket->setTicketType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TicketPayment>
     */
    public function getTicketPayments(): Collection
    {
        return $this->ticketPayments;
    }

    public function addTicketPayment(TicketPayment $ticketPayment): static
    {
        if (!$this->ticketPayments->contains($ticketPayment)) {
            $this->ticketPayments->add($ticketPayment);
            $ticketPayment->addTicketType($this);
        }

        return $this;
    }

    public function removeTicketPayment(TicketPayment $ticketPayment): static
    {
        if ($this->ticketPayments->removeElement($ticketPayment)) {
            $ticketPayment->removeTicketType($this);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
