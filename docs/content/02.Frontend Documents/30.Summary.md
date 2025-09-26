# **Foglalást/Vásárlást Összegző (Summary) Komponens Dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetővé teszi a felhasználók számára, hogy áttekintsék a foglalásukat vagy vásárlásukat, mielőtt véglegesítik azokat. Lehetőséget biztosít a jegy foglalás,- vagy vásárlásra a regisztrált felhasználóknak. Továbbá a vendégek számára a vásárlás összegzésére, részleteit foglalja össze.

- **Fő felhasználói interakciók**:
  - Foglalás vagy vásárlás megerősítése
  - Email cím megadása (vendégek számára)
  - Jegyek és helyszínek áttekintése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `Stepper`
  - `BaseSpinner`
  - `useTicketStore`
  - `useUserStore`
  - `AgeLimitBadge`
  - `ToastService`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**             |
| --------------- | ------------------------------------- |
| `<BaseLayout>`  | Az oldal vázát biztosítja             |
| `<BaseSpinner>` | Betöltési animáció                    |
| `<Stepper>`     | A lépéseket mutatja                   |
| `<h1>`          | Cím a foglalás/vásárlás összegzéshez  |
| `<div>`         | Jegyek és parkolóhelyek megjelenítése |

## **4. Logika és interakciók**
- **Script setup tartalom**: A foglalások és vásárlások várható adatait tartalmazza.
- **Eseménykezelés**: Foglalás vagy vásárlás megerősítése eseményei.
- **Reaktív adatok**: `locationName`, `movieTitle`, `guestEmail`, `bookingtType`, `formattedTime`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                      |
| ------------------ | ---------------------------------- |
| **Színek**         | Rózsaszín és szürke háttér         |
| **Betűtípus**      | Nincs specifikálva                 |
| **Reszponzivitás** | Mobilbarát elrendezés              |
| **Effektek**       | Átmenetek és animációk a jegyeknél |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy lehetőséget biztosítson a felhasználók számára, hogy áttekintsék a folyamatban lévő foglalásukat / vásárlásukat, mielőtt véglegesítik, megerősítik.