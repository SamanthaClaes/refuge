<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body style="margin:0;padding:40px;background:#F8F5F1;font-family:Arial,Helvetica,sans-serif;">

<table role="presentation" width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center">

            <table
                role="presentation"
                width="600"
                cellspacing="0"
                cellpadding="0"
                style="background:#FFFFFF;border:1px solid #E5DED6;border-radius:20px;overflow:hidden;"
            >

                <tr>
                    <td style="background:#D4977E;padding:30px;">

                        <img
                            src="{{ asset('img/Logo.png') }}"
                            alt="Logo du Refuge Les Pattes Heureuses"
                            width="70"
                        >

                    </td>
                </tr>

                <tr>
                    <td style="padding:40px;font-size:16px;line-height:1.7;color:#2D2D2D;">

                        {{ $slot }}

                    </td>
                </tr>

                <tr>
                    <td
                        style="padding:25px;background:#F5F2EE;color:#777777;font-size:13px;line-height:1.6;"
                    >

                        <strong style="color:#4B2E1D;">
                            Refuge Les Pattes Heureuses
                        </strong>
                        <br><br>

                        Cet e-mail a été envoyé automatiquement.
                        <br>
                        Merci de ne pas y répondre.

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
