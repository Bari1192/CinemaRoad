<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>CinemaRoad - Foglalás visszaigazolása</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>

<body style="background:#f3edef;margin:0;padding:0;font-family:'Nunito',Arial,sans-serif;color:#1a1a1a;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f3edef;padding:0;margin:0;">
        <tr>
            <td style="padding:32px 0; margin:auto;">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:480px;margin:0 auto;border-radius:25px;background:#fff;box-shadow:0 6px 30px #65a30d33, 0 0 3px #65a30d;border:3px dashed #a3e635;overflow:hidden;">
                    <tr>
                        <td style="padding:24px 16px 8px 16px; margin:auto;">
                            <h1 style="color:#65a30d;font-size:1.5rem;font-weight:800;margin:0 0 6px 0;letter-spacing:2px;text-align:center;font-family: 'Cookie','Arial','Times New Roman', Times, serif;">Cinema Road</h1>
                            <h2 style="color:black;font-size:1.5rem;font-weight:800;margin:0 0 6px 0;letter-spacing:2px;text-align:center;">Előfoglalás visszaigazolva</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 28px 8px 28px;text-align:left;color:#111;">
                            <p style="font-size:1.12rem;margin:0 0 12px 0;">
                                Kedves <span style="color:#65a30d;font-weight:700;">{{ $user->name }}</span>!
                            </p>
                            <p style="font-weight:bold;margin:0;">
                                Előfoglalásodat sikeresen rögzítettük.<br>
                                Köszönjük, hogy a <span style="color:#65a30d;font-weight:700;">CinemaRoad</span>-ot választottad!
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:4px 24px 24px 24px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background:#ecfccb;border-radius:16px;padding: 16px;margin-top:18px;border-top: 4px dashed #65a30d;">
                                <tr>
                                    <td style="padding:16px;">
                                        <div style="font-size:1.1rem;font-weight:700;color:#65a30d;margin-bottom:10px;">
                                            Foglalásod részletei:
                                        </div>
                                        <ul style="padding-left:18px;margin:0;font-size:1rem;line-height:170%;">
                                            <li><b>Foglalás azonosítószáma:</b> <span style="text-transform:uppercase;font-weight:600;">{{ $ticket_code }}</span></li>
                                            <li><b>Vetítés helyszíne:</b> {{ $location }}</li>
                                            <li><b>Vetítés időpontja:</b> {{ \Carbon\Carbon::parse($screening_start_time)->format('Y. m. d. H:i') }}</li>
                                            <li><b>Film:</b> {{ $movie_name }}</li>
                                            <li><b>Parkolóhely:</b> {{ $parking_spot }}</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                     <p style="font-weight:bold;margin:0;">
                                Foglalásod a vetítés megkezdése előtti <u>20. percig</u> tudjuk fenntartani számodra. 
                                <p style="font-style: italic;">Kérjük a <b>vetítés megkezdése előtt</b> legalább <b>30-45 perccel</b> vedd át a jegyedet a jegykiadó pultunknál!</p>
                               
                            </p>
                    <tr>
                        <td style="padding:0 32px 28px 32px;">
                            <hr style="margin:20px auto 16px auto;border:none;border-bottom:2px dashed #a3e635;">
                            <div style="font-size:1rem;font-weight:bold;color:#65a30d;margin-bottom:4px;">Várunk szeretettel,</div>
                            <div style="font-size:1rem;font-weight:700;font-style:italic;">CinemaRoad - Autósmozi csapat</div>
                            <div style="font-size:0.92rem;color:#aeaeae;font-style:italic;margin-top:14px;">
                                Kérdésed merült fel a foglalással kapcsolatban? Módosítani szeretnéd a jegyedet? Írj nekünk a(z) <a href="mailto:info@cinemaroad.hu" style="color:#65a30d;text-decoration:underline;">info@cinemaroad.hu</a> címre!
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
