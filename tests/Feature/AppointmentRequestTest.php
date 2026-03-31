<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AppointmentRequestTest extends TestCase
{
    use DatabaseTransactions;

    public function test_client_can_send_appointment_request_to_lawyer()
    {
        $client = User::find(1);
        $lawyer = User::find(3);

        if (! $client || ! $lawyer) {
            $this->markTestSkipped('Required user records are not present in the database.');
        }

        $client->email_verified_at = now();
        $client->save();

        $response = $this->actingAs($client)
            ->post('/annuaire/'.$lawyer->id.'/demande', [
                'notes' => 'Test rendez-vous',
            ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }
}
