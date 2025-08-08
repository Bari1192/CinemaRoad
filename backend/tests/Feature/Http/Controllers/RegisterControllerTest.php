<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use DatabaseTransactions;

    // B A S E
    public function test_guest_can_register()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "+06701234567",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(200);
    }

    // N A M E
    public function test_guest_can_not_register_with_too_long_name()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name Test Name Test Name Test Name Test Name Test Name Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "+06701234567",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_with_too_short_name()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test",
            "email" => "testemail@gmail.com",
            "phone" => "+06701234567",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    // E - M A I L
    public function test_guest_can_not_register_with_invalid_email_domain()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@invalid.com",
            "phone" => "+06701234567",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_with_too_long_email()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemailtestemailtestemailtestemailtestemail@gmail.com",
            "phone" => "+06701234567",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_with_too_short_email()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "test@gmail.com",
            "phone" => "+06701234567",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(422);
    }


    // P H O N E
    public function test_guest_can_not_register_with_too_long_phone_number()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "+0670123456765412398",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_with_too_short_phone_number()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "+0670123456",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_with_invalid_phone_number()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "06601234567",
            "password" => "Testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    // P A S S W O R D
    public function test_guest_can_not_register_with_too_short_password()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "06701234567",
            "password" => "Test_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_with_too_long_password()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "06701234567",
            "password" => "Testpassword123Testpassword123Testpassword123Testpassword123Testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_with_no_uppercase_letter_in_password()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "06701234567",
            "password" => "testpassword123_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_without_number_in_password()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "06701234567",
            "password" => "Testpassword_"
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_can_not_register_without_special_character_in_password()
    {
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "06701234567",
            "password" => "Testpassword123"
        ]);

        $response->assertStatus(422);
    }

    public function test_successful_registration_json_structure_is_correct(){
        $response = $this->postJson("/api/register", [
            "name" => "Test Name",
            "email" => "testemail@gmail.com",
            "phone" => "06701234567",
            "password" => "Testpassword123_"
        ]);


        $response->assertJsonStructure(["data" => ["message"]]); // tip: ez 2 asszertáció. Egy a 'data'-ra, másik a 'message'-re.
    }
}
