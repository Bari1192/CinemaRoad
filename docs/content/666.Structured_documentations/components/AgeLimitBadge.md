# **AgeLimitBadge (korhatárbesorolást jelző) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens célja, hogy megfelelő ikont jelenítsen meg az életkorbesorolás alapján.

- **Fő felhasználói interakciók**:
  - Életkor megadása
  - Ikon stílusának testreszabása

## **2. Külső függőségek**
- **Importok, csomagok *(SVG-k)***:
  - `ZeroPlus`
  - `FourPlus`
  - `SixPlus`
  - `TwelvePlus`
  - `SixteenPlus`
  - `EighteenPlus`

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**      | **Funkció, stílusjegyek**                                                                          |
| ------------- | -------------------------------------------------------------------------------------------------- |
| `<component>` | Dinamikusan megjeleníti az életkorbesoroláshozhoz tartozó ikont, alapértelmezett osztály: `klassz` |

## **4. Logika és interakciók**
- **Script setup tartalom**: Tartalmazza az ajánlott életkor szerinti ikon kiválasztásának logikáját.
- **Eseménykezelés**: Nincs direkt eseménykezelés.
- **Reaktív adatok**:
  - `age`: Korbesorolás, amelyet a filmhez előre meghatároztak.
  - `klassz`: A CSS osztály a stílushoz.

## **Tartalmi összefoglaló**
A komponens célja, hogy különböző korcsoportokhoz tartozó ikont jelenítsen meg a felhasználó megadott életkora alapján.
