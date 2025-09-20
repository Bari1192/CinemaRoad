# **DataEdit (adatmódosító) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens célja, hogy a **felhasználók módosíthassák** a saját **adataikat**, mint például az email cím és telefonszám. Mindezeken felül a jelszó frissítésére is lehetőségük van.

- **Fő felhasználói interakciók**:
  - Email cím módosítása.
  - Telefonszám módosítása.
  - Jelszó megadása és megerősítése.
  - Módosítások mentése.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `@layouts/BaseLayout.vue`
  - `@stores/UserStore.js`
- **Betűtípusok, CDN-ek**: Nincs.

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**       | **Funkció, stílusjegyek**                                   |
| -------------- | ----------------------------------------------------------- |
| `<BaseLayout>` | Alap elrendezés, belső tartalom megjelenítésére szolgál.    |
| `<h1>`         | Cím, nagyobb betűméret, középre igazítva, kiemelt szín.     |
| `<FormKit>`    | űrlapelem, email, telefon és jelszó mezőkkel, eseményekkel. |
| `<button>`     | Kattintható gomb, a módosítások mentésére, kiemelt szín.    |

## **4. Logika és interakciók**
- **Script setup tartalom**: A Vue 3 setup API használatával reaktív változók definiálása és a felhasználói adatok betöltése.
- **Eseménykezelés**: A `submitForm` függvény meghívása a form elküldésekor, adatok frissítése a `userStore` segítségével.
- **Reaktív adatok**: `form`, amely a felhasználói adatokat (email, telefon, jelszó) tárolja.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                    |
| ------------------ | ------------------------------------------------ |
| **Színek**         | Sötét háttér szürke és rózsaszín árnyalatokkal.  |
| **Betűtípus**      | Kiemelt, nagyobb betűméret, megfelelő kontraszt. |
| **Reszponzivitás** | Flexibilis stílus, max szélesség használata.     |
| **Effektek**       | Árnyékok és kerekített sarkok kiemelése.         |

## **A komponens tartalmi összefoglalója**
Az komponens célja, hogy lehetővé tegye a felhasználók számára a saját adataik, mint az email és telefonszám, frissítését, valamint a jelszó megadását és megerősítését, biztosítva a felhasználói élményt és az adatbiztonságot.
