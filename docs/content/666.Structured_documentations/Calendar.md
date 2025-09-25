# **Calendar komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens vetítési időpontokat jelenít meg a hét adott mozifilm / mozihelyszín vetítései alapján függően a felhasználás helyszínétől. Lehetőséget biztosít a felhasználóknak, hogy kiválasszák a vetítési időpontot, egy beépített naptár segítségével.

- **Fő felhasználói interakciók**:
  - Vetítési időpontok kiválasztása
  - Napok közötti navigáció
  - Vetítések információinak megjelenítése

## **2. Külső függőségek**
- **Importok, csomagok**: `ref`, `computed` (Vue), `useNow` (@vueuse/core)
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**   | **Funkció, stílusjegyek**                                                      |
| ---------- | ------------------------------------------------------------------------------ |
| `<table>`  | Az időpontokat tartalmazó táblázat, reszponzív megjelenítés a nagy képernyőkön |
| `<thead>`  | A hét napjait mutatja                                                          |
| `<tbody>`  | Az egyes vetítések és dátumok információit kezeli                              |
| `<button>` | Kiválasztható vetítés, különböző színstílusok az állapottól függően            |
| `<div>`    | Információs mezők a dátum és idő megjelenítésére                               |

## **4. Logika és interakciók**
- **Script setup tartalom**: A komponens a Vue komponenst használja a megjelenítéshez, a kívánt reaktív adatokkal.
- **Eseménykezelés**: Kiválaszható vetítési időpontok gombnyomásra eseményekkel.
- **Reaktív adatok**: `screenings`, `selectedScreeningId`, `openedDayKey`, `daysOfWeek` stb.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                 |
| ------------------ | --------------------------------------------- |
| **Színek**         | Szürke, fehér és rózsaszín (hátterek, gombok) |
| **Betűtípus**      | Nincs specifikálva a kódban                   |
| **Reszponzivitás** | Mobilbarát megjelenés a kisebb képernyőkön    |
| **Effektek**       | Hover állapot színek váltása                  |

## **A komponens tartalmi összefoglalója**
A komponens célja vetítési időpontok megjelenítése a felhasználók számára, lehetőséget biztosítva a kiválasztásra és az információk megtekintésére a hét egyes napjai szerint.
