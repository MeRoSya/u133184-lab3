<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\seed;

uses(RefreshDatabase::class);

uses()->group('customers');

beforeEach(function () {
    $seeder = new DatabaseSeeder();
    $seeder->run();
});

test('Can get customers', function () {
    $responce = $this->getJson('/api/v1/customers');
    $responce->assertStatus(200);
});
