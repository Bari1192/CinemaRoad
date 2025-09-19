# Migration names & differences

## Fullstack szerkezeti átalakítása
| <l>Original URL</l>           | ⠀ ⠀ ⠀ ⠀ ⠀ 󠀠󠀠<o>❯❯❯❯</o>⠀ ⠀ ⠀ ⠀ ⠀ |      <ac>New URL site</ac>      |
| :---------------------------- | :----------------------------: | :---------------------------: |
| <do>backend.vm1.test</do>     |          <o>❯❯❯❯</o>           |   <w>backend.cinemaroad</w>   |
| <do>frontend.vm1.test</do>    |          <o>❯❯❯❯</o>           |  <w>frontend.cinemaroad</w>   |
| <do>pma.vm1.test</do>         |          <o>❯❯❯❯</o>           |     <w>pma.cinemaroad</w>     |
| <do>mailcatcher.vm1.test</do> |          <o>❯❯❯❯</o>           | <w>mailcatcher.cinemaroad</w> |
| <do>docs.vm1.test</do>        |          <o>❯❯❯❯</o>           |    <w>docs.cinemaroad</w>     |
| <do>api.vm1.test</do>         |          <o>❯❯❯❯</o>           |     <w>api.cinemaroad</w>     |
| <do>jsonserver.vm1.test</do>  |          <o>❯❯❯❯</o>           | <w>jsonserver.cinemaroad</w>  |
| <do>swagger.vm1.test</do>     |          <o>❯❯❯❯</o>           |   <w>swagger.cinemaroad</w>   |

## Fejlesztői - lokális környezet beállítása (*localgép - NEM Virtual Machine!*)

### Frissítsd a saját /etc/hosts vagy fejlesztői DNS-be:
- 127.0.0.1 backend.cinemaroad
- 127.0.0.1 frontend.cinemaroad stb.
*Ha több fejlesztői gép van vagy Docker DNS-t használtok, ott is érdemes egységesíteni.*

```
# Added by Docker Desktop
192.168.1.6 host.docker.internal
192.168.1.6 gateway.docker.internal
# To allow the same kube context to work on the host and the container:
127.0.0.1 kubernetes.docker.internal

# End of section
127.0.0.1   vm1.test api.vm1.test frontend.vm1.test backend.vm1.test pma.vm1.test docs.vm1.test swagger.vm1.test jsonserver.vm1.test mailcatcher.vm1.test
127.0.0.1   vm2.test api.vm2.test frontend.vm2.test backend.vm2.test pma.vm2.test docs.vm2.test swagger.vm2.test jsonserver.vm2.test mailcatcher.vm2.test
127.0.0.1   vm3.test api.vm3.test frontend.vm3.test backend.vm3.test pma.vm3.test docs.vm3.test swagger.vm3.test jsonserver.vm3.test mailcatcher.vm3.test
127.0.0.1   vm4.test api.vm4.test frontend.vm4.test backend.vm4.test pma.vm4.test docs.vm4.test swagger.vm4.test jsonserver.vm4.test mailcatcher.vm4.test
127.0.0.1   vm5.test api.vm5.test frontend.vm5.test backend.vm5.test pma.vm5.test docs.vm5.test swagger.vm5.test jsonserver.vm5.test mailcatcher.vm5.test

```
## Az alábbi sorokkal lett kiegészítve, ezáltal elérhetővé téve a fullstack projekt:



| <wx>Service</wx>       | <wx>Host</wx>            | <wx>dev</wx>                 | <wx>stage</wx>                 |
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


### <wx><l> Copy & Save</l></wx>
#### <wx><u> Base</u></wx>
> 127.0.0.1   cinemaroad backend.cinemaroad frontend.cinemaroad api.cinemaroad docs.cinemaroad pma.cinemaroad swagger.cinemaroad jsonserver.cinemaroad mailcatcher.cinemaroad

#### <wx><ac> <u>Dev</u></ac></wx>
> 127.0.0.1   cinemaroad.dev backend.dev.cinemaroad frontend.dev.cinemaroad api.dev.cinemaroad docs.dev.cinemaroad pma.dev.cinemaroad swagger.dev.cinemaroad jsonserver.dev.cinemaroad mailcatcher.dev.cinemaroad

#### <wx> <o><u> Stage</u></o></wx>
> 127.0.0.1   cinemaroad.stage backend.stage.cinemaroad frontend.stage.cinemaroad api.stage.cinemaroad docs.stage.cinemaroad pma.stage.cinemaroad swagger.stage.cinemaroad jsonserver.stage.cinemaroad mailcatcher.stage.cinemaroad

<span style="background-color:red;font-size:20px;"><ac>**Save as Administrator!**</ac></span>

<style>
o { color: Skyblue }
l {color:lightgreen}
ac {color:cyan}
w {color:white; font-weight:bold}
wx {color:white; font-weight:bold; font-size:20px}
do {color:gainsboro; font-weight:500}
 
</style>



