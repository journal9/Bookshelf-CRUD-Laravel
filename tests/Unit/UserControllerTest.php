<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;

use function PHPUnit\Framework\assertEquals;

class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function test_duplicate_email_input_returns_failed_response(): void
    {
        // $this->assertTrue(true);
        $data = [
            'name' => "Simran",
            'email' => "deepikajamwal7@gmail.com",
            'role_id' => 2,
            'age' => 11,
            'phone_number' => 383849857,
            'password' => 'simran@123'
        ];
        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->postJson('api/users/add', $data)
            ->assertStatus(422);
    }
    public function test_incorrect_email_input_returns_failed_response(): void
    {
        $data = [
            'name' => "Simran",
            'email' => "sikki.php.com",
            'role_id' => 2,
            'age' => 20,
            'phone_number' => 383849857,
            'password' => 'simran@123'
        ];
        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->postJson('api/users/add', $data)
            ->assertStatus(422);
    }
    public function test_incorrect_roleId_input_returns_failed_response(): void
    {
        $data = [
            'name' => "Simran",
            'email' => "simran11@gmail.com",
            'role_id' => "third",
            'age' => 20,
            'phone_number' => 383849857,
            'password' => 'simran@123'
        ];
        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->postJson('api/users/add', $data)
            ->assertStatus(422);

        //  dd($response->getContent());
    }
    public function test_incorrect_age_input_returns_failed_response(): void
    {
        $data = [
            'name' => "Simran",
            'email' => "simran11@gmail.com",
            'role_id' => 2,
            'age' => "twenty",
            'phone_number' => 383849857,
            'password' => 'simran@123'
        ];
        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->postJson('api/users/add', $data)
            ->assertStatus(422);
    }
    public function test_successful_creation_creates_subscription_over_field_of_1_more_years(): void
    {
        $data = [
            'name' => "Simran",
            'email' => "simmikumari9@gmail.com",
            'role_id' => 2,
            'age' => 20,
            'phone_number' => "383849857",
            'password' => 'simran@123'
        ];
        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->postJson('api/users/add', $data);
        //  dd(json_decode($response->getContent(),true));
        $response->assertJsonFragment([
            'subscription_over' => date('Y-m-d', strtotime('+1 years')),
        ])->assertStatus(201);
    }
    public function test_updating_a_non_existent_user_returns_failed_response(): void
    {

        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->put('api/users/100/update')
            ->assertStatus(422);
    }

    public function test_deleting_a_non_existent_user_returns_failed_response(): void
    {

        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->delete('api/users/100/remove')
            ->assertStatus(422);
    }

    public function test_updating_user_with_invalid_values_returns_failed_response(): void
    {
        $data = [
            'age' => "sixty two"
        ];
        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->putJson('api/users/80/update', $data)
            ->assertStatus(422);
    }

    public function test_fetching_all_users_returns_paginated_response(): void
    {
        $response = $this->withHeaders([
            'authorization' => "Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->get('api/users/all')->assertStatus(200);
        $all_users = User::count();
        $response->assertJsonCount(ceil($all_users / 5));
    }
}
