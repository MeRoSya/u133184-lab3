<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

uses()->group('addresses');

beforeEach(function () {
    Artisan::call('migrate:rollback');
    Artisan::call('migrate');
    Artisan::call('db:seed');
});

test('Can create address', function () {
    $responce = $this->postJson('/api/v1/addresses?customer_id=1&city=test&street=test&building=test&floor=1&flat=test');
    $responce->assertStatus(201)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data', fn (AssertableJson $json) =>
            $json->has('id')
                 ->has('customer')
                 ->where('city', 'test')
                 ->where('street', 'test')
                 ->where('building', 'test')
                 ->where('floor', '1')
                 ->where('flat', 'test'))
        );
});

test("Can't create address without some args", function () {
    $responce = $this->postJson('/api/v1/addresses?customer_id=1&city=test&street=test&building=test&flat=test');
    $responce->assertStatus(400)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));
});

test('Can change address', function () {
    $responce = $this->putJson('/api/v1/addresses/1?customer_id=1&city=test&street=test&building=test&floor=1&flat=test');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data', fn (AssertableJson $json) =>
        $json->has('id')
            ->has('customer')
            ->where('city', 'test')
            ->where('street', 'test')
            ->where('building', 'test')
            ->where('floor', '1')
            ->where('flat', 'test'))
        );
});

test('Can find address', function () {
    $responce = $this->putJson('/api/v1/addresses/12341221?customer_id=1&city=test&street=test&building=test&floor=1&flat=test');
    $responce->assertStatus(404)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));
});

test("Can't change address without some args", function () {
    $responce = $this->putJson('/api/v1/addresses/1?customer_id=1&city=test&street=test&building=test&flat=test');
    $responce->assertStatus(400)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));
});

test("Internal server error", function () {
    Artisan::call('migrate:rollback');
    $responce = $this->postJson('/api/v1/addresses?customer_id=1&city=test&street=test&building=test&floor=1&flat=test');
    $responce->assertStatus(500)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));

    $responce = $this->putJson('/api/v1/addresses/345?customer_id=1&city=test&street=test&building=test&floor=1&flat=test');
    $responce->assertStatus(500)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));
});
