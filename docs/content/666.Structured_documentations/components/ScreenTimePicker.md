# **ScreenTimePicker (Vetítési időpont kiválasztó) komponens dokumentációja**

## **1. Komponens áttekintése**

- **Célja és funkciója**: A ScreenTimePicker komponens a mozifilm(ek)hez tartozó vetítési időpont kiválasztását segíti *- annak részleteit jeleníti meg -*, a rendelkezésre álló vetítési időpontokat vizuális formában nyújtja a felhasználónak.

- **Fő felhasználói interakciók**:
  - Vetítési időpontok kiválasztása

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `@stores/ScreeningStore.mjs`
  - `@stores/TicketStore`
  - `@stores/DriveInCinemaStore`
  - `@stores/MovieStore.mjs`
  - `@utils/http.mjs`
  - SVG ikonok importálása
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**                                | **Funkció, stílusjegyek**                       |
| --------------------------------------- | ----------------------------------------------- |
| `<div class="bg-slate-800 rounded-lg">` | Fő tároló, sötét háttér, lekerekített sarkok    |
| `<img>`                                 | Film plakátjának megjelenítése, objektum fedése |
| `<h1>`                                  | Film címe, kattintható link                     |
| `<component>`                           | Korhatár ikon megjelenítése                     |
| `<span>`                                | Premier státusz megjelenítése                   |
| `<h2>`                                  | Film típusa, színes kör keretezéssel            |
| `<button>`                              | Kattintható elem vetítési időpontok számára     |

## **4. Logika és interakciók**
- **Script setup tartalom**:
  - Komponens logika inicializálása, reaktív állapotok beállítása
- **Eseménykezelés**:
  - Vetítési időpontok kiválasztása
- **Reaktív adatok**:
  - `onlyFourScreenings`: Csak a kiválasztott vetítési időpontok

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                         |
| ------------------ | ----------------------------------------------------- |
| **Színek**         | Sötét háttér, rózsaszín kiemelés, sárga Premier címke |
| **Betűtípus**      | Nincs megadva                                         |
| **Reszponzivitás** | Mobil és desktop nézetek, különböző gombok            |
| **Effektek**       | Hover hatások gombokon                                |

## **Tartalmi összefoglaló**
A komponens célja a mozifilmhez tartozó vetítési időpontok megjelenítése, amely lehetővé teszi a felhasználók számára, hogy kiválasszák az őket érdeklő vetítést - a helyszín(ek) függvényében.
