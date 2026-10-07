<?php
/**
 * Create or Update Aviso de Privacidad Page for Lima Editores
 */

if (!defined('ABSPATH')) {
    exit;
}

$content = <<<'HTML'
<div class="space-y-8 text-slate-700 leading-relaxed max-w-4xl mx-auto">
  
  <div class="bg-gradient-to-r from-slate-50 to-[#F5F9EE] p-6 rounded-xl border border-slate-200">
    <p class="text-sm md:text-base text-slate-700 leading-relaxed">
      En <strong>Lima Editores</strong> (en adelante, "la Editorial"), estamos plenamente comprometidos con la protección, confidencialidad y tratamiento legítimo de sus datos personales. El presente <strong>Aviso de Privacidad</strong> se emite en cumplimiento con la <em>Ley Federal de Protección de Datos Personales en Posesión de los Particulares (LFPDPPP)</em> y su Reglamento, con el objetivo de informarle cómo recabamos, utilizamos, almacenamos y protegemos su información.
    </p>
    <p class="text-xs text-slate-500 mt-2 font-medium">Última actualización: Octubre 2026</p>
  </div>

  <section class="space-y-3">
    <h2 class="font-serif text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 flex items-center gap-2">
      <span class="w-7 h-7 rounded-lg bg-[#74A626]/15 text-[#74A626] inline-flex items-center justify-center text-xs font-bold">1</span>
      Identidad y Domicilio del Responsable
    </h2>
    <p class="text-sm">
      <strong>Lima Editores</strong>, con portal web en <a href="https://local.limaeditores.com" class="text-[#74A626] font-semibold underline">https://local.limaeditores.com</a> y correo electrónico de contacto <a href="mailto:privacidad@limaeditores.com" class="text-[#74A626] font-semibold underline">privacidad@limaeditores.com</a>, es el responsable del tratamiento y resguardo de sus datos personales recabados a través de nuestra tienda en línea, formularios de contacto y canales de atención oficial.
    </p>
  </section>

  <section class="space-y-3">
    <h2 class="font-serif text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 flex items-center gap-2">
      <span class="w-7 h-7 rounded-lg bg-[#74A626]/15 text-[#74A626] inline-flex items-center justify-center text-xs font-bold">2</span>
      Datos Personales que Recabamos
    </h2>
    <p class="text-sm">
      Para brindarle nuestros servicios editoriales, venta de obras jurídicas y despachos a domicilio, podemos recabar las siguientes categorías de datos personales:
    </p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
      <div class="p-4 rounded-lg bg-slate-50 border border-slate-200">
        <h3 class="font-bold text-slate-900 text-sm mb-1"><i class="fa-solid fa-user text-[#74A626] mr-1.5"></i> Datos de Identificación y Contacto</h3>
        <p class="text-xs text-slate-600">Nombre completo, correo electrónico, número telefónico / celular y nombre del despacho o institución (opcional).</p>
      </div>
      <div class="p-4 rounded-lg bg-slate-50 border border-slate-200">
        <h3 class="font-bold text-slate-900 text-sm mb-1"><i class="fa-solid fa-location-dot text-[#74A626] mr-1.5"></i> Datos de Entrega y Envío</h3>
        <p class="text-xs text-slate-600">Dirección completa de entrega (calle, número, colonia, código postal, municipio/alcaldía, estado y referencias de entrega).</p>
      </div>
      <div class="p-4 rounded-lg bg-slate-50 border border-slate-200">
        <h3 class="font-bold text-slate-900 text-sm mb-1"><i class="fa-solid fa-file-invoice-dollar text-[#74A626] mr-1.5"></i> Datos de Facturación Fiscal</h3>
        <p class="text-xs text-slate-600">RFC, Razón Social o nombre fiscal, Régimen Fiscal, Uso de CFDI y Domicilio Fiscal para la emisión de comprobantes fiscales.</p>
      </div>
      <div class="p-4 rounded-lg bg-slate-50 border border-slate-200">
        <h3 class="font-bold text-slate-900 text-sm mb-1"><i class="fa-solid fa-shield-halved text-[#74A626] mr-1.5"></i> Información de Pago Segura</h3>
        <p class="text-xs text-slate-600">Los pagos con tarjeta son procesados directamente por pasarelas seguras certificadas con cifrado SSL de 256 bits. <strong>Lima Editores no almacena números de tarjeta de crédito/débito ni códigos de seguridad (CVV)</strong>.</p>
      </div>
    </div>
  </section>

  <section class="space-y-3">
    <h2 class="font-serif text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 flex items-center gap-2">
      <span class="w-7 h-7 rounded-lg bg-[#74A626]/15 text-[#74A626] inline-flex items-center justify-center text-xs font-bold">3</span>
      Finalidades del Tratamiento de los Datos
    </h2>
    <p class="text-sm">Sus datos personales serán utilizados para las siguientes finalidades:</p>
    
    <div class="space-y-3">
      <div class="border-l-4 border-[#74A626] pl-4 py-1">
        <h3 class="font-bold text-slate-900 text-sm">Finalidades Primarias (necesarias para el servicio):</h3>
        <ul class="list-disc pl-5 text-xs text-slate-600 space-y-1 mt-1">
          <li>Procesar, confirmar, gestionar y despachar sus órdenes de compra de libros y tratados jurídicos.</li>
          <li>Generar y emitir las facturas y comprobantes fiscales digitales correspondientes.</li>
          <li>Gestionar la logística de entrega y rastreo de envíos a través de empresas de paquetería autorizadas.</li>
          <li>Atender dudas, solicitudes de aclaración, seguimiento de pedidos y servicio de soporte al cliente.</li>
          <li>Cumplir con las obligaciones legales, contables y regulatorias aplicables.</li>
        </ul>
      </div>

      <div class="border-l-4 border-slate-300 pl-4 py-1">
        <h3 class="font-bold text-slate-900 text-sm">Finalidades Secundarias (no indispensables):</h3>
        <ul class="list-disc pl-5 text-xs text-slate-600 space-y-1 mt-1">
          <li>Envío de boletines informativos sobre novedades editoriales, tratados de doctrina y códigos actualizados.</li>
          <li>Promociones y beneficios especiales para suscriptores y clientes frecuentes.</li>
        </ul>
        <p class="text-xs text-slate-500 mt-1 italic">
          Si no desea recibir comunicaciones promocionales, puede solicitar su baja en cualquier momento a través del enlace al pie de los correos o escribiendo a <a href="mailto:privacidad@limaeditores.com" class="text-[#74A626] underline">privacidad@limaeditores.com</a>.
        </p>
      </div>
    </div>
  </section>

  <section class="space-y-3">
    <h2 class="font-serif text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 flex items-center gap-2">
      <span class="w-7 h-7 rounded-lg bg-[#74A626]/15 text-[#74A626] inline-flex items-center justify-center text-xs font-bold">4</span>
      Transferencia de Datos Personales
    </h2>
    <p class="text-sm">
      Lima Editores no comercializa, transfiere ni cede sus datos personales a terceros no autorizados. Sus datos únicamente podrán ser transferidos a:
    </p>
    <ul class="list-disc pl-6 text-xs text-slate-600 space-y-1">
      <li><strong>Empresas de logística y mensajería:</strong> Exclusivamente nombre, teléfono y dirección de destino para la entrega física de sus pedidos.</li>
      <li><strong>Pasarelas de pagos y entidades financieras:</strong> Para la validación segura de cobros.</li>
      <li><strong>Autoridades competentes:</strong> En los supuestos previstos por la legislación vigente.</li>
    </ul>
  </section>

  <section class="space-y-3">
    <h2 class="font-serif text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 flex items-center gap-2">
      <span class="w-7 h-7 rounded-lg bg-[#74A626]/15 text-[#74A626] inline-flex items-center justify-center text-xs font-bold">5</span>
      Ejercicio de Derechos ARCO (Acceso, Rectificación, Cancelación y Oposición)
    </h2>
    <p class="text-sm">
      Usted tiene derecho a conocer qué datos personales tenemos de usted, para qué los usamos y las condiciones del uso que les damos (<strong>Acceso</strong>). Asimismo, es su derecho solicitar la corrección de su información (<strong>Rectificación</strong>), que la eliminemos de nuestros registros (<strong>Cancelación</strong>), oponerse al uso de sus datos para fines específicos (<strong>Oposición</strong>), o revocar el consentimiento otorgado.
    </p>
    <div class="p-4 rounded-lg bg-[#F5F9EE] border border-[#74A626]/30">
      <p class="text-xs text-slate-700 leading-relaxed">
        Para ejercer cualquiera de sus <strong>Derechos ARCO</strong>, envíe una solicitud por correo electrónico a <a href="mailto:privacidad@limaeditores.com" class="font-bold text-[#74A626] underline">privacidad@limaeditores.com</a> adjuntando su identificación oficial y la descripción clara de los derechos que desea ejercer. Responderemos a su solicitud en un plazo máximo de 20 días hábiles conforme a la ley.
      </p>
    </div>
  </section>

  <section class="space-y-3">
    <h2 class="font-serif text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 flex items-center gap-2">
      <span class="w-7 h-7 rounded-lg bg-[#74A626]/15 text-[#74A626] inline-flex items-center justify-center text-xs font-bold">6</span>
      Uso de Cookies y Tecnologías Web
    </h2>
    <p class="text-sm">
      Nuestro sitio web utiliza cookies técnicas para permitir el correcto funcionamiento del carrito de compras, recordar su sesión de usuario y mejorar su experiencia de navegación. Usted puede configurar su navegador para bloquear o ser notificado sobre la instalación de cookies, aunque algunas funciones esenciales de la tienda podrían verse afectadas.
    </p>
  </section>

  <section class="space-y-3">
    <h2 class="font-serif text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 flex items-center gap-2">
      <span class="w-7 h-7 rounded-lg bg-[#74A626]/15 text-[#74A626] inline-flex items-center justify-center text-xs font-bold">7</span>
      Modificaciones al Aviso de Privacidad
    </h2>
    <p class="text-sm">
      Nos reservamos el derecho de efectuar en cualquier momento modificaciones o actualizaciones al presente Aviso de Privacidad, para la atención de novedades legislativas, políticas internas o mejoras en nuestros servicios. Cualquier actualización será publicada oportunamente en esta sección.
    </p>
  </section>

  <div class="mt-8 pt-6 border-t border-slate-200 text-center text-xs text-slate-500">
    <p>¿Tiene alguna duda sobre el tratamiento de sus datos personales? Escríbanos a <a href="mailto:privacidad@limaeditores.com" class="text-[#74A626] font-semibold underline">privacidad@limaeditores.com</a> o a <a href="mailto:ventas@limaeditores.com" class="text-[#74A626] font-semibold underline">ventas@limaeditores.com</a>.</p>
  </div>

</div>
HTML;

$existing = get_page_by_path('aviso-de-privacidad');
if (!$existing) {
    // Check if there was privacy-policy
    $existing = get_page_by_path('privacy-policy');
}

if ($existing) {
    wp_update_post([
        'ID'           => $existing->ID,
        'post_title'   => 'Aviso de Privacidad',
        'post_name'    => 'aviso-de-privacidad',
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'page'
    ]);
    $page_id = $existing->ID;
    echo "Página de Aviso de Privacidad actualizada (ID: {$page_id})\n";
} else {
    $page_id = wp_insert_post([
        'post_title'   => 'Aviso de Privacidad',
        'post_name'    => 'aviso-de-privacidad',
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'page'
    ]);
    echo "Página de Aviso de Privacidad creada (ID: {$page_id})\n";
}

update_option('wp_page_for_privacy_policy', $page_id);
echo "Opción wp_page_for_privacy_policy configurada con ID: {$page_id}\n";
