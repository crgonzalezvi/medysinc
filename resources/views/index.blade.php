<!DOCTYPE html>
<!--
Template Name: Trealop
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Copyright: OS-Templates.com
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<head>
  <title>MediSync</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  {{-- <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all"> --}}
  <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
  <style>
    /* Estilos para el menú responsive */
    #mainav {
      position: relative;
    }
    /* Botón de menú (hamburguesa) */
    #menu-toggle {
      display: none;
      cursor: pointer;
      font-size: 1.5em;
      padding: 10px;
    }
    /* Por defecto, el menú se muestra en línea */
    #mainav ul {
      display: flex;
      list-style: none;
    }
    #mainav ul li a {
      text-decoration: none;
      color: inherit; /* El color se hereda del contenedor */
    }
    @media (max-width: 768px) {
      /* Muestra el botón de menú en dispositivos pequeños */
      #menu-toggle {
        display: block;
      }
      /* Oculta el menú inicialmente y lo posiciona */
      #mainav ul {
        flex-direction: column;
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        width: 200px;
        z-index: 1000;
        background-color: #333; /* Fondo para que se vea en pantallas pequeñas */
      }
      /* Estilos para los elementos del menú en mobile */
      #mainav ul li {
        width: 100%;
        text-align: left;
        border-bottom: 1px solid #444;
      }
      #mainav ul li a {
        color: #fff; /* Texto blanco para contrastar con el fondo */
        display: block;
        padding: 10px;
      }
      /* Clase para mostrar el menú al activar el toggle */
      #mainav ul.show {
        display: flex;
      }
    }
  </style>
</head>
<body id="top">
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row0">
    <div id="topbar" class="hoc clear">
      <div class="fl_left">
        <!-- ################################################################################################ -->
        <ul class="nospace">
          <li><i class="fas fa-phone rgtspace-5"></i> +57 321 5808512</li>
          <li><i class="far fa-envelope rgtspace-5"></i>crgonzalezvi@unal.edu.co</li>
          <li><i class="far fa-envelope rgtspace-5"></i>angalvezc@unal.edu.co</li>
        </ul>
        <!-- ################################################################################################ -->
      </div>
      <div class="fl_right">
        <!-- ################################################################################################ -->
        <ul class="nospace">
          <li><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
          {{-- <li><a href="#" title="Help Centre"><i class="far fa-life-ring"></i></a></li> --}}
          <li><a href="{{ route('login') }}" title="Login"><i class="fas fa-sign-in-alt"></i></a></li>
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout">
              <i class="fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          {{-- <li><a href="#" title="Sign Up"><i class="fas fa-edit"></i></a></li> --}}
          {{-- <li id="searchform"> ... código comentado ... </li> --}}
        </ul>
        <!-- ################################################################################################ -->
      </div>
    </div>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear">
      <div id="logo" class="fl_left">
        <!-- ################################################################################################ -->
        <h1><a href="{{ url('/') }}">MEDYSINC</a></h1>
        <!-- ################################################################################################ -->
      </div>
      <nav id="mainav" class="fl_right">
        <!-- Botón para menú responsive -->
        <div id="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
        <!-- Menú principal -->
        <ul class="clear" id="menu-list">
          
          <li><a href="{{ route('admin.dashboard') }}">Administradores</a></li>
          <li><a href="{{ route('appointments.index') }}">Doctores</a></li>
          <li><a href="{{ route('login') }}">Pacientes</a></li>
         
        </ul>
      </nav>
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper bgded overlay gradient" style="background-image:url('../images/inteligencia-artificial-salud-hero.jpg');">
    <div id="pageintro" class="hoc clear">
      <!-- ################################################################################################ -->
      <article>
        <p>¡Bienvenidos a MediSync!</p>
        <h3 class="heading">🌟 Donde tu salud es nuestra prioridad. 🌟</h3>
        <p>🔹 Profesionales de confianza: Contamos con un equipo médico altamente capacitado para atenderte.</p>
        <p>🔹 Atención integral: Soluciones rápidas y efectivas para cuidar de tu bienestar y el de tu familia.</p>
        <footer>
          <ul class="nospace inline pushright">
            <li><a class="btn" href="">📞 Contáctanos:</a></li>
            <li><a class="btn inverse" href="#">📍 Ubícanos en</a></li>
          </ul>
        </footer>
      </article>
      <!-- ################################################################################################ -->
    </div>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row2">
    <section class="hoc container clear">
      <div class="sectiontitle">
        <h6 class="heading">Medysinc - Soluciones Médicas Innovadoras</h6>
        <p>Software avanzado para la gestión de clínicas y hospitales</p>
      </div>
      <ul class="nospace group prices">
        <li class="one_third">
          <article><i class="fas fa-user-md red"></i>
            <h6 class="heading">Gestión de Pacientes</h6>
            <p>Administra historiales médicos, citas y tratamientos en una plataforma segura y eficiente.</p>
            <footer><a class="btn" href="{{ route('login') }}">Más Información</a></footer>
          </article>
        </li>
        <li class="one_third">
          <article><i class="fas fa-hospital green"></i>
            <h6 class="heading">Contol de Especialidades y Personal</h6>
            <p>Administra cada una de las Especialidades del hospital y lleva un control detallado del personal</p>
            <footer><a class="btn" href="{{ route('login') }}">Más Información</a></footer>
          </article>
        </li>
        <li class="one_third">
          <article><i class="fas fa-file-medical blue"></i>
            <h6 class="heading">Historia Clínica Electrónica</h6>
            <p>Accede y actualiza expedientes médicos con total seguridad y en cumplimiento con normativas.</p>
            <footer><a class="btn" href="{{ route('login') }}">Más Información</a></footer>
          </article>
        </li>
      </ul>
    </section>
  </div>
  <div class="wrapper coloured">
    <article class="hoc cta clear">
      <h6 class="three_quarter first">Optimiza la gestión médica con Medysinc</h6>
      <footer class="one_quarter"><a class="btn" href="{{ route('login') }}">Solicitar Demostración</a></footer>
    </article>
  </div>
  <div class="wrapper row3">
    <main class="hoc container clear">
      <section id="introblocks">
        <div class="sectiontitle">
          <h6 class="heading">Características Principales</h6>
          <p>Medysinc facilita la gestión médica con herramientas avanzadas</p>
        </div>
        <ul class="nospace group">
          <li class="one_third first">
            <article><a href="{{ route('login') }}"><i class="fas fa-calendar-check"></i></a>
              <h6 class="heading">Agenda Médica</h6>
              <p>Programa y gestiona citas con recordatorios automatizados.</p>
              <footer><a class="btn" href="{{ route('login') }}">Leer Más</a></footer>
            </article>
          </li>
          <li class="one_third">
            <article><a href="#"><i class="fa-solid fa-lock"></i></a>
              <h6 class="heading">Seguridad y Cumplimiento</h6>
              <p>Cumple con las normativas de privacidad y seguridad de datos.</p>
              <footer><a class="btn" href="{{ route('login') }}">Leer Más</a></footer>
            </article>
          </li>
          <li class="one_third">
            <article><a href="#"><i class="fas fa-chart-line"></i></a>
              <h6 class="heading">Análisis e Informes</h6>
              <p>Genera reportes detallados sobre el rendimiento y la atención médica.</p>
              <footer><a class="btn" href="{{ route('login') }}">Leer Más</a></footer>
            </article>
          </li>
        </ul>
      </section>
      <div class="clear"></div>
    </main>
  </div>
  <div class="wrapper row4">
    <footer id="footer" class="hoc clear">
      <div class="one_quarter first">
        <h6 class="heading">Sobre Medysinc</h6>
        <p>Medysinc es un software diseñado para optimizar la gestión de clínicas y hospitales.</p>
      </div>
      <div class="one_quarter">
        <h6 class="heading">Contacto</h6>
        <p><i class="fas fa-phone"></i> <a href="tel:+573215808512">321 580 8512</a></p>
        <p><i class="fas fa-phone"></i> <a href="tel:+573022937537">302 293 7537</a></p>
        <p><i class="fas fa-envelope"></i> <a href="mailto:crgonzalezvi@unal.edu.co">crgonzalezvi@unal.edu.co</a></p>
      </div>
      <div class="one_half">
        <h6 class="heading">Desarrollado por</h6>
        <p>Cristian Camilo González Villa - Andrés Felipe Gálvez Carmona</p>
        <p>Universidad Nacional de Colombia - Sede Manizales</p>
      </div>
    </footer>
    
    
  </div>

  <script>
    function toggleMenu() {
      var menu = document.getElementById('menu-list');
      menu.classList.toggle('show');
    }
  </script>
</body>
</html>
