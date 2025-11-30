# ControlT2

ControlT2 es una aplicación orientada al **control sanitario**, enfocada en la gestión de médicos, pacientes, pruebas, informes y usuarios del sistema.
El diseño del proyecto combina un entorno visual tranquilo,inspirado en la estética sanitaria mediante tonos azul claro con una estructura funcional simple, intuitiva y centrada en la eficacia.



## 🧩 Funcionalidades principales

### **👩‍⚕️ Gestión de Médicos**

* Alta de médicos con creación simultánea de usuario.
* Modificación de datos personales (nombre, apellidos, login).
* Consultas de médicos activos.
* Baja o desactivación de cuentas.

### **🧑‍⚕️ Gestión de Pacientes**

* Listado completo de pacientes.
* Edición de datos personales (NHC, nombre, apellidos, edad, sexo, teléfono, etc.).
* Recuperación de información para mostrar en formularios o vistas específicas.

### **🧪 Pruebas y Modalidades**

* Creación de nuevas pruebas diagnósticas.
* Creación de nuevas modalidades.
* Visualización de todas las pruebas y modalidades disponibles.

### **📄 Informes Médicos**

* Consulta de informes.
* Obtención de informes válidos por ID.
* Validación / desvalidación de informes.

### **🔐 Usuarios del Sistema**

* Login de usuarios.
* Alta de usuarios tipo “Sanitario”.
* Control de cuentas activas/inactivas.



## 🛠️ Tecnologías utilizadas

* **PHP** (Programación backend)
* **MySQL** (Base de datos)
* **HTML / CSS / JS** (Interfaz y navegación)
* **Tailwind CSS** (Modales, botones y maquetación)



## 📁 Estructura destacada del proyecto

* `class.db.php` → Conexión a la base de datos.
* `admin.php` → Clase principal encargada de todas las operaciones de CRUD y lógica relacionada con usuarios, médicos, pacientes, informes, modalidades y pruebas.
* Archivos de interfaz → Formularios, tablas, modales y navegación principal.



## 🚀 Objetivo del Proyecto

ControlT2 nace con la intención de aportar una herramienta **clara, organizada y fácil de usar** en el ámbito sanitario, manteniendo una estética tranquila y profesional.

La idea es facilitar el acceso y gestión de información clínica en un entorno intuitivo que simplifique el trabajo diario del personal sanitario.

