<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>New Contact Message</title>
</head>
<body style="margin:0; padding:0; background:#f3f4f6; color:#1f2937; font-family:Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="width:100%; background:#f3f4f6; margin:0; padding:0;">
        <tr>
            <td align="center" style="padding:32px 16px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="width:100%; max-width:680px; background:#ffffff; border:1px solid #e5e7eb; border-radius:12px; overflow:hidden;">
                    <tr>
                        <td style="background:#b91c1c; padding:26px 28px;">
                            <div style="font-size:13px; line-height:18px; letter-spacing:0.08em; text-transform:uppercase; color:#fecaca; font-weight:700;">
                                Website Inquiry
                            </div>
                            <h1 style="margin:6px 0 0; font-size:24px; line-height:32px; color:#ffffff; font-weight:700;">
                                New Contact Message
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:28px;">
                            <p style="margin:0 0 22px; color:#4b5563; font-size:15px; line-height:24px;">
                                A new message was submitted from the contact form on your website.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td style="padding:14px 0; border-top:1px solid #f3f4f6; width:150px; color:#6b7280; font-size:13px; line-height:20px; font-weight:700; text-transform:uppercase;">
                                        Name
                                    </td>
                                    <td style="padding:14px 0; border-top:1px solid #f3f4f6; color:#111827; font-size:15px; line-height:22px; font-weight:700;">
                                        {{ $messageData->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 0; border-top:1px solid #f3f4f6; width:150px; color:#6b7280; font-size:13px; line-height:20px; font-weight:700; text-transform:uppercase;">
                                        Email
                                    </td>
                                    <td style="padding:14px 0; border-top:1px solid #f3f4f6; color:#111827; font-size:15px; line-height:22px;">
                                        <a href="mailto:{{ $messageData->email }}" style="color:#b91c1c; text-decoration:none; font-weight:700;">
                                            {{ $messageData->email }}
                                        </a>
                                    </td>
                                </tr>
                                @if($messageData->phone)
                                    <tr>
                                        <td style="padding:14px 0; border-top:1px solid #f3f4f6; width:150px; color:#6b7280; font-size:13px; line-height:20px; font-weight:700; text-transform:uppercase;">
                                            Phone
                                        </td>
                                        <td style="padding:14px 0; border-top:1px solid #f3f4f6; color:#111827; font-size:15px; line-height:22px;">
                                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $messageData->phone) }}" style="color:#111827; text-decoration:none;">
                                                {{ $messageData->phone }}
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            </table>

                            <div style="margin-top:24px;">
                                <div style="margin-bottom:8px; color:#6b7280; font-size:13px; line-height:20px; font-weight:700; text-transform:uppercase;">
                                    Message
                                </div>
                                <div style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:18px; color:#111827; font-size:15px; line-height:24px; white-space:pre-wrap;">{{ $messageData->message }}</div>
                            </div>

                            <table role="presentation" cellspacing="0" cellpadding="0" style="margin-top:26px;">
                                <tr>
                                    <td style="background:#b91c1c; border-radius:8px;">
                                        <a href="mailto:{{ $messageData->email }}" style="display:inline-block; padding:12px 18px; color:#ffffff; font-size:14px; line-height:20px; font-weight:700; text-decoration:none;">
                                            Reply to Message
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#f9fafb; border-top:1px solid #e5e7eb; padding:18px 28px;">
                            <p style="margin:0; color:#6b7280; font-size:12px; line-height:18px;">
                                This notification was generated automatically by the {{ config('app.name') }} website.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
