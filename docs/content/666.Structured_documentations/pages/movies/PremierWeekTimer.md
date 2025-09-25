# **PremierWeekTimer komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens egy premier esemény visszaszámlálója, amely megjeleníti a következő premier dátumát és időpontját *magyarországon használt* formátumban.

- **Fő felhasználói interakciók**:
  - Visszaszámláló megtekintése
  - Dátumot megjelenítő szekció
  - Gomb a premier filmek gyors elérhetőségéhez

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseSpinner` a betöltési állapot kezelésére
  - Vue reaktív funkciók (`ref`, `computed`, `onMounted`, `onUnmounted`)
- **Betűtípusok, CDN-ek**:
  - Google Fonts betűtípusok

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**                                                    |
| --------------- | ---------------------------------------------------------------------------- |
| `<section>`     | A fő tartalom tárolása, feltételesen jelenik meg a betöltés befejezése után. |
| `<div>`         | Csúszkáló háttér és a szöveges tartalom konténerként.                        |
| `<h1>`          | Fő cím a premier hét címével, animált háttérrel.                             |
| `<button>`      | Gomb a premier filmek szekcióra való ugráshoz.                               |
| `<BaseSpinner>` | Betöltési állapot megjelenítése, ha az adat még nem elérhető.                |

## **4. Logika és interakciók**
- **Script setup tartalom**: A feltételesen megjelenített komponenst vezérli, beleértve a premier időpontjának kiszámítását és a visszaszámláló logikáját.
- **Eseménykezelés**: Egy gomb (`scrollToPremierFilms`) a premier filmek szekcióra való görgetéshez.
- **Reaktív adatok**:
  - `nowMs`: Aktuális időtartam milliszekundumban.
  - `remaining`: Visszaszámláló adatok (napok, órák, percek, másodpercek).

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                     |
| ------------------ | ----------------------------------------------------------------- |
| **Színek**         | Színes háttér, éles és élénk színek a címekhez és gombokhoz.      |
| **Betűtípus**      | Betűtípusok: *Onest*, *Noto Sans* a modern megjelenéshez.         |
| **Reszponzivitás** | Flexbox használata a mobilbarát elrendezéshez.                    |
| **Effektek**       | Animációk a címek és gombok fürkészéhez, visszaszámláló animáció. |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy megjelenítse a következő premier esemény időpontját a felhasználók számára, valamint egy visszaszámlálót, amely segít nyomon követni az időt a premierig, biztosítva a felhasználói interakciókat, mint például a premier filmekhez való gördülést. A komponens **része** (szülő komponense) **a PremierWeek komponensnek**.
