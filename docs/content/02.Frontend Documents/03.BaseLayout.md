# **BaseLayout *(oldal szerkezetkialakítási)* komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens egy alapértelmezett elrendezést biztosít a weboldal számára, amely tartalmazza a **fejlécet**, fő **tartalmi blokkrészt** és a **láblécet**.

- **Fő felhasználói interakciók**:
  - A tartalom megtekintése.
  - Navigálás a fejlécen keresztül.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseHeader` komponens a fejléchez.
  - `BaseFooter` komponens a lábléchez.

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**         | **Funkció, stílusjegyek**              |
| ---------------- | -------------------------------------- |
| `<BaseHeader />` | Fejléc, navigációs menü megjelenítése. |
| `<main>`         | Főtartalom konténer, középre igazítva. |
| `<slot />`       | Dinamikus tartalom behelyezése.        |
| `<BaseFooter />` | Lábléc, szerzői jogi információkkal.   |

## **4. Logika és interakciók**
- **Script setup tartalom**:
  - Az importok kezelése a komponens elején.

## **Tartalmi összefoglaló**
A komponens alapértelmezett elrendezést biztosít, amely magában foglalja a fejlécet, a fő tartalmat és a láblécet, lehetővé téve a felhasználók számára a navigálást és tartalom megtekintését.
