<?php

namespace livewire\pages\⚡contactForm;

use App\Mail\NewContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

new class extends Component {
    public string $name = '';
    public string $firstName = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        ContactMessage::create([
            'name' => $validated['name'],
            'first_name' => $validated['firstName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
        ]);
        Mail::to('elise@refuge.be')
            ->queue(new NewContactMessageMail());

        $this->dispatch('messageCreated');

        $this->reset();

        session()->flash('success', 'Message envoyé avec succès!');
    }
};
