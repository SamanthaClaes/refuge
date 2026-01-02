<?php


use App\Mail\AdoptionRequestMail;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;


new class extends Component
{
    public int $animalId;
    public ?int $adopterId = null;


    public string $name = '';
    public string $email = '';
    public ?string $phone = null;
    public string $message = '';

    public function mount(int $animalId): void
    {
        $this->animalId = $animalId;
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'nullable|string',
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        $animal = Animal::where('id', $this->animalId)
            ->where('status', 'disponible')
            ->firstOrFail();

        $request = AdoptionRequest::create([
            'animal_id' => $animal->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
            'read' => false,
        ]);

        $animal->update([
            'status' => 'en attente',
        ]);

        Mail::to('elise@mail.be')
            ->queue(new AdoptionRequestMail($request));

        $this->dispatch('adoptionRequestCreated');

        $this->reset([
            'name',
            'email',
            'phone',
            'message',
        ]);

        session()->flash('success', 'Demande envoyée avec succès');
    }

};
