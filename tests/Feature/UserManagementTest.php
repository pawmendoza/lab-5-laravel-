<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_user_is_saved_and_shown_in_user_management(): void
    {
        $admin = User::factory()->create(['email_verified_at' => now()]);

        $response = $this->actingAs($admin)->post(route('users.store'), [
            'name' => 'New Staff Member',
            'email' => 'new.staff@example.com',
            'password' => 'secure-pass-123',
        ]);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'New Staff Member',
            'email' => 'new.staff@example.com',
        ]);
        $this->assertTrue(Hash::check(
            'secure-pass-123',
            User::where('email', 'new.staff@example.com')->value('password')
        ));

        $this->get(route('users.index'))
            ->assertOk()
            ->assertSee('New Staff Member')
            ->assertSee('new.staff@example.com');
    }

    public function test_user_creation_form_explains_validation_errors(): void
    {
        $admin = User::factory()->create(['email_verified_at' => now()]);

        $response = $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), [
                'name' => 'Staff Member',
                'email' => 'staff@example.com',
                'password' => 'short',
            ]);

        $response->assertRedirect(route('users.create'));
        $this->get(route('users.create'))
            ->assertOk()
            ->assertSee('Hindi naidagdag ang user')
            ->assertSee('The password field must be at least 8 characters.');
        $this->assertDatabaseMissing('users', ['email' => 'staff@example.com']);
    }

    public function test_user_can_be_edited_without_changing_password_when_left_blank(): void
    {
        $admin = User::factory()->create(['email_verified_at' => now()]);
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'password' => 'original-password',
        ]);
        $originalPassword = $user->password;

        $this->actingAs($admin)
            ->get(route('users.edit', $user))
            ->assertOk()
            ->assertSee('Edit User')
            ->assertSee('old@example.com');

        $this->actingAs($admin)
            ->put(route('users.update', $user), [
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
                'password' => '',
            ])
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => $originalPassword,
        ]);
    }

    public function test_user_can_be_deleted(): void
    {
        $admin = User::factory()->create(['email_verified_at' => now()]);
        $user = User::factory()->create();

        $this->actingAs($admin)
            ->get(route('users.index'))
            ->assertOk()
            ->assertSee('Delete');

        $this->actingAs($admin)
            ->delete(route('users.destroy', $user))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_signed_in_user_cannot_delete_their_own_account(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->delete(route('users.destroy', $user))
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}
