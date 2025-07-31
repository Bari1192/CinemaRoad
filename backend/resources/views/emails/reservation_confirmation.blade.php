<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <head>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    </head>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div
        style="font-family:'Funnel Sans', Arial, sans-serif;margin:auto;font-weight: 400;min-height: 100vh; width: 100%; background-color: rgb(0, 32, 74); padding: 4rem 0;">
        <div style="width: 100%; max-width: 1200px; margin: auto; position: relative; padding: 0 20px;">
            <div
                style="width: 75%; font-size: 1.2rem; margin: -20px auto 0; padding: 24px 40px; background-color: rgb(4, 61, 104); border: 8px solid rgb(12, 74, 110); border-radius: 12px; text-align: justify; color: white; position: relative;">
                <p style="margin-bottom: 12px; font-size: 1.4rem; color: rgb(163, 230, 53); font-weight: bold;">Kedves
                    {{ $user->name }}!
                </p>
                <p style="margin: 12px 0; font-weight: bold;">Előfogalalásodat rögzítettük. Köszönjük, hogy a <b>CinemaRoad</b>-ot választottad!</p>

                <div style="border: 4px solid rgb(101, 163, 13); border-radius: 6px; padding: 12px; margin: 16px 0;">
                    <p style="margin: auto;">
                        Foglalásod részletei:
                    <ul>
                        <li>Vetítés helyszíne: {{ $location }}</li>
                        <li>Vetítés időpontja: {{ $screening_start_time }}</li>
                        <li>Megtekinteni kívánt film neve: {{ $movie_name }}</li>
                        <li>Lefoglalt nézőtér/hely(ek): {{ $reservation->seat }}</li>
                    </ul>
                    </p>
                    <p style="margin:auto;">
                    <p>Várunk szeretettel!</p>

                    <p>Üdvözlettel,</p>
                    <p>CinemaRoad - Autósmozi csapata.</p>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>