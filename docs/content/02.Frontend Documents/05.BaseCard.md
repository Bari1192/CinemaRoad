# **BaseCard *(Kártya)* komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens megjelenít egy kártya szerkezetet, amely információkat tartalmaz egy adott elemről *(a felhasználási felület / területtől függően)*, továbbá információkat szolgáltathat filmek korhatáráról, leírásáról és címéről.

- **Fő felhasználói interakciók**:
  - Kép megtekintése.
  - Korhatár ikonok bemutatása.
  - Leírás, részletek megjelenítése.
  - Interakciós *(cselekvési)* gomb megnyomásának ösztönzése.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `ZeroPlus`, `FourPlus`, `SixPlus`, `TwelvePlus`, `SixteenPlus`, `EighteenPlus` SVG ikonok.
- **Betűtípusok, CDN-ek**: Nincs.

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**                                         |
| --------------- | ----------------------------------------------------------------- |
| `<div>`         | Kártya kerete, háttere és árnyéka.                                |
| `<img>`         | Az elem képe, különböző méretosztályokban.                        |
| `span`          | Korhatár és típus megjelenítése, feltételesen.                    |
| `<h3>`          | Cím, amely tartalmazza a kártya címét.                            |
| `<p>`           | Leírás megjelenítése, amely tartalmazza a kártya szövegét.        |
| `<router-link>` | Navigálás a megadott linkre.                                      |
| `<button>`      | Cselekvési gomb, amely lehetővé teszi a felhasználói interakciót. |

## **4. Logika és interakciók**

- **Script setup tartalom**: A `defineProps` segítségével definiált propok, mint például `title`, `type`, `src`, `description` stb.

- **Eseménykezelés**: A gomb megnyomásával indított navigáció a `router-link` segítségével.

- **Reaktív adatok**: A `computed` tulajdonság a város nevének megjelenítésére szolgál.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                   |
| ------------------ | --------------------------------------------------------------- |
| **Színek**         | Szürke árnyalatok (#1d1f21, #3e3e3e) és rózsaszín (#e91e63).    |
| **Betűtípus**      | Alapértelmezett rendszer betűtípus.                             |
| **Reszponzivitás** | Különböző méretekhez igazodó osztályok a képekhez és gombokhoz. |
| **Effektek**       | Átmenetek, árnyékok és átkapcsolások.                           |

## **Tartalmi összefoglaló**
A komponens célja, hogy egy vizuális kártyaelem formájában kínáljon modern megjelenést, amely tartalmazza / *tartalmazhatja* az adott elem **információit**, például **címét**, **képét**, **leírását**, **korhatárát**, **ikonokat** és egy **cselekvési gombot**, lehetővé téve a felhasználó számára az interakciót.
