<?php

namespace Tests\Feature\Admin;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ContactSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_save_contact_settings_and_frontend_displays_them(): void
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $settings = [
            'contact_heading' => 'Get in touch with our clinic',
            'contact_subtitle' => 'We are happy to help.',
            'contact_address' => "15 Example Road\nLahore, Pakistan",
            'contact_phone' => '+92 300 1234567',
            'contact_email' => 'clinic@example.com',
            'contact_hours_weekday' => '8:00 AM - 5:00 PM',
            'contact_hours_saturday' => '9:00 AM - 1:00 PM',
            'contact_hours_sunday' => 'Closed',
            'contact_whatsapp' => '+92 300 1234567',
            'contact_facebook' => 'https://facebook.com/example',
            'contact_instagram' => 'https://instagram.com/example',
            'contact_twitter' => 'https://twitter.com/example',
            'contact_linkedin' => 'https://linkedin.com/company/example',
        ];

        $this->actingAs($admin)
            ->put(route('admin.settings.contact.update'), $settings)
            ->assertRedirect(route('admin.settings.contact'))
            ->assertSessionHas('success');

        foreach ($settings as $key => $value) {
            $this->assertDatabaseHas('settings', ['key' => $key, 'value' => $value]);
        }

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Get in touch with our clinic')
            ->assertSee('15 Example Road')
            ->assertSee('Lahore, Pakistan')
            ->assertSee('+92 300 1234567')
            ->assertSee('clinic@example.com');
    }

    public function test_contact_settings_form_reports_missing_address(): void
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $settings = [
            'contact_heading' => 'Contact Us',
            'contact_subtitle' => 'Get in touch.',
            'contact_phone' => '+92 300 1234567',
            'contact_email' => 'clinic@example.com',
            'contact_hours_weekday' => '8:00 AM - 5:00 PM',
            'contact_hours_saturday' => '9:00 AM - 1:00 PM',
        ];

        $this->actingAs($admin)
            ->from(route('admin.settings.contact'))
            ->put(route('admin.settings.contact.update'), $settings)
            ->assertSessionHasErrors('contact_address')
            ->assertRedirect(route('admin.settings.contact'));

        $this->assertDatabaseMissing('settings', ['key' => 'contact_heading']);
    }
}
