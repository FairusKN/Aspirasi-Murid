<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Feedback Response</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin:0;padding:0;background-color:#f3f4f6;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f3f4f6;padding:20px 0;">
<tr>
<td align="center">

<!-- MAIN CONTAINER -->
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e5e7eb;">

    <!-- HEADER -->
    <tr>
        <td style="padding:24px;border-bottom:1px solid #e5e7eb;">
            <h1 style="margin:0;font-size:20px;color:#111827;">
                Your Feedback Has Been Updated
            </h1>
            <p style="margin:8px 0 0;color:#6b7280;font-size:14px;">
                An admin has responded to your submitted feedback.
            </p>
        </td>
    </tr>


    <!-- FEEDBACK CONTENT -->
    <tr>
        <td style="padding:24px;">

            <h2 style="margin:0 0 10px;font-size:16px;color:#374151;">
                Feedback Details
            </h2>

            <p style="margin:0 0 8px;color:#111827;">
                <strong>Title:</strong>
                {{ $feedback->feedback_title }}
            </p>

            <p style="margin:0 0 8px;color:#111827;">
                <strong>Category:</strong>
                {{ $feedback->category }}
            </p>

            <p style="margin:0 0 8px;color:#111827;">
                <strong>Status:</strong>
                {{ ucfirst(str_replace('_',' ', $feedback->status)) }}
            </p>

            <p style="margin-top:16px;color:#374151;line-height:1.6;white-space:pre-line;">
                {{ $feedback->details }}
            </p>

        </td>
    </tr>


    <!-- ADMIN RESPONSE -->
    <tr>
        <td style="padding:24px;background:#eff6ff;border-top:1px solid #dbeafe;border-bottom:1px solid #dbeafe;">

            <h2 style="margin:0 0 12px;font-size:16px;color:#1e40af;">
                Admin Response
            </h2>

            <p style="margin:0;color:#1f2937;line-height:1.6;white-space:pre-line;">
                {{ $feedback->admin_response }}
            </p>

            <p style="margin-top:12px;font-size:12px;color:#1d4ed8;">
                Responded on
                {{ $feedback->updated_at?->timezone('Asia/Jakarta')->format('F j, Y \a\t g:i A') }}
            </p>

        </td>
    </tr>


    <!-- CTA BUTTON -->
    <tr>
        <td align="center" style="padding:28px;">

            <a href="{{ route('pages.detailed_feedback', $feedback) }}"
               style="
                    background:#2563eb;
                    color:#ffffff;
                    text-decoration:none;
                    padding:12px 22px;
                    border-radius:6px;
                    font-size:14px;
                    font-weight:bold;
                    display:inline-block;
               ">
                View Full Feedback
            </a>

        </td>
    </tr>


    <!-- FOOTER -->
    <tr>
        <td style="padding:20px;border-top:1px solid #e5e7eb;text-align:center;">

            <p style="margin:0;font-size:12px;color:#9ca3af;">
                This is an automated message. Please do not reply directly.
            </p>

        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
