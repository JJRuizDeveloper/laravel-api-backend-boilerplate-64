<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('app.password_reset')}}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f8f8; border-radius: 5px;">
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #4a4a4a; text-align: center;">{{__('app.password_reset')}}</h1>
                <p style="font-size: 16px;">{{__('app.dear')}} {{$user->name}},</p>
                <p style="font-size: 16px;">{{__('app.password_reset_instructions')}}</p>
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ $frontend_url }}/auth/recover-password/{{$user->id}}/{{$user->email_verification_code}}" style="background-color:  #0E1D6F; color: white; padding: 14px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border-radius: 5px;">{{__('app.reset_password')}}</a>
                </div>
                <p style="font-size: 16px;">{{__('app.password_reset_expiration')}}</p>
                <p style="font-size: 16px;">{{__('app.ignore_message')}}</p>
                <p style="font-size: 16px;">{{__('app.greetings')}}<br>{{__('app.company')}}</p>
            </td>
        </tr>
    </table>
</body>
</html>