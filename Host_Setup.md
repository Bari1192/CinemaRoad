# Projekt URL elérés - lokális környezet - beállítása

## Host fájl frissítése:
1. Nyissa meg a **Fájlkezelőt** *(windows környezetben)* a tálcán található mappa ikonra kattintva. 

2. Kattintson a lokációs cím beírásához a megjelenő ablak tetejénél lévő 🏠︎ ikon melletti címsávba.

3. **Illeszd be a következőt:**
   ```
   C:\Windows\System32\drivers\etc 
   ```
    
    > Amennyiben jól illeszti be, az alábbi útvonalra kerül:
    ![Wiring Diagram](/resources/hosts_file_path_windows.png)

4. Válassza ki jobb kattintással a *hosts* fájlt. Nyissa meg a NotePad-dal adminisztrációs joggal.

5.  Hozzon létre egy új sort a fájl alján az Enter billentyű megnyomásával.

6. Az új sorba illessze be a lentiekben található címeket, egymás alá bemásolva, új sorokban.

- 127.0.0.1   cinemaroad backend.cinemaroad frontend.cinemaroad api.cinemaroad docs.cinemaroad pma.cinemaroad swagger.cinemaroad jsonserver.cinemaroad mailcatcher.cinemaroad

- 127.0.0.1   cinemaroad.dev backend.dev.cinemaroad frontend.dev.cinemaroad api.dev.cinemaroad docs.dev.cinemaroad pma.dev.cinemaroad swagger.dev.cinemaroad jsonserver.dev.cinemaroad mailcatcher.dev.cinemaroad

- 127.0.0.1   cinemaroad.stage backend.stage.cinemaroad frontend.stage.cinemaroad api.stage.cinemaroad docs.stage.cinemaroad pma.stage.cinemaroad swagger.stage.cinemaroad jsonserver.stage.cinemaroad mailcatcher.stage.cinemaroad

7. Amennyiben a fentieket követi, az **alábbi kialakítás jön létre**:
    ![Wiring Diagram](/resources/hosts_url_settings.png)

8. Adminisztrátori joggal mentse az elkészült fájlt és zárja be!

## A korábbi lépéseknek köszönhetően a projekt szerves részei az alábbi útvonalakon válik elérhetővé:

| <wx>Szolgáltatás</wx>       | <wx> Fő útvonal </wx>            | <wx>Fejlesztői környezet</wx>                 | <wx>Állapotfejlesztések</wx>                 |
| ---------------------- | :----------------------- | ---------------------------- | ------------------------------ |
| <w>Cinema Road App</w> | `cinemaroad`             | `dev.cinemaroad`             | `stage.cinemaroad`             |
| <w>Backend</w>         | `backend.cinemaroad`     | `backend.dev.cinemaroad`     | `backend.stage.cinemaroad`     |
| <w>Frontend</w>        | `frontend.cinemaroad`    | `frontend.dev.cinemaroad`    | `frontend.stage.cinemaroad`    |
| <w>API</w>             | `api.cinemaroad`         | `api.dev.cinemaroad`         | `api.stage.cinemaroad`         |
| <w>Docs</w>            | `docs.cinemaroad`        | `docs.dev.cinemaroad`        | `docs.stage.cinemaroad`        |
| <w>PMA</w>             | `pma.cinemaroad`         | `pma.dev.cinemaroad`         | `pma.stage.cinemaroad`         |
| <w>Swagger</w>         | `swagger.cinemaroad`     | `swagger.dev.cinemaroad`     | `swagger.stage.cinemaroad`     |
| <w>Jsonserver</w>      | `jsonserver.cinemaroad`  | `jsonserver.dev.cinemaroad`  | `jsonserver.stage.cinemaroad`  |
| <w>Mailcatcher</w>     | `mailcatcher.cinemaroad` | `mailcatcher.dev.cinemaroad` | `mailcatcher.stage.cinemaroad` |

### URL beállítás egységei

*A projekt megfelelően stabil működési hátteréhez elengedhetetlenül szükséges a `Fő projekt` elérésének beállítása a `hosts` fájlban. A további környezeti beállítások létrehozásának elhagyása *(dev és stage host-ok hozzáadása)* nem okozza a rendszer instabilitását.*

#### <wx><u>Fő projekt *(product)*</u></wx>
> 127.0.0.1   cinemaroad backend.cinemaroad frontend.cinemaroad api.cinemaroad docs.cinemaroad pma.cinemaroad swagger.cinemaroad jsonserver.cinemaroad mailcatcher.cinemaroad

#### <wx><ac> <u>Dev</u></ac></wx>
> 127.0.0.1   cinemaroad.dev backend.dev.cinemaroad frontend.dev.cinemaroad api.dev.cinemaroad docs.dev.cinemaroad pma.dev.cinemaroad swagger.dev.cinemaroad jsonserver.dev.cinemaroad mailcatcher.dev.cinemaroad

#### <wx> <o><u> Stage</u></o></wx>
> 127.0.0.1   cinemaroad.stage backend.stage.cinemaroad frontend.stage.cinemaroad api.stage.cinemaroad docs.stage.cinemaroad pma.stage.cinemaroad swagger.stage.cinemaroad jsonserver.stage.cinemaroad mailcatcher.stage.cinemaroad

A projekt további beállításaihoz, információihoz kérem olvassa át a [Rövid dokumentációs összefoglalót](/README.md)


<style>
o { color: Skyblue }
l {color:lightgreen}
ac {color:cyan}
w {color:white; font-weight:bold}
wx {color:white; font-weight:bold; font-size:20px}
do {color:gainsboro; font-weight:500}
 
</style>



