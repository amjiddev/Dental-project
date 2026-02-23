<?php

namespace App\Services;

/**
 * SMS Service for sending SMS notifications
 * 
 * This service provides a unified interface for sending SMS messages
 * using various SMS providers (Twilio, Nexmo, AWS SNS, etc.)
 * 
 * To use this service:
 * 1. Install SMS provider SDK (e.g., composer require twilio/sdk)
 * 2. Add credentials to .env file
 * 3. Uncomment the provider implementation below
 * 4. Inject this service into your controllers
 */
class SmsService
{
    /**
     * Send SMS message
     * 
     * @param string $to Phone number (with country code, e.g., +1234567890)
     * @param string $message SMS message content
     * @return bool Success status
     */
    public function send($to, $message)
    {
        // Check if SMS is enabled
        if (!env('SMS_ENABLED', false)) {
            \Log::info('SMS disabled. Would send to ' . $to . ': ' . $message);
            return false;
        }

        try {
            // Choose your SMS provider implementation
            return $this->sendViaTwilio($to, $message);
            // return $this->sendViaNexmo($to, $message);
            // return $this->sendViaAwsSns($to, $message);
        } catch (\Exception $e) {
            \Log::error('SMS Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send SMS via Twilio
     * 
     * Setup:
     * 1. composer require twilio/sdk
     * 2. Add to .env:
     *    TWILIO_SID=your_account_sid
     *    TWILIO_TOKEN=your_auth_token
     *    TWILIO_FROM=+1234567890
     */
    protected function sendViaTwilio($to, $message)
    {
        // Uncomment when Twilio is installed
        /*
        $twilio = new \Twilio\Rest\Client(
            env('TWILIO_SID'),
            env('TWILIO_TOKEN')
        );

        $twilio->messages->create($to, [
            'from' => env('TWILIO_FROM'),
            'body' => $message
        ]);

        return true;
        */

        \Log::info('Twilio SMS (not configured): ' . $to . ' - ' . $message);
        return false;
    }

    /**
     * Send SMS via Nexmo (Vonage)
     * 
     * Setup:
     * 1. composer require vonage/client
     * 2. Add to .env:
     *    NEXMO_KEY=your_api_key
     *    NEXMO_SECRET=your_api_secret
     *    NEXMO_FROM=YourBrand
     */
    protected function sendViaNexmo($to, $message)
    {
        // Uncomment when Nexmo is installed
        /*
        $basic = new \Vonage\Client\Credentials\Basic(
            env('NEXMO_KEY'),
            env('NEXMO_SECRET')
        );
        
        $client = new \Vonage\Client($basic);

        $client->sms()->send(
            new \Vonage\SMS\Message\SMS($to, env('NEXMO_FROM'), $message)
        );

        return true;
        */

        \Log::info('Nexmo SMS (not configured): ' . $to . ' - ' . $message);
        return false;
    }

    /**
     * Send SMS via AWS SNS
     * 
     * Setup:
     * 1. composer require aws/aws-sdk-php
     * 2. Add to .env:
     *    AWS_ACCESS_KEY_ID=your_key
     *    AWS_SECRET_ACCESS_KEY=your_secret
     *    AWS_DEFAULT_REGION=us-east-1
     */
    protected function sendViaAwsSns($to, $message)
    {
        // Uncomment when AWS SDK is installed
        /*
        $sns = new \Aws\Sns\SnsClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $sns->publish([
            'Message' => $message,
            'PhoneNumber' => $to,
        ]);

        return true;
        */

        \Log::info('AWS SNS SMS (not configured): ' . $to . ' - ' . $message);
        return false;
    }

    /**
     * Send appointment confirmation SMS
     * 
     * @param object $appointment Appointment model instance
     * @return bool
     */
    public function sendAppointmentConfirmation($appointment)
    {
        $message = sprintf(
            "Hi %s, your dental appointment is confirmed for %s at %s. See you soon! - Dental Clinic",
            $appointment->name,
            $appointment->appointment_date->format('M d, Y'),
            date('h:i A', strtotime($appointment->appointment_time))
        );

        return $this->send($appointment->phone, $message);
    }

    /**
     * Send appointment reminder SMS
     * 
     * @param object $appointment Appointment model instance
     * @return bool
     */
    public function sendAppointmentReminder($appointment)
    {
        $message = sprintf(
            "Reminder: You have a dental appointment tomorrow at %s. Reply CONFIRM or call us. - Dental Clinic",
            date('h:i A', strtotime($appointment->appointment_time))
        );

        return $this->send($appointment->phone, $message);
    }

    /**
     * Send appointment cancellation SMS
     * 
     * @param object $appointment Appointment model instance
     * @return bool
     */
    public function sendAppointmentCancellation($appointment)
    {
        $message = sprintf(
            "Your appointment on %s has been cancelled. Please call us to reschedule. - Dental Clinic",
            $appointment->appointment_date->format('M d, Y')
        );

        return $this->send($appointment->phone, $message);
    }

    /**
     * Format phone number for SMS
     * 
     * @param string $phone Phone number
     * @return string Formatted phone number with country code
     */
    public function formatPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Add country code if not present (assuming US +1)
        if (strlen($phone) == 10) {
            $phone = '1' . $phone;
        }

        // Add + prefix
        if (substr($phone, 0, 1) !== '+') {
            $phone = '+' . $phone;
        }

        return $phone;
    }
}
