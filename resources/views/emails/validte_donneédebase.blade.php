
@php
    use Illuminate\Support\Facades\Blade;

    $html = Blade::render($template->paragraph, ['article' => $article]);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Validation Approved</title>
    <style>
        @media screen and (max-width: 600px) {
            .content {
                width: 100% !important;
                display: block !important;
                padding: 10px !important;
            }
            .header, .body, .footer {
                padding: 20px !important;
            }
        }
    </style>
</head>
<body style="font-family: 'Poppins', Arial, sans-serif; margin: 0; padding: 0; background-color: #f7f7f7;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" style="padding: 20px;">
                <table class="content" width="600" border="0" cellspacing="0" cellpadding="0" style="background: #ffffff; border-collapse: collapse; border: 1px solid #e0e0e0;">
                    <!-- Header -->
                    <tr>
                        <td class="header" style="background-color: #{{ $template->codecolor }}; padding: 40px; text-align: center; color: white; font-size: 24px; font-weight: bold;">
                            Article Successfully Validated
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="body" style="padding: 40px; font-size: 16px; color: #333; line-height: 1.6;">
                            {!! $html !!}
                        </td>
                    </tr>

                    <!-- CTA Button -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="{{ route('articles.edit', $article->id) }}" target="_blank" style="background-color: #{{ $template->codecolor }}; color: #fff; padding: 12px 24px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                                View Article Details
                            </a>
                        </td>
                    </tr>

                    <!-- Additional Note -->
                    <tr>
                        <td class="body" style="padding: 0 40px 40px 40px; font-size: 14px; color: #555;">
                            If you have any questions or need assistance, feel free to reach out to our editorial team.
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer" style="background-color: #333; padding: 20px; text-align: center; color: white; font-size: 12px;">
                            &copy; 2025 SAP Master Data PIP. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
