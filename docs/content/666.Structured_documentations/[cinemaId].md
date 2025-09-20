# **CinemaId komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens mozi vetítési adatokat jelenít meg egy adott drive-in-mozi *(autósmozi)* filmjeiről, reagálva a felhasználói interakciókra és a szűrési lehetőségekre.
- 
- **Fő felhasználói interakciók**:
  - Mozihelyszínek közötti navigáció
  - Vetítési időpontok megtekintése
  - Szűrés a megjelenítési időpontok alapján

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `@stores/ScreeningStore.mjs`
  - `vue-router`
  - `@layouts/BaseLayout.vue`
  - `@components/BaseCard.vue`
  - `@components/layout/BaseSpinner.vue`
- **Betűtípusok, CDN-ek**:
  - Google Fonts

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**                          | **Funkció, stílusjegyek**                                          |
| --------------------------------- | ------------------------------------------------------------------ |
| `<BaseLayout>`                    | Alap dizájn keret biztosítása.                                     |
| `<BaseSpinner>`                   | Betöltési animáció megjelenítése.                                  |
| `v-if="loading"`                  | A betöltési állapot megjelenítése.                                 |
| `v-else-if="error"`               | Hibajelzés megjelenítése, ha adatlekérés sikertelen.               |
| `v-for="day in screeningsByDate"` | Vetítési időpontok napokra csoportosítva való iteráció.            |
| `<BaseCard>`                      | Filmek részletes megjelenítése, beleértve a posztert és a leírást. |

## **4. Logika és interakciók**
- **Script setup tartalom**: Vue 3 composition API használata a funkcionális logika implementálására.
- **Eseménykezelés**: `loadScreenings` aszinkron függvény a vetítési adatok betöltésére API hívással.
- **Reaktív adatok**: `screenings`, `loading`, és `error` állapotok vezérlik a komponens viselkedését.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                                                 |
| ------------------ | --------------------------------------------------------------------------------------------- |
| **Színek**         | Minden elem színei a mozi tematika szerint lettek megválasztva: pl. rózsaszín, piros, szürke. |
| **Betűtípus**      | Betűtípusok: 'Cookie', 'Noto Sans', 'Noto Serif'.                                             |
| **Reszponzivitás** | A kütyűk elrendezése a képernyő szélességétől függően változik.                               |
| **Effektek**       | Animált átmenetek a kártyákon; betöltés jelző animáció használata.                            |

## **A komponenst tartalmi összefoglalója**
A komponens célja, hogy **megjelenítse** a **kiválasztott mozi** aktuális **vetítési időpontjait és filmjeit**. Az adatok dinamikusan frissülnek a felhasználói választásoknak megfelelően, válaszként a route változásaira.
