# **FilmSelection (aktuális filmkínálat) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens a felhasználók számára bemutatja az aktuálisan elérhető filmeket, lehetőséget biztosítva film típusok szerinti szűrésre, keresésre.

- **Fő felhasználói interakciók**:
  - Filmek típusa szerinti kiválasztás
  - Filmek részletes megjelenítése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `useTicketStore`
  - `ref`, `computed`, `onMounted` (Vue)
  - `useMovieStore`
  - `useScreeningStore`
  - `useRouter`
  - `BaseLayout`
  - `BaseSpinner`
  - `BaseCard`
  - `storage`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**                     |
| --------------- | --------------------------------------------- |
| `<h1>`          | Aktuális filmkínálat címe                     |
| `<button>`      | Filmkategóriák kiválasztására szolgáló gombok |
| `<div>`         | Filmek megjelenítésére szolgáló rács          |
| `<BaseCard>`    | Film részleteinek megjelenítése               |
| `<BaseSpinner>` | Betöltési animáció                            |

## **4. Logika és interakciók**
- **Script setup tartalom**: A filmek és vetítések betöltése, szűrőfeltételek kezelése.
- **Eseménykezelés**: Kiválasztott filmek megjelenítése a gombokra kattintva.
- **Reaktív adatok**: `selectedGenre`, `screenings`, `movies`, `isLoading`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                           |
| ------------------ | ------------------------------------------------------- |
| **Színek**         | Rózsaszín (gombok, címek), szürke háttér                |
| **Betűtípus**      | Nincs specifikálva                                      |
| **Reszponzivitás** | Mobilbarát elrendezés                                   |
| **Effektek**       | Hover állapotok a gombokon és animációk a filmkártyákon |

## **Komponens tartalmi összefoglalója**
A komponens célja, hogy a felhasználók áttekintést kapjanak az aktuális filmkínálatról, és lehetőséget biztosítanak filmek szűrésére a kívánt műfajok szerint.