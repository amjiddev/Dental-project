<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appointment Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="margin: 0;">Appointment Confirmed!</h1>
        </div>
        
        <div style="background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px;">
            <p style="font-size: 16px;">Dear {{ $appointment->name }},</p>
            
            <p>Thank you for booking an appointment with Qasmi Dental & Aesthetic Centre. Your appointment has been successfully confirmed.</p>
            
            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2 style="color: #1e40af; margin-top: 0;">Appointment Details</h2>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Date:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ $appointment->appointment_date->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Time:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>
                    </tr>
                    @if($appointment->service)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Service:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ $appointment->service->name }}</td>
                    </tr>
                    @endif
                    @if($appointment->doctor)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Doctor:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ $appointment->doctor->name }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 10px 0;"><strong>Status:</strong></td>
                        <td style="padding: 10px 0;"><span style="background: #10b981; color: white; padding: 4px 12px; border-radius: 12px; font-size: 14px;">Confirmed</span></td>
                    </tr>
                </table>
            </div>
            
            <div style="background: #dbeafe; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #3b82f6;">
                <p style="margin: 0;"><strong>Important:</strong> Please arrive 10 minutes before your scheduled appointment time.</p>
            </div>
            
            <p>If you need to reschedule or cancel your appointment, please contact us at least 24 hours in advance.</p>
            
            <div style="text-align: center; margin-top: 30px; padding: 20px; background: white; border-radius: 8px;">
                <p style="margin: 0 0 10px 0;"><strong>Contact Us:</strong></p>
                <p style="margin: 5px 0;">📞 Phone: {{ config('app.phone', '+92 XXX XXXXXXX') }}</p>
                <p style="margin: 5px 0;">📧 Email: {{ config('app.email', 'info@manjidental.com') }}</p>
                <p style="margin: 5px 0;">📍 Address: Lahore, Pakistan</p>
            </div>
            
            <p style="text-align: center; color: #6b7280; font-size: 14px; margin-top: 30px;">
                We look forward to seeing you!<br>
                <strong>Qasmi Dental & Aesthetic Centre Team</strong>
            </p>
        </div>
    </div>
</body>
</html>
