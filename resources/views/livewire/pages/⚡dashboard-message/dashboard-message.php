<?php

use App\Models\AdoptionRequest;
use App\Models\ContactMessage;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public int $unreadCount = 0;
    public int $unreadAdoptionRequestsCount = 0;

    public $messages;
    public $adoptionRequests;

    public function mount(): void
    {
        $this->loadData();
    }

    #[On('messageCreated')]
    public function loadData(): void
    {
        $this->unreadCount = ContactMessage::where('read', false)->count();
        $this->unreadAdoptionRequestsCount = AdoptionRequest::where('read', false)->count();

        $this->messages = ContactMessage::orderBy('created_at', 'desc')->get();
        $this->adoptionRequests = AdoptionRequest::orderBy('created_at', 'desc')->get();
    }


    public function markMessageAsRead(int $id): void
    {
        ContactMessage::where('id', $id)->update(['read' => true]);
        $this->loadData();
    }

    public function markMessageAsUnread(int $id): void
    {
        ContactMessage::where('id', $id)->update(['read' => false]);
        $this->loadData();
    }

    public function deleteMessage(int $id): void
    {
        ContactMessage::findOrFail($id)->delete();
        $this->loadData();
    }


    public function markAdoptionAsRead(int $id): void
    {
        AdoptionRequest::where('id', $id)->update(['read' => true]);
        $this->loadData();
    }

    public function markAdoptionAsUnread(int $id): void
    {
        AdoptionRequest::where('id', $id)->update(['read' => false]);
        $this->loadData();
    }

    public function deleteAdoption(int $id): void
    {
        AdoptionRequest::findOrFail($id)->delete();
        $this->loadData();
    }
};
