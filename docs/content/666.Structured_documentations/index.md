# **Főoldal (index) Komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens a jelenlegi webalkalmazás főoldala. Bemutatja a közelgő premier vetítéseket és premier filmeket. A filmkínálatba nyújt betekintést és kategóriánkénti csoportosítást, továbbá akciógombokkal, menürendszerrel és reszponzív kialakítással segíti a felhasználók könnyed tájékozódását a weboldalon.

- **Fő felhasználói interakciók**:
  - Filmkategóriák megeketintése és kiválasztása
  - Premier filmek megeketintése és böngészése
  - Mozihelyszínek áttekintése
  - További interakciók motiválása különböző menüpontokkal, gombokkal.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseHeader`
  - `MovieThemes`
  - `ClickBanner`
  - `BaseFooter`
  - `BaseCard`
  - `RetroCTA`
  - `useDriveInCinemaStore`
  - `useMovieStore`
  - `useScreeningStore`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**                                           |
| --------------- | ------------------------------------------------------------------- |
| `<BaseHeader>`  | Az oldal fejlécét biztosítja                                        |
| `<ClickBanner>` | Kattintható reklám/banner                                           |
| `<RetroCTA>`    | Szolgáltatások, figyelemfelkető rész (Call to Action)               |
| `<BaseCard>`    | Egy adott film részleteinek megjelenítését szolgálja a komponenssel |
| `<BaseFooter>`  | Az oldal láblécét biztosítja                                        |

## **4. Logika és interakciók**
- **Script setup tartalom**: Betölti a vetítéseket, filmeket és mozikat az oldal betöltésekor.
- **Eseménykezelés**: Filmek kiválasztása a kattintás esemény kezelésével.
- **Reaktív adatok**: `driveInCinemas`, `screenings`, `movies`, `loading`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                      |
| ------------------ | ---------------------------------- |
| **Színek**         | Rózsaszín (gombok), fehér háttér   |
| **Betűtípus**      | Nincs specifikálva                 |
| **Reszponzivitás** | Mobilbarát elrendezés              |
| **Effektek**       | Animációk a banneren és a gombokon |

## **Komponens tartalmi összefoglalója**
A komponens célja, hogy bemutassa a felhasználóknak a CinemaRoad weboldalát, fő profil irányát és képet kapjon a felhasználó / vendég az aktuális filmkínálatról, eseményekről, motiválva a jegyfoglalást és vásárlást egy felejthetetlen autós-mozi élményhez.