<footer class="bg-[#1C2518] text-slate-300 mt-16 border-t border-[#2C3E20]">
  <!-- Top benefits bar -->
  <div class="border-b border-[#2C3E20] py-8 bg-[#141C11]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-6 text-center md:text-left">
      <div class="flex items-center gap-4 justify-center md:justify-start">
        <div class="w-12 h-12 rounded-full bg-[#74A626]/15 text-[#86C62C] flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-book-bookmark"></i>
        </div>
        <div>
          <h4 class="font-bold text-white text-sm">Fondo Editorial Exclusivo</h4>
          <p class="text-xs text-slate-400">Tratados, códigos comentados y doctrina</p>
        </div>
      </div>
      <div class="flex items-center gap-4 justify-center md:justify-start">
        <div class="w-12 h-12 rounded-full bg-[#74A626]/15 text-[#86C62C] flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-truck-fast"></i>
        </div>
        <div>
          <h4 class="font-bold text-white text-sm">Envíos Rápidos y Seguros</h4>
          <p class="text-xs text-slate-400">Directo a su estudio, despacho o domicilio</p>
        </div>
      </div>
      <div class="flex items-center gap-4 justify-center md:justify-start">
        <div class="w-12 h-12 rounded-full bg-[#74A626]/15 text-[#86C62C] flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-credit-card"></i>
        </div>
        <div>
          <h4 class="font-bold text-white text-sm">Pagos 100% Seguros</h4>
          <p class="text-xs text-slate-400">Tarjetas, transferencias y pasarelas online</p>
        </div>
      </div>
      <div class="flex items-center gap-4 justify-center md:justify-start">
        <div class="w-12 h-12 rounded-full bg-[#74A626]/15 text-[#86C62C] flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-headset"></i>
        </div>
        <div>
          <h4 class="font-bold text-white text-sm">Asesoría Bibliográfica</h4>
          <p class="text-xs text-slate-400">Atención especializada para juristas</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Footer Content -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Col 1: Brand & About -->
      <div>
        <div class="flex items-center gap-2.5 mb-4">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logos/logo-white.svg" 
                 alt="<?php bloginfo('name'); ?>" 
                 class="h-10 w-auto" />
          </a>
        </div>
        <p class="text-xs text-slate-400 leading-relaxed mb-4">
          Editorial y librería especializada en literatura jurídica de alto nivel para abogados, magistrados, fiscales y comunidad académica.
        </p>
        <div class="flex items-center space-x-3 text-slate-400">
          <a href="#" class="w-8 h-8 rounded-full bg-[#24311F] flex items-center justify-center hover:text-[#86C62C] hover:bg-[#2F4028] transition-colors"><i class="fa-brands fa-facebook-f text-xs"></i></a>
          <a href="#" class="w-8 h-8 rounded-full bg-[#24311F] flex items-center justify-center hover:text-[#86C62C] hover:bg-[#2F4028] transition-colors"><i class="fa-brands fa-instagram text-xs"></i></a>
          <a href="#" class="w-8 h-8 rounded-full bg-[#24311F] flex items-center justify-center hover:text-[#86C62C] hover:bg-[#2F4028] transition-colors"><i class="fa-brands fa-linkedin-in text-xs"></i></a>
          <a href="https://wa.me/51999999999" class="w-8 h-8 rounded-full bg-[#24311F] flex items-center justify-center hover:text-[#86C62C] hover:bg-[#2F4028] transition-colors"><i class="fa-brands fa-whatsapp text-xs"></i></a>
        </div>
      </div>

      <!-- Col 2: Legal Categories -->
      <div>
        <h4 class="font-serif font-bold text-white text-sm mb-4 border-b border-[#2C3E20] pb-2">Ramas del Derecho</h4>
        <ul class="space-y-2 text-xs text-slate-400">
          <li><a href="<?php echo esc_url(home_url('/categoria-producto/derecho-penal')); ?>" class="hover:text-[#86C62C] transition-colors">Derecho Penal y Criminología</a></li>
          <li><a href="<?php echo esc_url(home_url('/categoria-producto/derecho-civil')); ?>" class="hover:text-[#86C62C] transition-colors">Derecho Civil y Contratos</a></li>
          <li><a href="<?php echo esc_url(home_url('/categoria-producto/derecho-procesal')); ?>" class="hover:text-[#86C62C] transition-colors">Derecho Procesal y Litigación</a></li>
          <li><a href="<?php echo esc_url(home_url('/categoria-producto/derecho-constitucional')); ?>" class="hover:text-[#86C62C] transition-colors">Derecho Constitucional y DD.HH.</a></li>
          <li><a href="<?php echo esc_url(home_url('/categoria-producto/derecho-administrativo')); ?>" class="hover:text-[#86C62C] transition-colors">Derecho Administrativo y Gestión</a></li>
          <li><a href="<?php echo esc_url(home_url('/categoria-producto/derecho-laboral')); ?>" class="hover:text-[#86C62C] transition-colors">Derecho Laboral y Seguridad Social</a></li>
        </ul>
      </div>

      <!-- Col 3: Customer Service & Links -->
      <div>
        <h4 class="font-serif font-bold text-white text-sm mb-4 border-b border-[#2C3E20] pb-2">Servicio al Cliente</h4>
        <ul class="space-y-2 text-xs text-slate-400">
          <li><a href="<?php echo esc_url(home_url('/seguimiento-de-pedidos')); ?>" class="hover:text-[#86C62C] transition-colors">Seguimiento de Pedidos</a></li>
          <li><a href="<?php echo esc_url(home_url('/formas-de-pago')); ?>" class="hover:text-[#86C62C] transition-colors">Formas de Pago y Facturación</a></li>
          <li><a href="<?php echo esc_url(home_url('/politicas-de-envio')); ?>" class="hover:text-[#86C62C] transition-colors">Políticas de Envío y Entrega</a></li>
          <li><a href="<?php echo esc_url(home_url('/terminos-y-condiciones')); ?>" class="hover:text-[#86C62C] transition-colors">Términos y Condiciones</a></li>
          <li><a href="<?php echo esc_url(home_url('/aviso-de-privacidad')); ?>" class="hover:text-[#86C62C] transition-colors">Aviso de Privacidad</a></li>
        </ul>
      </div>

      <!-- Col 4: Contact info & Corporate Sales -->
      <div>
        <h4 class="font-serif font-bold text-white text-sm mb-4 border-b border-[#2C3E20] pb-2">Atención a Clientes</h4>
        <p class="text-xs text-slate-400 mb-3">
          ¿Representa a un despacho jurídico, universidad o institución? Solicite cotizaciones corporativas y pedidos especiales.
        </p>
        <ul class="space-y-2 text-xs text-slate-400">
          <li class="flex items-center gap-2"><i class="fa-solid fa-envelope text-[#86C62C]"></i> ventas@limaeditores.com</li>
          <li class="flex items-center gap-2"><i class="fa-solid fa-truck-fast text-[#86C62C]"></i> Envíos a todo el país</li>
          <li class="flex items-center gap-2"><i class="fa-solid fa-clock text-[#86C62C]"></i> Lun - Vie: 9:00 AM a 6:00 PM</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="border-t border-[#2C3E20] py-4 bg-[#0D130B] text-slate-500 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-2">
      <p>&copy; <?php echo date('Y'); ?> Lima Editores. Todos los derechos reservados.</p>
      <p class="flex items-center gap-2">
        <span>Desarrollado con WordPress & WooCommerce</span>
      </p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
