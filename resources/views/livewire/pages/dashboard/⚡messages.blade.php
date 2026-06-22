<?php

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Mail\AdoptionAcceptedMail;
use App\Mail\AdoptionRefusedMail;
use App\Models\AdoptionRequest;
use App\Models\ContactMessage;
use Livewire\Attributes\On;


new #[Title('Messages | Dashboard')] class extends Component {
    public int $unreadCount = 0;
    public int $unreadAdoptionRequestsCount = 0;

    public $messages;
    public $adoptionRequests;
    public ?string $selectedMessage = null;
    public ?string $selectedName = null;
    public ?string $selectedEmail = null;

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

    public function openMessageModal(int $id): void
    {
        $message = ContactMessage::findOrFail($id);

        $this->selectedName = $message->name;
        $this->selectedEmail = $message->email;
        $this->selectedMessage = $message->message;

        $this->dispatch('open-message-modal');
    }

    public function openAdoptionModal(int $id): void
    {
        $request = AdoptionRequest::findOrFail($id);

        $this->selectedName = $request->name;
        $this->selectedEmail = $request->email;
        $this->selectedMessage = $request->message;

        $this->dispatch('open-message-modal');
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

    public function acceptAdoption(int $id): void
    {

        $request = AdoptionRequest::findOrFail($id);

        $request->update([
            'status' => 'accepted',
            'read' => true,
        ]);
        $request->update([
            'status' => 'accepted',
            'read' => true,
        ]);

        Mail::to($request->email)->queue(
            new AdoptionAcceptedMail($request)
        );

        $this->loadData();
    }

    public function refuseAdoption(int $id): void
    {
        $request = AdoptionRequest::findOrFail($id);

        $request->update([
            'status' => 'refused',
            'read' => true,
        ]);
        Mail::to($request->email)->queue(
            new AdoptionRefusedMail($request)
        );
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

    public function deleteMsg(int $messageId): void
    {
        $message = ContactMessage::findOrFail($messageId);
        $message->delete();
    }

};
?>

<div>
    <div>

        <div>
            <x-layout.guest title="Messages">
                <main>
                    <x-header.side-bar/>
                    <h1 class="pl-72 mt-8 text-2xl uppercase text-text text-center">Liste des messages</h1>
                    <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
                        <section class="row-start-2 col-span-12">
                            <div>
                                <h2 class="pt-8 font-semibold text-text text-xl pb-4 uppercase">Messages non lus</h2>
                            </div>
                                <x-table.messages.messageTable
                                    :items="$messages"
                                    type="messages"
                                />
                            <div>
                                <h2 class="pt-8 font-semibold text-text text-xl pb-4 uppercase">Demandes d’adoptions</h2>
                            </div>
                            <x-table.messages.messageTable
                                :items="$adoptionRequests"
                                type="adoptions"
                            />
                        </section>
                    </div>
                </main>
            </x-layout.guest>
            <x-modals.messages_modal
                :selected-name="$selectedName"
                :selected-email="$selectedEmail"
                :selected-message="$selectedMessage"
            />
        </div>

    </div>

</div>
