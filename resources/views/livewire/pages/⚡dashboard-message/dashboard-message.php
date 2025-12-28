<?php

use App\Models\Animal;
use App\Models\ContactMessage;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public int $unreadCount = 0;
    public $messages;
    public $selectedMessage = null;

    public function mount(): void
    {
        $this->updateUnreadCount();
        $this->messages = ContactMessage::orderBy('created_at', 'desc')->get();
    }

    #[On('messageCreated')]
    public function updateUnreadCount(): void
    {
        $this->unreadCount = ContactMessage::where('read', false)->count();
        $this->messages = ContactMessage::orderBy('created_at', 'desc')->get();
    }

    public function markAsRead($messageId): void
    {
        $message = ContactMessage::find($messageId);

        if ($message && !$message->read) {
            $message->update(['read' => true]);
            $this->dispatch('messageCreated');
            $this->updateUnreadCount();
        }
    }

    public function markAsUnread($messageId): void
    {
        $message = ContactMessage::find($messageId);

        if ($message && $message->read) {
            $message->update(['read' => false]);
            $this->dispatch('messageCreated');
            $this->updateUnreadCount();
        }
    }

    public function markAllAsRead(): void
    {
        ContactMessage::where('read', false)->update(['read' => true]);
        $this->dispatch('messageCreated');
        $this->updateUnreadCount();
    }

    public function deleteMsg(string $messageId): void
    {
        $message = ContactMessage::findOrFail($messageId);
        $message->delete();
    }
};
