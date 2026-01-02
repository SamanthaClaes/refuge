<?php


use App\Mail\AdoptionRequestMail;
use App\Models\AdoptionRequest;
use Livewire\Component;

new class extends Component
{
    public int $animalId;
    public ?int $adopterId = null;


    public string $name = '';
    public string $firstName = '';
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
            'firstName' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'nullable|string',
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        $request = AdoptionRequest::create([
            'animal_id' => $this->animalId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
        ]);

        Mail::to('elise@mail.be')
            ->send(new AdoptionRequestMail($request));

        $this->dispatch('adoptionRequestCreated');

        $this->reset();

        session()->flash('success', 'Demande envoyée avec succès');
    }
};
