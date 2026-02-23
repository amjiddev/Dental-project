<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Appointment Booking</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="margin: 0;">New Appointment Booking</h1>
        </div>
        
        <div style="background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px;">
            <p style="font-size: 16px;">A new appointment has been booked through the website.</p>
            
            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h2 style="color: #0284c7; margin-top: 0;">Patient Information</h2>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Name:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ $appointment->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Email:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ $appointment->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Phone:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ $appointment->phone }}</td>
                    </tr>
                </table>
            </div>
            
            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h2 style="color: #0284c7; margin-top: 0;">Appointment Details</h2>
                
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
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Preferred Doctor:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ $appointment->doctor->name }}</td>
                    </tr>
                    @endif
                    @if($appointment->message)
                    <tr>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;"><strong>Message:</strong></td>
                        <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">{{ $appointment->message }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <p>Please confirm this appointment with the patient.</p>
            </div>
        </div>
    </div>
</body>
</html>
