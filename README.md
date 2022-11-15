## Arbol de Vistas
    
```
    Views
    │
    └───auth
    │   │   login.blade.php
    │   
    └───support-modules
    │   
    └───teacher-modules
    │   
    └───admin-modules
    │   
    └───layout
    │   │   │
    │   └───partials
```

### Auth
Vistas referidas a modulos de 
### Support, Admin, Teacher Modules
Vistas referidas a los modulos de Admin, Support y Teacher respectivamente
### Layouts
Cualquier layout reutilizable de algun volumen amplio
#### Partials
Aqui va cualquier componente reutilizable, como por ejemplo las alertas

## Datos de acceso para pruebas

>Para todos los usuarios la contraseña es ***password***

|      Role      |            Email             |
|:--------------:|:----------------------------:|
| Administrador  |  **joelgut1998@outlook.es**  |
|    Profesor    | **profesorjoel@correo.com**  |
|    Soporte     |  **soportejoel@correo.com**  |

## Rutas Agrupadas

>Para reducir las lineas y el volumen de codigo es importante agrupar las rutas que repiten parametros

1. ### Agrupación por Middleware
    Cuando tenemos distintas rutas que manejan el mismo middleware podemos agruparlas para evitar replicar la misma sintaxis en cada ruta
    > #### Ejemplo de sintaxis sin agrupador
    ![https://i.imgur.com/MVZjvuX.png](https://i.imgur.com/MVZjvuX.png)
    >    #### Ejemplo de sintaxis con agrupador
    ![https://i.imgur.com/k0XUmXd.png](https://i.imgur.com/k0XUmXd.png)

2. ### Agrupación por Prefijo de URL
    Es normal colocar las url como **/users/edit** o **/users/create** donde la palabra ***/users*** en las url se repite
    podemos agrupar por prefijo de url para evitar constantes repeticiones de palabras en las rutas
    
    > #### Ejemplo de sintaxis sin agrupador
    ![https://i.imgur.com/NfZ9Uq1.png](https://i.imgur.com/NfZ9Uq1.png)
    > #### Ejemplo de sintaxis con agrupador
    ![https://i.imgur.com/WUaLxQ1.png](https://i.imgur.com/WUaLxQ1.png)
3. ### Agrupación por Prefijo de nombre de ruta
    Como observamos los nombres de rutas tambien cuentan con parametros que pueden repetirse, donde podemos agrupar por prefijo de ruta
    en el caso de usuarios tenemos ***usuarios.create*** ***usuarios.update*** ***usuarios.delete*** donde la palabra ***usuarios*** se repite en todas
    aquí usamos el agrupador por nombre de ruta.
    > #### Ejemplo de sintaxis sin agrupador
    ![https://i.imgur.com/gcILH6m.png](https://i.imgur.com/gcILH6m.png)
    > #### Ejemplo de sintaxis con agrupador
    ![https://i.imgur.com/O2akNSs.png](https://i.imgur.com/O2akNSs.png)

    > En este ejemplo en especifico pudimos reducir y ordenar el codigo a esta forma,la cual es mas legible y comprensible ademas de corta no ostiga a la vista y es mas facil de leer una vez que se comprende, evita que los archivos de rutas crescan en dimensiones exageradas y con ayuda de rutas resource estas rutas se pueden reducir a 7 lineas de codigo
    > > ***ES IMPORTANTE TOMAR EN CUENTA QUE ESTAS RUTAS PUEDE QUE NO SIRVAN O NO SEAN REALISTAS, UNICAMENTE FUERON USADAS PARA USO PRACTICO CON FINES VISUALES*** 
