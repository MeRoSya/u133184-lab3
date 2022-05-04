<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

uses()->group('orders');

beforeEach(function () {
    Artisan::call('migrate:rollback');
    Artisan::call('migrate');
    Artisan::call('db:seed');
});

test('Can create orders', function () {
    $responce = $this->postJson('/api/v1/orders?address_id=1&customer_id=1&creation_time=2022-05-04T11:56:40.084Z&deliver_before=2022-05-04T11:56:40.084Z&cost=121312&payed=1&delivered=0');
    $responce->assertStatus(201)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data', fn (AssertableJson $json) =>
            $json->has('id')
                 ->has('customer')
                 ->has('address')
                 ->where('creation_time', '2022-05-04T11:56:40.084Z')
                 ->where('deliver_before', '2022-05-04T11:56:40.084Z')
                 ->where('cost', '121312')
                 ->where('payed', '1')
                 ->where('delivered', '0'))
        );
});

test("Can't create orders without some args", function () {
    $responce = $this->postJson('/api/v1/orders?address_id=1&customer_id=1&creation_time=2022-05-04T11:56:40.084Z&deliver_before=2022-05-04T11:56:40.084Z&cost=121312&payed=1');
    $responce->assertStatus(400)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));
});

test('Can patch orders', function () {
    $responce = $this->patchJson('/api/v1/orders/1?address_id=1&customer_id=1&creation_time=2022-05-04T11:56:40.084Z&deliver_before=2022-05-04T11:56:40.084Z&cost=121312&payed=1&delivered=0');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->has('data', fn (AssertableJson $json) =>
        $json->has('id')
            ->has('customer')
            ->has('address')
            ->where('creation_time', '2022-05-04T11:56:40.084Z')
            ->where('deliver_before', '2022-05-04T11:56:40.084Z')
            ->where('cost', '121312')
            ->where('payed', '1')
            ->where('delivered', '0'))
        );
});

test("Can't patch orders", function () {
    $responce = $this->patchJson('/api/v1/orders/345?address_id=1&customer_id=1&creation_time=2022-05-04T11:56:40.084Z&deliver_before=2022-05-04T11:56:40.084Z&cost=121312&payed=1&delivered=0');
    $responce->assertStatus(404)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));
});

test('Can delete orders', function () {
    $responce = $this->deleteJson('/api/v1/orders/1');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null));
});

test("Can't delete orders", function () {
    $responce = $this->deleteJson('/api/v1/orders/345');
    $responce->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null));
});

test("Internal server error", function () {
    Artisan::call('migrate:rollback');
    $responce = $this->postJson('/api/v1/orders?address_id=1&customer_id=1&creation_time=2022-05-04T11:56:40.084Z&deliver_before=2022-05-04T11:56:40.084Z&cost=121312&payed=1&delivered=0');
    $responce->assertStatus(500)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));

    $responce = $this->patchJson('/api/v1/orders/1?address_id=1&customer_id=1&creation_time=2022-05-04T11:56:40.084Z&deliver_before=2022-05-04T11:56:40.084Z&cost=121312&payed=1&delivered=0');
    $responce->assertStatus(500)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));

    $responce = $this->deleteJson('/api/v1/orders/345');
    $responce->assertStatus(500)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('data', null)
            ->has('errors')
            ->has('errors.0', fn (AssertableJson $json) =>
            $json->has('code')
                ->has('message')
                ->has('meta')));
});
