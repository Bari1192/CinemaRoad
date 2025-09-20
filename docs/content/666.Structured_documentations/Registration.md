# **Registration komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens a vendégek regisztrációját szolgálja, lehetővé téve az adatainak megadását és további funkciókhoz való hozzáférés biztosítása, mint például a jegyfoglalás.

- **Fő felhasználói interakciók**:
  - Teljes név megadása
  - E-mail cím megadása
  - Telefonszám megadása
  - Jelszó megadása
  - Jelszó megerősítése
  - Regisztráció gomb megnyomása

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `FormKit`
  - `useUserStore`
  - `useRouter`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**       | **Funkció, stílusjegyek**               |
| -------------- | --------------------------------------- |
| `<BaseLayout>` | Az oldal vázát biztosítja               |
| `<h1>`         | Regisztrációs cím                       |
| `<FormKit>`    | Űrlap a regisztrációs adatok megadására |
| `<button>`     | Regisztráció gomb                       |

## **4. Logika és interakciók**
- **Script setup tartalom**: A felhasználói adatok kezelése és a regisztráció logikája.
- **Eseménykezelés**: A regisztráció eseményének kezelése.
- **Reaktív adatok**: `email`, `password`, `form`, `errorMessage`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                  |
| ------------------ | ---------------------------------------------- |
| **Színek**         | Rózsaszín (címszöveg), szürke háttér           |
| **Betűtípus**      | Nincs specifikálva                             |
| **Reszponzivitás** | Mobilbarát elrendezés                          |
| **Effektek**       | Átmenetek a gombokon és a háttér homályosítása |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy a vendégek számára lehetőséget biztosítson személyes adataik megadására, így segítve őket a regisztrációs folyamat során. Későbbi interakciókhoz, további funkciók elérhetővé tételét szolgálja.