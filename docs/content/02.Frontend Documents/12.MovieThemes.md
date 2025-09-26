#  **MovieThemes (Filmkategóriák) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens filmes ajánlót jelenít meg, kategóriák szerint, mint például ***családi***, ***akció*** és ***horror filmek***.

- **Fő felhasználói interakciók**:
  - Filmek képeire kattintás a részletekhez navigálva.
  - Hibás képek kezelése.

## **2. Külső függőségek**

- **Importok, csomagok**:
  - Vue, Vue Router, MovieStore, AgeLimitBadge, HTTP utility
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**          | **Funkció, stílusjegyek**                                        |
| ----------------- | ---------------------------------------------------------------- |
| `<div>`           | Filmek kategóriáit és tartalmát csomagolja, stílusos keretekkel. |
| `<h2>`            | Kategóriák címe, hazaszerető nagybetűs megjelenítéssel.          |
| `<div>`           | Filmek fókuszált elrendezése, reszponzív rácsban.                |
| `<img>`           | Filmplakátok megjelenítése, képhibák kezelésével.                |
| `<AgeLimitBadge>` | Korhatár jelzés megjelenítése.                                   |
| `<span>`          | Filmt címének stílusos megjelenítése.                            |

## **4. Logika és interakciók**
- **Script setup tartalom**:
  - Komponens inicializálás és filmek lekérdezése a megadott kirendelésből.
- **Eseménykezelés**:
  - Kattintás esemény a filmek címére, hogy átirányítson a film részleteihez.
  - Képbetöltési hibák kezelése.
- **Reaktív adatok**:
  - `movies` - filmes adatokat tároló reaktív változó.
  - `familyMovies`, `actionMovies`, `horrorMovies` - kiszűrt filmek kategóriákra bontva.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                            |
| ------------------ | -------------------------------------------------------- |
| **Színek**         | Sötét háttér, hangsúlyos színek kategóriánként.          |
| **Betűtípus**      | Nagybetűs stílus, világos színek a címekhez.             |
| **Reszponzivitás** | Reszponzív elrendezés rácsokkal és görgethető elemekkel. |
| **Effektek**       | Hover hatások a filmkártyákon, árnyékolások.             |

## **Tartalmi összefoglaló**
A komponens arra szolgál, hogy kategorizált filmes ajánlókat jelenítsen meg, lehetőséget biztosítva a felhasználóknak, hogy a választott filmek részleteihez navigáljanak.
