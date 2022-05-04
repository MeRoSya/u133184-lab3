<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

uses()->group('customers');

beforeEach(function () {
    Artisan::call('migrate:rollback');
    Artisan::call('migrate');
    Artisan::call('db:seed');
});

test('Can get customers', function () {
    $responce = $this->getJson('/api/v1/customers');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
            ->has('data.0', fn (AssertableJson $json) =>
            $json->has('id')->has('name'))->has('meta')
        );
});

test('Can get customers with addresses', function () {
    $responce = $this->getJson('/api/v1/customers?include=addresses');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
            ->has('data.0', fn (AssertableJson $json) =>
            $json->has('id')
                ->has('name')
                ->has('addresses'))->has('meta')
        );
});

test('Can get customers with orders', function () {
    $responce = $this->getJson('/api/v1/customers?include=orders');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
            ->has('data.0', fn (AssertableJson $json) =>
            $json->has('id')
                ->has('name')
                ->has('orders'))->has('meta')
        );
});

test('Can get customers with orders and addresses', function () {
    $responce = $this->getJson('/api/v1/customers?include=orders, addresses');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
            ->has('data.0', fn (AssertableJson $json) =>
            $json->has('id')
                ->has('name')
                ->has('orders')
                ->has('addresses'))->has('meta')
        );
});

test('Can get customers with addresses and orders', function () {
    $responce = $this->getJson('/api/v1/customers?include=addresses, orders');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
            ->has('data.0', fn (AssertableJson $json) =>
            $json->has('id')
                ->has('name')
                ->has('orders')
                ->has('addresses'))->has('meta')
        );
});

test("Can't get customers with invalid include", function () {
    $responce = $this->getJson('/api/v1/customers?include=dwadas');
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
    $responce = $this->getJson('/api/v1/customers');
    $responce->assertStatus(500)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));
});
