<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div>
        <x-cards.dashboard_card :number="$this->unreadCount ?? 0" title="Messages non lus" svg="mail"
                                route="{{ route('admin.messages') }}"/>
    </div>
    <div>
        <x-cards.dashboard_card :number="$this->adoptionRequest ?? 0" title="Demandes non lues"
                                svg="bell"
                                route="{{ route('admin.messages') }}"/>
    </div>
    <div>
        <x-cards.dashboard_card :number="$this->volunteersCount" title="Bénévoles" svg="user"
                                route="{{ route('admin.planning') }}"/>
    </div>
    <div>
        <x-cards.dashboard_card :number="$this->animalsCount" title="Animaux" svg="animals"
                                route="{{ route('admin.animals') }}"/>
    </div>
</div>
