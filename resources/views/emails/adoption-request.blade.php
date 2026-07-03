<x-layout.email title="Nouvelle demande d'adoption">

    <h1 style="margin:0 0 24px;color:#4B2E1D;font-size:30px;font-weight:bold;">
        Nouvelle demande d'adoption
    </h1>

    <p style="margin:0 0 20px;color:#2D2D2D;font-size:16px;line-height:1.7;">
        Une nouvelle demande d'adoption a été soumise sur le site du refuge.
    </p>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="8"
           style="border-collapse:collapse;margin-bottom:24px;">

        <tr>
            <td style="font-weight:bold;color:#4B2E1D;width:140px;">
                Animal
            </td>
            <td style="color:#2D2D2D;">
                {{ $request->animal->name }}
            </td>
        </tr>

        <tr>
            <td style="font-weight:bold;color:#4B2E1D;">
                Nom
            </td>
            <td style="color:#2D2D2D;">
                {{ $request->name }}
            </td>
        </tr>

        <tr>
            <td style="font-weight:bold;color:#4B2E1D;">
                E-mail
            </td>
            <td style="color:#2D2D2D;">
                {{ $request->email }}
            </td>
        </tr>

    </table>

    <p style="margin:0 0 30px;color:#2D2D2D;font-size:16px;line-height:1.7;">
        Vous pouvez consulter cette demande directement depuis le tableau de bord du refuge.
    </p>

    <a href="{{ route('admin.dashboard') }}"
       style="display:inline-block;padding:12px 24px;background:#4B2E1D;color:#FFFFFF;text-decoration:none;border-radius:8px;font-weight:bold;">
        Accéder au tableau de bord
    </a>

</x-layout.email>
