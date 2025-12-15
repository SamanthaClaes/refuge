<?php

use App\Http\Livewire\Pages\Animal\AnimalPages;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function (){
    $user = \App\Models\User::Factory()->create();
    $this->actingAs($user);
});

it('renders successfully', function () {
    Livewire::test(AnimalPages::class)
        ->assertStatus(200);
});

it('assert animal name exist', function () {
    Animal::factory()->create(['name' => 'Stuart']);
    Animal::factory()->create(['name' => 'Rex']);

    Livewire::test(AnimalPages::class)->assertSee('Rex')->assertSee('Stuart');
});

it('assert animal breed exist', function () {
    Animal::factory()->create(['breed' => 'Berger Allemand']);
    Animal::factory()->create(['breed' => 'Berger Malinois']);

    Livewire::test(AnimalPages::class)->assertSee('Berger Allemand')->assertSee('Berger Malinois');
});

it('assert animal gender exist', function () {
    Animal::factory()->create(['gender' => true]);
    Animal::factory()->create(['gender' => false]);

    Livewire::test(AnimalPages::class)->assertSee('Mâle')->assertSee('Femelle');
});

it('assert animal status exist', function () {
    Animal::factory()->create(['status' => 'Disponible']);

    Livewire::test(AnimalPages::class)->assertSee('Disponible');
});

it('assert animal file exist', function () {
    Animal::factory()->create(['file' => true]);
    Animal::factory()->create(['file' => false]);

    Livewire::test(AnimalPages::class)->assertSee('validée')->assertSee('à valider');
});

it('can retrieve unadopted animals for which there is an interest from an adopter', function () {
    $animals = Animal::factory(5)->create();
    $adopter = Adopter::factory()->create();
    foreach ($animals as $animal) {
        Adoption::create([
            'animal_id' => $animal->id,
            'adopter_id' => $adopter->id,
            'started_at' => \Carbon\Carbon::now(),
        ]);
    }
    expect(Adoption::with('animal')->ongoing()->get()->count())->toBe(5);
//    dd(Adoption::first()->animal->name);
});

it('display the complete animals list on the animal index page', function () {
    $animals = Animal::factory(5)->create();

    $response = $this->get('/animals');

    foreach ($animals as $animal){
        $response->assertSeeText($animal->name);
    }
});

it('homepage contains empty table', function () {
    $response = $this->get('admin/animals');
    $response->assertSee('Aucun animal n’a été trouvé');
});

it('the application return a successful response', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

it('create successfully an animal from the data provide by the request', function () {
    $animal = Animal::factory()->create();

    assertDatabaseHas('animals', ['name'=>$animal['name']]);
});

it('fails to create in new animal in db when there missing data in the request', function () {
    Livewire::test(AnimalPages::class)
    ->set('name', null)
    ->set('breed', 'Labrador')
        ->set('species', 'chien')
        ->set('age', 5)
        ->call('createAnimalinDB')
        ->assertHasErrors(['name' => 'required']);
    assertDatabaseEmpty('animals');
});
