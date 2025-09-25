# **LocationNameDetails komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A `LocationNameDetails` komponens egy autósmozi helyszínét és a hozzá tartozó filmeket mutatja be. A felhasználók láthatják a mozihelyszín nevét, lokációját és a vetítések tartalmi részleteit.
  
- **Fő felhasználói interakciók**:
  - Mozi(helyszín) kiválasztása
  - Filmek adatainak megtekintése
  - Navigálás az adott film saját aloldalára

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `useDriveInCinemaStore` a mozi információkhoz
  - `useMovieStore` a filmes adatok kezeléséhez
  - `BaseSpinner` a betöltési állapot megjelenítéséhez
  - `BaseCard` a filmek megjelenítéséhez
  - `onMounted`, `ref`, `computed` a Vue komponens logikájához
  - `useRoute`, `useRouter` a routing kezeléséhez
  - `http` a szerverrel való kommunikációhoz
  - `storage` a statikus fájlok kezeléséhez
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**              | **Funkció, stílusjegyek**                                  |
| --------------------- | ---------------------------------------------------------- |
| `<div v-if="cinema">` | A mozi adatok megjelenítése, ha van kiválasztott mozi.     |
| `<img>`               | A mozi képének megjelenítése.                              |
| `<h1>`                | A mozi neve, fő címsor.                                    |
| `<h2>`                | A mozi helye, másodlagos címsor.                           |
| `<p>`                 | A mozi leírása, szöveges tartalom.                         |
| `<div v-else>`        | Betöltési animáció megjelenítése, ha a mozi nem érhető el. |
| `<BaseCard>`          | Filmek adatait mutató kártyák.                             |

## **4. Logika és interakciók**
- **Script setup tartalom**: Importálások és reaktív adatok definiálása.
- **Eseménykezelés**: Navigáció a film oldalára a `navigateToMovieSite` függvénnyel, ami a filmes adatok slugify-elt címét használja.
- **Reaktív adatok**:
  - `cinema`: a kiválasztott mozi.
  - `screenings`: a mozihoz tartozó vetítések listája.
  - `movies`: összes film adata.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                                                                                           |
| ------------------ | --------------------------------------------------------------------------------------------------------------------------------------- |
| **Színek**         | `text-pink-600` a szövegekhez, `text-gray-900` az akciófilmekhez, `text-yellow-700` családi filmekhez, `text-red-900` horror filmekhez. |
| **Betűtípus**      | Nincs                                                                                                                                   |
| **Reszponzivitás** | Flexbox elrendezés a kompakt nézéshez, responsive képek.                                                                                |
| **Effektek**       | Nincs                                                                                                                                   |

## **A komponens tartalmi összefoglalója**
A `LocationNameDetails` komponens a kiválasztott mozi adatait és a hozzá tartozó **filmeket jeleníti meg**, lehetővé téve a felhasználók számára a **részletes információk** elérését és a **filmek közötti navigálást**.
