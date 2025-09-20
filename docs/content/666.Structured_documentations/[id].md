# **id.vue Komponens dokumentációja:**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A filmek részletes megjelenítése, beleértve a vetítési időpontok kiválasztását.
- **Fő felhasználói interakciók**:
  - Film kiválasztása
  - Vetítési időpont megadása
  - Visszalépés a főoldalra

## **2. Külső függőségek**
- **Importok, csomagok**:
  - BaseLayout
  - useMovieStore, useScreeningStore, useTicketStore
  - BaseSpinner
  - Calendar
  - router
  - storage
  - ToastService
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**                          |
| --------------- | -------------------------------------------------- |
| `<BaseLayout>`  | Alap elrendezés, a tartalom köré van ágyazva.      |
| `<BaseSpinner>` | Betöltési animáció megjelenítése.                  |
| `<RouterLink>`  | Link a főoldalra visszalépéshez.                   |
| `<Calendar>`    | Vetítések megjelenítése és kiválasztási lehetőség. |
| `<img>`         | Film plakátjának megjelenítése.                    |
| `<div>`         | Film adatainak és leírásának formázása.            |

## **4. Logika és interakciók**
- **Script setup tartalom**:
  - Fejlesztői logika a komponens inicializálásához, filmek és vetítések betöltéséhez.
- **Eseménykezelés**:
  - Vetítési időpont választása és navigálás a következő oldalra.
- **Reaktív adatok**:
  - loading, movieId, movie, screenings, selectedScreening, enrichedScreenings.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                                        |
| ------------------ | ------------------------------------------------------------------------------------ |
| **Színek**         | Fekete-fehér, rózsaszín és borostyán színek használata a kiemelésekhez.              |
| **Betűtípus**      | Különféle betűméretek a címekhez és leírásokhoz.                                     |
| **Reszponzivitás** | Flexbox és grid használata a strukturáltság érdekében, különböző képernyőméretekhez. |
| **Effektek**       | Árnyeékek és keretek a képek és elemek körül.                                        |

## **Komponens tartalmi összefoglalója**
- A komponens célja a filmek részletes bemutatása, beleértve a vetítési időpontokat, a film leírását, és a felhasználók számára lehetőséget biztosít a film kiválasztására.
