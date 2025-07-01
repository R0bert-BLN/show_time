<?php

namespace App\Entity;

use App\Enum\TicketPaymentStatus;
use App\Repository\TicketPaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketPaymentRepository::class)]
class TicketPayment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $transactionId = null;

    /**
     * @var Collection<int, IssuedTicket>
     */
    #[ORM\OneToMany(targetEntity: IssuedTicket::class, mappedBy: 'ticketPayment')]
    private Collection $issuedTickets;

    #[ORM\Column(enumType: TicketPaymentStatus::class)]
    private ?TicketPaymentStatus $status = null;

    /**
     * @var Collection<int, TicketType>
     */
    #[ORM\ManyToMany(targetEntity: TicketType::class, inversedBy: 'ticketPayments')]
    private Collection $ticketTypes;

    #[ORM\Column]
    private ?\DateTime $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'ticketPayments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->issuedTickets = new ArrayCollection();
        $this->ticketTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

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

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function setTransactionId(string $transactionId): static
    {
        $this->transactionId = $transactionId;

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
            $issuedTicket->setTicketPayment($this);
        }

        return $this;
    }

    public function removeIssuedTicket(IssuedTicket $issuedTicket): static
    {
        if ($this->issuedTickets->removeElement($issuedTicket)) {
            // set the owning side to null (unless already changed)
            if ($issuedTicket->getTicketPayment() === $this) {
                $issuedTicket->setTicketPayment(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?TicketPaymentStatus
    {
        return $this->status;
    }

    public function setStatus(TicketPaymentStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, TicketType>
     */
    public function getTicketTypes(): Collection
    {
        return $this->ticketTypes;
    }

    public function addTicketType(TicketType $ticketType): static
    {
        if (!$this->ticketTypes->contains($ticketType)) {
            $this->ticketTypes->add($ticketType);
        }

        return $this;
    }

    public function removeTicketType(TicketType $ticketType): static
    {
        $this->ticketTypes->removeElement($ticketType);

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
