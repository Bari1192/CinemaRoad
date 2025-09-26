# **PremierWeek komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens a premier filmek listáját jeleníti meg, beleértve a vetítési időt és a filminformációkat. Az aktuális premier időpontját is számolja a jelenlegi és a bemutató nap, idő különbözetével.
- 
- **Fő felhasználói interakciók**:
  - Premer Filmek részleteinek megtekintése
  - A premier mozijegy vásárlását ösztönző gombok.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout` az alapszerkezethez.
  - `AgeLimitBadge` a mozifilm életkor besorolásához kötött figyelmeztető jelzéshez.
  - `PremierWeekTimer` a premier bemutató időzítője, visszaszámlálója.
  - `BaseSpinner` a betöltési animációhoz - lassabb internet elérés mellett.
  - `useScreeningStore` az állapotkezelésekhez
  - `storage` a filmposzterek URL-jeinek eléréséhez
- **Betűtípusok, CDN-ek**:
  - Google Fonts CDN különböző betűtípusokhoz

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**             | **Funkció, stílusjegyek**                                                      |
| -------------------- | ------------------------------------------------------------------------------ |
| `<BaseLayout>`       | Tartalmazza az alapszerkezetet.                                                |
| `<PremierWeekTimer>` | Megjeleníti a következő premier időpontját, óráját, visszaszámláló funkcióval. |
| `<BaseSpinner>`      | Megjeleníti a betöltési animációt, ha a tartalom még nem elérhető.             |
| `<AgeLimitBadge>`    | Megjeleníti a film korhatár besorolását.                                       |
| `<router-link>`      | Navigál a választott film részleteihez.                                        |
| `<img>`              | Megjeleníti a film poszterét.                                                  |

## **4. Logika és interakciók**
- **Script setup tartalom**: Scripten belüli változók és computed tulajdonságok határozzák meg a filmek betöltését és megjelenítését.
- **Eseménykezelés**: Nincs külön eseménykezelő; a filmek linkjei direkt navigációt biztosítanak.
- **Reaktív adatok**: `loading`, `films`, és `premierScreeningTime` reaktív változók.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                             |
| ------------------ | ------------------------------------------------------------------------- |
| **Színek**         | Szövegek: fehér, rózsaszín, sárga, kék árnyalatok.                        |
| **Betűtípus**      | Különböző betűtípusok a Google Fontsból.                                  |
| **Reszponzivitás** | Flexbox layout, változó oszlopszélességek a különböző képernyőméretekhez. |
| **Effektek**       | Árnyékok és áttetszőségek a vizuális hatás érdekében.                     |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy **bemutassa** az aktuális premier filmeket, azok részletes **adataival**, beleértve a vetítési időt és a **vásárlási lehetőséget**. A felhasználók könnyen navigálhatnak a kiválasztott filmhez, miközben n**yomon követhetik a premier időpontját** is.
