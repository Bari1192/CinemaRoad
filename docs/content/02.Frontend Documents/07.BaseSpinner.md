#  **BaseSpinner (betöltési) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens az oldal betöltésének jelzésére fókuszál, miközben az adatok töltődnek.

- **Fő felhasználói interakciók**:
  - Nincs közvetlen felhasználói interakció, ifnormációs jelleggel szolgál a felhasználó felé.

## **2. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem** | **Funkció, stílusjegyek**                                                    |
| -------- | ---------------------------------------------------------------------------- |
| `<div>`  | A fő tartály, amely a betöltési jelet tartalmazza.                           |
| `<svg>`  | SVG formátumú animált ikon, amely a betöltés állapotát jelzi.                |
| `<path>` | A SVG ikon formájának meghatározása.                                         |
| `<span>` | Kisegítő szöveg a képernyőolvasók számára, amely a betöltés állapotát jelzi. |

## **3. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                 |
| ------------------ | ------------------------------------------------------------- |
| **Színek**         | Szürke és rózsaszín árnyalatok a színezéshez.                 |
| **Betűtípus**      | Nincs meghatározva.                                           |
| **Reszponzivitás** | A spinner automatikusan alkalmazkodik a szülő elem méretéhez. |
| **Effektek**       | Animált forgatás a betöltési jelzéshez.                       |

## **Tartalmi összefoglaló**
A komponens célja, hogy vizuálisan jelezze a felhasználónak a betöltés folyamatát, amíg az adatok töltődnek.
