<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Bank;
use App\Models\User;
use App\Models\Cart;

class CartTest extends TestCase
{
    /** @test */
    public function test_create_cart()
    {

        $user = User::factory()->make(['role_id'=> 1]);

        $bank = Bank::factory()->make();


        $response = $this->actingAs($user)
            ->post(route('admin.cart.store',
            [
                'user_id' => $user->id,
                'bank_id' => $bank->id,
                'shomare_cart' => '123456789',
                'shomare_shaba' => '123456789'
            ]
        ));

        $response->assertRedirect('/');
    }

    public function test_update_cart()
    {
        $user = User::factory()->make(['role_id'=> 1]);

        $cart = Cart::factory()->create();

        $bank = Bank::factory()->make();

        $data = [
            'user_id' => $user->id,
            'bank_id' => $bank->id,
            'shomare_cart' => '1111111111111',
            'shomare_shaba' => '1111111111111',
        ];


        $response = $this->actingAs($user)
            ->post(route('admin.cart.update',['cart' => $cart]
        ), $data);

        $response->assertRedirect('/');
    }

    public function test_delete_cart()
    {

        $user = User::factory()->make(['role_id'=> 1]);

        $cart = Cart::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('admin.cart.delete',['cart' => $cart]
        ));

        $response->assertRedirect('/');
    }
}
