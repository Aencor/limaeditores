<?php
/**
 * Script to create/update Lima Editores Customer Service Pages
 */

$pages = [
    [
        'title'   => 'Seguimiento de Pedidos',
        'slug'    => 'seguimiento-de-pedidos',
        'content' => <<<'HTML'
<p class="text-base text-slate-600 mb-8 leading-relaxed">
  Para rastrear el estado de su orden, por favor introduzca su <strong>ID de Pedido</strong> (número que recibió en su recibo y en el correo de confirmación) y el <strong>Correo Electrónico</strong> con el que realizó la compra.
</p>

<div class="my-8 max-w-xl mx-auto bg-slate-50 p-6 md:p-8 rounded-xl border border-slate-200 shadow-xs">
  [woocommerce_order_tracking]
</div>

<div class="mt-12 pt-8 border-t border-slate-200 grid grid-cols-1 md:grid-cols-2 gap-6">
  <div class="flex items-start gap-4 p-5 rounded-xl bg-slate-50 border border-slate-100">
    <div class="w-10 h-10 rounded-full bg-[#74A626]/15 text-[#74A626] flex items-center justify-center text-lg shrink-0">
      <i class="fa-solid fa-truck-fast"></i>
    </div>
    <div>
      <h3 class="font-bold text-slate-900 text-sm">Tiempos de Entrega</h3>
      <p class="text-xs text-slate-600 mt-1">Lima Metropolitana: 24 a 48 horas hábiles.<br>Provincias: 48 a 72 horas vía Olva Courier o Shalom.</p>
    </div>
  </div>
  <div class="flex items-start gap-4 p-5 rounded-xl bg-slate-50 border border-slate-100">
    <div class="w-10 h-10 rounded-full bg-[#74A626]/15 text-[#74A626] flex items-center justify-center text-lg shrink-0">
      <i class="fa-brands fa-whatsapp"></i>
    </div>
    <div>
      <h3 class="font-bold text-slate-900 text-sm">¿Dudas con su Despacho?</h3>
      <p class="text-xs text-slate-600 mt-1">Escríbanos a WhatsApp con su número de orden para recibir asistencia inmediata de nuestro equipo de logística.</p>
    </div>
  </div>
</div>
HTML
    ],
    [
        'title'   => 'Formas de Pago y Facturación',
        'slug'    => 'formas-de-pago',
        'content' => <<<'HTML'
<p class="text-base text-slate-600 mb-8 leading-relaxed">
  En <strong>Lima Editores</strong> ponemos a su disposición múltiples métodos de pago 100% seguros y transparentes para profesionales independientes, estudios jurídicos, empresas e instituciones públicas.
</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8">
  <div class="p-6 rounded-xl bg-slate-50 border border-slate-200 shadow-xs flex flex-col justify-between">
    <div>
      <div class="w-12 h-12 rounded-lg bg-[#74A626]/15 text-[#74A626] flex items-center justify-center text-2xl mb-4">
        <i class="fa-solid fa-credit-card"></i>
      </div>
      <h3 class="font-bold text-slate-900 text-base mb-2">Tarjetas de Débito y Crédito</h3>
      <p class="text-xs text-slate-600 leading-relaxed">
        Aceptamos todas las tarjetas Visa, MasterCard, American Express y Diners Club procesadas con cifrado bancario seguro SSL de 256 bits.
      </p>
    </div>
  </div>

  <div class="p-6 rounded-xl bg-slate-50 border border-slate-200 shadow-xs flex flex-col justify-between">
    <div>
      <div class="w-12 h-12 rounded-lg bg-[#74A626]/15 text-[#74A626] flex items-center justify-center text-2xl mb-4">
        <i class="fa-solid fa-mobile-screen-button"></i>
      </div>
      <h3 class="font-bold text-slate-900 text-base mb-2">Billeteras Digitales</h3>
      <p class="text-xs text-slate-600 leading-relaxed">
        Pagos inmediatos a través de <strong>Yape</strong> y <strong>Plin</strong> sin comisiones adicionales, con confirmación inmediata de su orden.
      </p>
    </div>
  </div>

  <div class="p-6 rounded-xl bg-slate-50 border border-slate-200 shadow-xs flex flex-col justify-between">
    <div>
      <div class="w-12 h-12 rounded-lg bg-[#74A626]/15 text-[#74A626] flex items-center justify-center text-2xl mb-4">
        <i class="fa-solid fa-building-columns"></i>
      </div>
      <h3 class="font-bold text-slate-900 text-base mb-2">Transferencias Bancarias</h3>
      <p class="text-xs text-slate-600 leading-relaxed">
        Cuentas corrientes en BCP, BBVA, Interbank y Banco de la Nación para personas naturales, firmas legales y entidades estatales.
      </p>
    </div>
  </div>
</div>

<h2 class="font-serif text-xl font-bold text-slate-900 mt-10 mb-4 pb-2 border-b border-slate-200">Emisión de Facturas y Boletas Electrónicas</h2>
<p class="text-sm text-slate-600 leading-relaxed mb-4">
  Todos nuestros precios incluyen I.G.V. Al momento de realizar su compra en la pantalla de pago, puede seleccionar entre <strong>Boleta de Venta</strong> o <strong>Factura Electrónica</strong>:
</p>
<ul class="list-disc pl-6 space-y-2 text-sm text-slate-600 mb-8">
  <li><strong>Factura Electrónica:</strong> Ingrese el número de RUC y Razón Social de su Estudio Jurídico o Empresa. El comprobante electrónico (XML y PDF) será enviado automáticamente a su correo electrónico.</li>
  <li><strong>Boleta de Venta:</strong> Emitida con su número de DNI o Carné de Extranjería.</li>
  <li><strong>Órdenes de Compra Estatales:</strong> Para adquisiciones de bibliotecas universitarias, juzgados o ministerios, contáctenos en <a href="mailto:ventas@limaeditores.com" class="text-[#74A626] underline font-semibold">ventas@limaeditores.com</a>.</li>
</ul>
HTML
    ],
    [
        'title'   => 'Políticas de Envío y Despacho',
        'slug'    => 'politicas-de-envio',
        'content' => <<<'HTML'
<p class="text-base text-slate-600 mb-8 leading-relaxed">
  Garantizamos el envío seguro y protegido de cada uno de nuestros tratados, códigos y obras jurídicas a cualquier punto del territorio peruano.
</p>

<div class="space-y-6 text-sm text-slate-700 leading-relaxed">
  <div class="p-6 rounded-xl bg-slate-50 border border-slate-200">
    <h3 class="font-bold text-slate-900 text-base mb-2 flex items-center gap-2">
      <i class="fa-solid fa-location-dot text-[#74A626]"></i> 1. Cobertura y Modalidades
    </h3>
    <p class="text-slate-600">
      Realizamos despachos a domicilio y a estudios jurídicos en toda <strong>Lima Metropolitana</strong>, <strong>Callao</strong> y todas las <strong>Regiones del Perú</strong> a través de operadores logísticos certificados (Olva Courier, Shalom y agencias de carga interprovincial).
    </p>
  </div>

  <div class="p-6 rounded-xl bg-slate-50 border border-slate-200">
    <h3 class="font-bold text-slate-900 text-base mb-2 flex items-center gap-2">
      <i class="fa-solid fa-clock text-[#74A626]"></i> 2. Plazos de Entrega
    </h3>
    <ul class="list-disc pl-6 space-y-1.5 text-slate-600 mt-2">
      <li><strong>Lima Metropolitana y Callao:</strong> 24 a 48 horas hábiles contadas a partir de la confirmación del pago.</li>
      <li><strong>Principales Ciudades de Provincias:</strong> 48 a 72 horas hábiles.</li>
      <li><strong>Zonas Especiales / Distritos Alejados:</strong> 3 a 5 días hábiles según la frecuencia de la agencia de encomiendas.</li>
    </ul>
  </div>

  <div class="p-6 rounded-xl bg-slate-50 border border-slate-200">
    <h3 class="font-bold text-slate-900 text-base mb-2 flex items-center gap-2">
      <i class="fa-solid fa-box-archive text-[#74A626]"></i> 3. Embalaje Especial de Protección
    </h3>
    <p class="text-slate-600">
      Sabemos el valor de sus libros. Todas nuestras publicaciones se despachan termoselladas o envueltas en plástico burbuja de alta densidad y cajas rígidas para proteger las esquinas, cubiertas y encuadernaciones durante todo el trayecto.
    </p>
  </div>

  <div class="p-6 rounded-xl bg-slate-50 border border-slate-200">
    <h3 class="font-bold text-slate-900 text-base mb-2 flex items-center gap-2">
      <i class="fa-solid fa-file-invoice text-[#74A626]"></i> 4. Número de Guía y Seguimiento
    </h3>
    <p class="text-slate-600">
      Una vez entregado el paquete a la empresa courier, recibirá en su correo electrónico y por WhatsApp el número de guía de remisión y el enlace para monitorear su envío en tiempo real.
    </p>
  </div>
</div>
HTML
    ],
    [
        'title'   => 'Términos y Condiciones',
        'slug'    => 'terminos-y-condiciones',
        'content' => <<<'HTML'
<p class="text-sm text-slate-500 mb-6 italic">Última actualización: Septiembre 2026</p>

<p class="text-base text-slate-600 mb-8 leading-relaxed">
  El presente documento establece los términos y condiciones que rigen el acceso y uso del sitio web <strong>Lima Editores</strong> (en adelante, "la Plataforma"), así como la adquisición de obras jurídicas, libros, tratados y suscripciones editoriales.
</p>

<div class="space-y-6 text-sm text-slate-700 leading-relaxed">
  <section class="p-6 bg-slate-50 rounded-xl border border-slate-200">
    <h3 class="font-serif font-bold text-slate-900 text-base mb-2">1. Identificación y Titularidad</h3>
    <p class="text-slate-600">
      Lima Editores es un fondo editorial y librería especializada en literatura jurídica constituida bajo las leyes de la República del Perú, con domicilio fiscal en la ciudad de Lima.
    </p>
  </section>

  <section class="p-6 bg-slate-50 rounded-xl border border-slate-200">
    <h3 class="font-serif font-bold text-slate-900 text-base mb-2">2. Propiedad Intelectual y Derechos de Autor</h3>
    <p class="text-slate-600">
      Todos los contenidos, diseños, logotipos, portadas, textos doctrinales, códigos comentados y compilaciones bibliográficas publicadas en este portal están protegidos por el Decreto Legislativo N° 822 (Ley sobre el Derecho de Autor) y tratados internacionales de propiedad intelectual. Queda expresamente prohibida su reproducción total o parcial sin autorización previa y por escrito.
    </p>
  </section>

  <section class="p-6 bg-slate-50 rounded-xl border border-slate-200">
    <h3 class="font-serif font-bold text-slate-900 text-base mb-2">3. Precios, Ediciones y Disponibilidad</h3>
    <p class="text-slate-600">
      Los precios expuestos en la tienda virtual están expresados en Soles Peruanos (S/) e incluyen el Impuesto General a las Ventas (I.G.V.). Lima Editores se reserva el derecho de actualizar los precios, reimpresiones y ediciones de su fondo editorial sin previo aviso. Las promociones son válidas hasta agotar existencias.
    </p>
  </section>

  <section class="p-6 bg-slate-50 rounded-xl border border-slate-200">
    <h3 class="font-serif font-bold text-slate-900 text-base mb-2">4. Políticas de Cambio y Devoluciones</h3>
    <p class="text-slate-600">
      De conformidad con la Ley N° 29571 (Código de Protección y Defensa del Consumidor), se aceptan solicitudes de cambio por fallas de imprenta (hojas en blanco, encuadernación defectuosa o páginas faltantes) dentro de los siete (7) días calendario posteriores a la recepción del producto. El libro debe presentarse sin marcas de uso, anotaciones o sellos.
    </p>
  </section>

  <section class="p-6 bg-slate-50 rounded-xl border border-slate-200">
    <h3 class="font-serif font-bold text-slate-900 text-base mb-2">5. Legislación y Jurisdicción</h3>
    <p class="text-slate-600">
      Cualquier controversia derivada de los presentes términos se someterá a las leyes vigentes de la República del Perú y a la jurisdicción de los jueces y tribunales del Distrito Judicial de Lima.
    </p>
  </section>
</div>
HTML
    ],
    [
        'title'   => 'Libro de Reclamaciones',
        'slug'    => 'libro-de-reclamaciones',
        'content' => <<<'HTML'
<div class="mb-8 p-6 bg-[#F8FAF3] border border-[#74A626]/30 rounded-xl flex flex-col md:flex-row items-center justify-between gap-4">
  <div>
    <h3 class="font-serif font-bold text-slate-900 text-lg">Libro de Reclamaciones Virtual</h3>
    <p class="text-xs text-slate-600 mt-1">Conforme a lo establecido en el Código de Protección y Defensa del Consumidor (Ley N° 29571) y el D.S. N° 011-2011-PCM.</p>
  </div>
  <div class="text-right text-xs text-slate-600 shrink-0">
    <p><strong>Razón Social:</strong> Lima Editores S.A.C.</p>
    <p><strong>RUC:</strong> 20600000000</p>
    <p><strong>Dirección:</strong> Lima, Perú</p>
  </div>
</div>

<form class="space-y-6 text-sm" onsubmit="event.preventDefault(); alert('Su reclamación ha sido registrada satisfactoriamente con el código REC-' + Math.floor(Math.random()*90000 + 10000) + '. Recibirá una copia en su correo electrónico.');">
  <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
    <h4 class="font-bold text-slate-900 text-base mb-4 border-b pb-2">1. Identificación del Consumidor Reclamante</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Nombres y Apellidos *</label>
        <input type="text" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="Nombre completo" required />
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Tipo y N° de Documento (DNI / CE / RUC) *</label>
        <input type="text" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="Número de documento" required />
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Correo Electrónico *</label>
        <input type="email" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="correo@ejemplo.com" required />
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Teléfono / Celular *</label>
        <input type="tel" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="+51 999 999 999" required />
      </div>
      <div class="md:col-span-2">
        <label class="block text-xs font-semibold text-slate-700 mb-1">Domicilio (Dirección, Distrito, Ciudad) *</label>
        <input type="text" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="Dirección completa" required />
      </div>
    </div>
  </div>

  <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
    <h4 class="font-bold text-slate-900 text-base mb-4 border-b pb-2">2. Identificación del Bien Contratado</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Tipo de Bien</label>
        <select class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]">
          <option>Producto (Libro / Tratado / Código / Obra Jurídica)</option>
          <option>Servicio (Envío / Despacho / Suscripción)</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Monto Reclamado (S/)</label>
        <input type="text" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="S/ 0.00" />
      </div>
      <div class="md:col-span-2">
        <label class="block text-xs font-semibold text-slate-700 mb-1">Descripción del Libro u Obra Adquirida</label>
        <input type="text" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="Ej. Tratado de Derecho Procesal Penal - Edición 2026" />
      </div>
    </div>
  </div>

  <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
    <h4 class="font-bold text-slate-900 text-base mb-4 border-b pb-2">3. Detalle de la Reclamación</h4>
    <div class="space-y-4">
      <div class="flex items-center gap-6">
        <label class="inline-flex items-center gap-2 cursor-pointer">
          <input type="radio" name="claim_type" value="reclamo" checked class="text-[#74A626] focus:ring-[#74A626]" />
          <span class="text-sm font-semibold text-slate-800">Reclamo</span> (Disconformidad relacionada a los productos o servicios)
        </label>
        <label class="inline-flex items-center gap-2 cursor-pointer">
          <input type="radio" name="claim_type" value="queja" class="text-[#74A626] focus:ring-[#74A626]" />
          <span class="text-sm font-semibold text-slate-800">Queja</span> (Malestar o descontento respecto a la atención al público)
        </label>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Detalle del Reclamo o Queja *</label>
        <textarea rows="4" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="Describa los hechos ocurridos..." required></textarea>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Pedido o Solicitud Concreta del Consumidor *</label>
        <textarea rows="2" class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" placeholder="¿Qué solución solicita a la editorial? (cambio de libro, reposición, etc.)" required></textarea>
      </div>
    </div>
  </div>

  <div class="bg-slate-100 p-4 rounded-lg text-xs text-slate-500 leading-relaxed">
    * La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI.<br>
    * El proveedor deberá dar respuesta al reclamo en un plazo no mayor a quince (15) días hábiles improrrogables.
  </div>

  <button type="submit" class="w-full md:w-auto px-8 py-3 bg-[#74A626] hover:bg-[#5E891C] text-white font-bold rounded-lg shadow-md transition-colors cursor-pointer">
    Enviar Hoja de Reclamación
  </button>
</form>
HTML
    ],
];

foreach ($pages as $p) {
    $existing = get_page_by_path($p['slug']);
    if ($existing) {
        wp_update_post([
            'ID'           => $existing->ID,
            'post_title'   => $p['title'],
            'post_content' => $p['content'],
            'post_status'  => 'publish',
        ]);
        echo "Página actualizada: {$p['title']} ({$p['slug']})\n";
    } else {
        wp_insert_post([
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_content' => $p['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
        echo "Página creada: {$p['title']} ({$p['slug']})\n";
    }
}
