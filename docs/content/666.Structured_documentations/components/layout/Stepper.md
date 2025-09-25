#  **Stepper *(léptető)* komponens dokumentációja**

## 1. Komponens áttekintése
- **Célja és funkciója**: A komponens lépésenkénti navigációt biztosít, amely különböző fázisokat képvisel egy folyamatban.

- **Fő felhasználói interakciók**:
  - Lépések közötti navigálás
  - Aktuális lépés kijelölése

## 2. Külső függőségek
- **Importok, csomagok**: *Nincs*
- **Betűtípusok, CDN-ek**: Font Awesome CDN

## 3. Strukturális elemek
**Táblázat minden HTML/Vue elemről:**

| **Elem** | **Funkció, stílusjegyek**                 |
| -------- | ----------------------------------------- |
| `<div>`  | Fő konténer, középre igazítja a tartalmat |
| `<span>` | Lépésjelzés, megjeleníti a lépés címét    |
| `<i>`    | Ikon, a lépések vizuális reprezentációja  |

## 4. Logika és interakciók
- **Script setup tartalom**:
  - A `currentStep` prop fogadása, amely meghatározza az aktuális lépést.
  - `steps` tömb a lépések nevével.
- **Eseménykezelés**: *Nincs*
- **Reaktív adatok**: `currentStep`, `steps`

## 5. Stílus összefoglaló
**Táblázat:**

| **Kategória**      | **Részletek**                                    |
| ------------------ | ------------------------------------------------ |
| **Színek**         | `bg-pink-700`, `bg-pink-300`, `border-slate-100` |
| **Reszponzivitás** | Flexbox alapú elrendezés                         |
| **Effektek**       | Áttűnési hatások a körök színváltozásaival       |

## **Tartalmi összefoglaló**
A komponens célja, hogy vizuálisan bemutassa a lépések előrehaladását egy folyamatban, lehetővé téve a felhasználó számára a lépések közötti navigálást és az aktuális lépés kiemelését.
