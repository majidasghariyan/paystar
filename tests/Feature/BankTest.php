<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Bank;
use App\Models\User;

class BankTest extends TestCase
{
    /** @test */
    public function test_create_bank()
    {

        $user = User::factory()->make(['role_id'=> 1]);

        $bank = Bank::factory()->make();

        $response = $this->actingAs($user)
            ->post(route('admin.bank.store',['name' => $bank->name]
        ));

        $response->assertRedirect('/');

        // $response->assertStatus(200);
        // we are use back() in controller this is why we get failed 302
    }

    public function test_update_bank()
    {

        $user = User::factory()->make(['role_id'=> 1]);

        $bank = Bank::factory()->create();

        $data = [
            'name' => 'خصوصی',
        ];

        $response = $this->actingAs($user)
            ->post(route('admin.bank.update',['bank' => $bank]
        ) ,$data);

        $response->assertRedirect('/');
    }


    public function test_delete_bank()
    {

        $user = User::factory()->make(['role_id'=> 1]);

        $bank = Bank::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('admin.bank.delete',['bank' => $bank]
        ));

        $response->assertRedirect('/');
    }



}
