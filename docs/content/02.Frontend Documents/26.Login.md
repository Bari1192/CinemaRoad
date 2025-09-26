# **Admin/Moderátor Bejelentkezési Panel (login) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetővé teszi az adminisztrátorok és moderátorok számára, hogy bejelentkezzenek a CinemaRoad rendszerébe.
- **Fő felhasználói interakciók**:
  - E-mail cím megadása
  - Jelszó megadása
  - Bejelentkezés gomb megnyomása
  - Regisztrációs link követése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `FormKit`
  - `useUserStore`
  - `useRouter`
  - `storage`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**       | **Funkció, stílusjegyek**                |
| -------------- | ---------------------------------------- |
| `<BaseLayout>` | Az oldal vázát biztosítja                |
| `<h1>`         | Bejelentkezési cím                       |
| `<FormKit>`    | Űrlap a bejelentkezési adatok megadására |
| `<RouterLink>` | Link a regisztrációs oldalra             |
| `<button>`     | Bejelentkezés gomb                       |

## **4. Logika és interakciók**
- **Script setup tartalom**: A felhasználói adatok kezelése és a bejelentkezés logikája.
- **Eseménykezelés**: A bejelentkezés eseményének kezelése.
- **Reaktív adatok**: `email`, `password`, `errorMessage`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                               |
| ------------------ | ------------------------------------------- |
| **Színek**         | Rózsaszín (címszöveg), szürke háttér        |
| **Betűtípus**      | Nincs specifikálva                          |
| **Reszponzivitás** | Mobilbarát elrendezés                       |
| **Effektek**       | Átmenetek a gombokon és háttér homályosítás |

## **Komponens tartalmi összefoglalója**
A komponens célja, hogy lehetőséget biztosítson az **adminisztrátoroknak** és **moderátoroknak** a rendszerbe való **bejelentkezésre**, lehetővé téve számukra az **autentikációs szolgáltatásokhoz** való hozzáféréshez.