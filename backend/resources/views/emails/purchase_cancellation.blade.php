<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>CinemaRoad - Jegyvásárlás törlés visszaigazolása</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>

<body style="background:#f3edef;margin:0;padding:0;font-family:'Nunito',Arial,sans-serif;color:#1a1a1a;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f3edef;padding:0;margin:0;">
        <tr>
            <td style="padding:32px 0; margin:auto;">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:480px;margin:0 auto;border-radius:25px;background:#fff;box-shadow:0 6px 30px #e91e6333, 0 0 3px #e91e63;border:3px dashed #ce93d8;overflow:hidden;">
                    <tr>
                        <td style="padding:24px 16px 8px 16px; margin:auto;">
                            <h1 style="color:#e91e63;font-size:1.5rem;font-weight:800;margin:0 0 6px 0;letter-spacing:2px;text-align:center;font-family: 'Cookie','Arial','Times New Roman', Times, serif;">Cinema Road</h1>
                            <h2 style="color:black;font-size:1.5rem;font-weight:800;margin:0 0 6px 0;letter-spacing:2px;text-align:center;">Vásárlás sikeres törlése</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 28px 8px 28px;text-align:left;color:#111;">
                            <p style="font-size:1.12rem;margin:0 0 12px 0;">
                                Kedves <span style="color:#e91e63;font-weight:700;">{{ $user->name ?? 'Vendégünk' }}</span>!
                            </p>
                            <p style="font-weight:bold;margin:0;">
                                {{ $ticket_code }} azonosítójú vásárlásodat sikeresen töröltük rendszerünkből.<br>
                                Reméljük, hogy legközelebb ismét viszont látunk a <span style="color:#e91e63;font-weight:700;">CinemaRoad</span> oldalán!
                            </p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding:0 32px 28px 32px;">
                            <hr style="margin:20px auto 16px auto;border:none;border-bottom:2px dashed #ce93d8;">
                            <div style="font-size:1rem;font-weight:bold;color:#e91e63;margin-bottom:4px;">Köszönettel,</div>
                            <div style="font-size:1rem;font-weight:700;font-style:italic;">CinemaRoad - Autósmozi csapat</div>
                            <div style="font-size:0.92rem;color:#aeaeae;font-style:italic;margin-top:14px;">
                                Kérdésed merült fel a vásárlással kapcsolatban? módosítani szeretnéd a jegyedet?? Írj nekünk a(z) <a href="mailto:info@cinemaroad.hu" style="color:#e91e63;text-decoration:underline;">info@cinemaroad.hu</a> címre!
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>