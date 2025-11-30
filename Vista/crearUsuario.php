
  <style>
    .form-container{max-width:480px;margin:2rem auto;padding:1.25rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff}
    .field{margin-bottom:0.75rem}
    label{display:block;margin-bottom:0.25rem;font-weight:600}
    input{width:100%;padding:0.5rem;border:1px solid #cbd5e1;border-radius:6px}
    button{display:inline-block;padding:0.6rem 1rem;background:#2563eb;color:#fff;border:none;border-radius:6px;cursor:pointer}
  </style>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative" style="background-image: url('./Recursos/img/login.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
  
  <!-- Filtro oscuro -->
  <div class="absolute inset-0 bg-black opacity-60"></div>
  
  <main class="relative z-20 flex items-center justify-center min-h-screen">
    
    

     
      
  
    <div class="form-container bg-url('./Recursos/img/login.jpg') relative z-20 m-auto p-8 rounded shadow-lg w-full max-w-md">
      
      <h2 style="text-2xl text-blue font-bold text-center">Crear usuario</h2>

      <form action="index.php?action=crearUsuario" method="post" autocomplete="off" novalidate>
        <div class="field">
          <label for="login">Login</label>
          <input id="login" name="login" type="text" required maxlength="100" placeholder="login">
        </div>
        <div class="field">
          <label for="password">Contraseña</label>
          <input id="password" name="password" type="password" required minlength="6" placeholder="Mínimo 6 caracteres">
        </div>
        <div class="field">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" type="text" required pattern="[A-Za-z0-9\-]{4,20}" maxlength="20" placeholder="Nombre">
        </div>
        <div class="field">
          <label for="apellidos">Apellidos</label>
          <input id="apellidos" name="apellidos" type="text" required maxlength="150" placeholder="apellidos">
        </div>
        <div class="field">
          <label for="edad">edad</label>
          <input id="edad" name="edad" type="edad" required minlength="6" placeholder="Poner edad">
        </div>
        

        <div class="field">
          <label for="sexo">sexo</label>
          
          <select id="selectPrueba" class="w-full border rounded px-3 py-2" id="sexo" name="sexo" required>
            <option value="">-- Sexo --</option>
             <option value="">Masculino</option>
             <option value="">Femenino</option>
           
          </select>
        </div>
        <div class="field">
          <label for="telefono">telefono</label>
          <input id="telefono" name="telefono" type="number" required minlength="6" placeholder="Mínimo 6 caracteres">
        </div>
        <div class="field">
          <label for="fechaNacimiento">Fecha Nacimiento</label>
          <input id="fechaNacimiento" name="fechaNacimiento" type="date" required minlength="6" placeholder="Mínimo 6 caracteres">
        </div>
        <a href="#login.php" method="post" >
          <div style="margin-top:0.75rem">
            <button type="submit" class="w-full text-white font-semibold py-2 rounded transition duration-200"
                style="background-color: #1964ab;" 
                onmouseover="this.style.backgroundColor='#0d3a7d'"
                onmouseout="this.style.backgroundColor='#1964ab'" action="index.php?action=CrearUsuario">Crear usuario</button>
          </div>
        </a>
        
        
      </form>
    </div>
  </main>

  