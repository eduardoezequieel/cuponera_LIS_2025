<?php

namespace Tests\Feature;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear roles si no existen
        Role::firstOrCreate(['name' => 'empresa']);
        Role::firstOrCreate(['name' => 'cliente']);
        Role::firstOrCreate(['name' => 'admin']);
    }

    public function test_company_can_access_coupon_index()
    {
        $user = User::factory()->create(['company_approved' => true]);
        $user->assignRole('empresa');

        $response = $this->actingAs($user)->get(route('company.coupons.index'));

        $response->assertStatus(200);
    }

    public function test_company_can_create_coupon()
    {
        $user = User::factory()->create(['company_approved' => true]);
        $user->assignRole('empresa');

        $couponData = [
            'title' => 'Cupón de prueba',
            'regular_price' => 100.00,
            'offer_price' => 80.00,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(30)->format('Y-m-d'),
            'redemption_deadline' => now()->addDays(60)->format('Y-m-d'),
            'description' => 'Descripción del cupón de prueba',
            'status' => 'available',
            'quantity' => 100,
        ];

        $response = $this->actingAs($user)->from(route('company.coupons.create'))->post(route('company.coupons.store'), $couponData);

        $response->assertRedirect(route('company.coupons.index'));
        $this->assertDatabaseHas('coupons', [
            'title' => 'Cupón de prueba',
            'user_id' => $user->id,
        ]);
    }

    public function test_non_company_cannot_access_coupon_routes()
    {
        $user = User::factory()->create();
        $user->assignRole('cliente');

        $response = $this->actingAs($user)->get(route('company.coupons.index'));

        $response->assertStatus(403);
    }

    public function test_navigation_shows_coupons_link_for_companies()
    {
        $user = User::factory()->create(['company_approved' => true]);
        $user->assignRole('empresa');

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Mis Cupones');
        $response->assertSee(route('company.coupons.index'));
    }
}
