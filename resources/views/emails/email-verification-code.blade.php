<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('app.verification_code')}}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f8f8; border-radius: 5px;">
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #4a4a4a; text-align: center;">{{__('app.verification_code')}}</h1>
                <p style="font-size: 16px;">{{__('app.dear')}} {{$user->name}},</p>
                <p style="font-size: 16px;">{{__('app.verification_code_instructions')}}</p>
                <div style="background-color: #ffffff; border: 2px solid #dddddd; border-radius: 5px; padding: 15px; margin: 20px 0; text-align: center;">
                    <span style="font-size: 24px; font-weight: bold; letter-spacing: 5px;">{{$user->email_verification_code}}</span>
                </div>
                <p style="font-size: 16px;">{{__('app.verification_code_place')}}</p>
                <p style="font-size: 16px;">{{__('app.ignore_message')}}</p>
                <p style="font-size: 16px;">{{__('app.greetings')}}<br>{{__('app.company')}}</p>
            </td>
        </tr>
    </table>
</body>
</html>