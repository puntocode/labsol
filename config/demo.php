<?php

return  [
  'documentos' => [
    (object)[
      'id' => 1,
      'titulo' => 'Documento de servicio',
      'fecha' => '26/01/2020',
      'tipo' => 'excel',
      'descripcion' => 'Resumen de servicio'
    ],
    (object)[
      'id' => 2,
      'titulo' => 'Documento de servicio',
      'fecha' => '01/01/2021',
      'tipo' => 'pdf',
      'descripcion' => 'lorem ipsum'
    ]
  ],

  'incertidumbre' => [
    (object)[
      'id' => 1,
      'simbolo' => 'u p',
      'componente' => 'Sistema patron',
      'valor' => [
        (object) [
          'formula' => 'U',
          'calculado' => '0,0120'
        ]
      ],
      'unidad' => 'A',
      'probabilidad' => [
        (object) [
          'tipo' => 'A',
          'distribucion' => 'Normal'
          ]
        ],
        'divisor' => [
          (object) [
            'formula' => '2',
            'distribucion' => '2,00'
            ]
          ],
        'coeficiente_sensibilidad' => [
          (object) [
            'formula' => '1',
            'calculado' => '1'
            ]
          ],
        'contribucion_patron' => [
          (object) [
            'formula' => '(xi/k) x ci',
            'ui' => '0,00600'
            ]
          ],
        'grados_libertad' => [
          (object) [
            'formula_vi' => '∞',
            'calculado' => '∞'
            ]
          ],
        'porcentual' => '67,5%'
      ],
    (object)[
      'id' => 2,
      'simbolo' => 'u resp',
      'componente' => 'Resolucion del patron',
      'valor' => [
        (object) [
          'formula' => '$$({Res \over 2})$$',
          'calculado' => '0,0120'
        ]
        ],
      'unidad' => 'A',
      'probabilidad' => [
        (object) [
          'tipo' => 'B',
          'distribucion' => 'Rectangular'
        ]
      ],
      'divisor' => [
        (object) [
          'formula' => '$$ \sqrt{3} $$',
          'distribucion' => '1,73'
        ]
      ],
        'coeficiente_sensibilidad' => [
          (object) [
            'formula' => '1',
            'calculado' => '1'
            ]
          ],
        'contribucion_patron' => [
          (object) [
            'formula' => '(xi/k) x ci',
            'ui' => '0,00000'
            ]
          ],
        'grados_libertad' => [
          (object) [
            'formula_vi' => '∞',
            'calculado' => '∞'
            ]
          ],
        'porcentual' => '0,0%'
      ]
    ],

    'actividadesTecnico' => [
      (object) [
        'id' => 1,
        'nro_expediente' => 'LS-5748',
        'instrumento' => 'Instrumento 1',
        'servicio' => 'Servicio 1',
        'estado' => 'En espera',
        'fecha_inicio' => '15/05/2021',
        'hora_inicio' => '14:00 hs',
        'fecha_fin' => '05/06/2021',
        'hora_fin' => '18:00 hs',
        'prioridad' => 'Estándar',
        'fecha_creacion' => '01/05/2021'
      ]
    ],

    'prioridades' => [
      'Estándar', 'Urgente - 24 Horas'
    ],

    'gruposTecnicos' => [
      (object) [
        'id' => 1,
        'titulo' => 'Grupo 1',
        'codigo' => 'grupo_1',
        'encargado' => '',
        'tecnicos' => [
          (object) [
            'id' => 1,
            'nombre' => 'César Báez'
          ],
          (object) [
            'id' => 2,
            'nombre' => 'Martín Alvarenga'
          ],
          (object) [
            'id' => 3,
            'nombre' => 'Rodolgo Nuñez'
          ],
          (object) [
            'id' => 3,
            'nombre' => 'Diego Cristaldo'
          ],
          (object) [
            'id' => 4,
            'nombre' => 'Jorge Castro'
          ],
          (object) [
            'id' => 5,
            'nombre' => 'Sergio Martinez'
          ]
        ]
      ],
      (object) [
        'id' => 2,
        'titulo' => 'Grupo 2',
        'codigo' => 'grupo_2',
        'encargado' => '',
        'tecnicos' => [
          (object) [
            'id' => 1,
            'nombre' => 'Gustavo Ayala'
          ],
          (object) [
            'id' => 2,
            'nombre' => 'Marco González'
          ],
          (object) [
            'id' => 3,
            'nombre' => 'Luis Brítez'
          ],
          (object) [
            'id' => 4,
            'nombre' => 'Evelyn Riveros'
          ],
          (object) [
            'id' => 5,
            'nombre' => 'Mathías López'
          ]
        ]
      ]
    ],
    'usuarios' => [
      (object) [
        'id' => 1,
        'nombre' => 'Germán Ayala',
        'codigo' => '01',
        'cedula' => '2234234',
        'telefono' => '455 454 455',
        'email' => 'usuario@email.com',
        'rol' => 'Secretaría Administrativa',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'G.A'
      ],
      (object) [
        'id' => 2,
        'nombre' => 'Mercedes González',
        'codigo' => '02',
        'cedula' => '113344',
        'telefono' => '',
        'email' => 'usuario@email.com',
        'rol' => 'Jefatura de Calibración',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'M.G'
      ],
      (object) [
        'id' => 3,
        'nombre' => 'Luis Brítez',
        'codigo' => '03',
        'cedula' => '2455766',
        'telefono' => '',
        'email' => 'usuario@email.com',
        'rol' => 'Personal de Laboratorio',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'L.B'
      ],
      (object) [
        'id' => 4,
        'nombre' => 'Elisa Ruiz',
        'codigo' => '04',
        'cedula' => '455656',
        'telefono' => '455 123 455',
        'email' => 'usuario@email.com',
        'rol' => 'Personal de Laboratorio',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'E.R'
      ],
      (object) [
        'id' => 5,
        'nombre' => 'Mathías López',
        'codigo' => '05',
        'cedula' => '123332',
        'telefono' => '455 344 455',
        'email' => 'usuario@email.com',
        'rol' => 'Jefatura de calidad',
        'estado' => 'inactivo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'M.L'
      ],
      (object) [
        'id' => 6,
        'nombre' => 'César Báez',
        'codigo' => '06',
        'cedula' => '245566',
        'telefono' => '455 124 455',
        'email' => 'usuario@email.com',
        'rol' => 'Gerencia Técnica',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'C.B'
      ],
      (object) [
        'id' => 7,
        'nombre' => 'Martín Alvarenga',
        'codigo' => '07',
        'cedula' => '2787998',
        'telefono' => '455 334 455',
        'email' => 'usuario@email.com',
        'rol' => 'Personal de Laboratorio',
        'estado' => 'inactivo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'M.A'
      ],
      (object) [
        'id' => 8,
        'nombre' => 'Rubén Nuñez',
        'codigo' => '08',
        'cedula' => '7889907',
        'telefono' => '455 454 345',
        'email' => 'usuario@email.com',
        'rol' => 'Jefatura de calidad',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'R.N'
      ],
      (object) [
        'id' => 9,
        'nombre' => 'Diego Cristaldo',
        'codigo' => '09',
        'cedula' => '9978445',
        'telefono' => '115 454 455',
        'email' => 'usuario@email.com',
        'rol' => 'Personal de Laboratorio',
        'estado' => 'inactivo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'D.C'
      ]

    ],
    'tecnicos' => [
      (object) [
        'id' => 1,
        'nombre' => 'Gustavo Ayala',
        'cedula' => '2234234',
        'telefono' => '455 454 455',
        'area' => 'Area 1',
        'grupo' => 'Grupo 1',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'G.A'
      ],
      (object) [
        'id' => 2,
        'nombre' => 'Marco González',
        'cedula' => '113344',
        'telefono' => '',
        'area' => 'Area 1',
        'grupo' => 'Grupo 2',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'M.G'
      ],
      (object) [
        'id' => 3,
        'nombre' => 'Luis Brítez',
        'cedula' => '2455766',
        'telefono' => '',
        'area' => 'Area 1',
        'grupo' => 'Grupo 2',
        'estado' => 'activo',
        'disponibilidad' => 'no disponible',
        'abreviatura' => 'L.B'
      ],
      (object) [
        'id' => 4,
        'nombre' => 'Evelyn Riveros',
        'cedula' => '455656',
        'telefono' => '455 123 455',
        'area' => 'Area 1',
        'grupo' => 'Grupo 2',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'E.R'
      ],
      (object) [
        'id' => 5,
        'nombre' => 'Mathías López',
        'cedula' => '123332',
        'telefono' => '455 344 455',
        'area' => 'Area 1',
        'grupo' => 'Grupo 2',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'M.L'
      ],
      (object) [
        'id' => 6,
        'nombre' => 'César Báez',
        'cedula' => '245566',
        'telefono' => '455 124 455',
        'area' => 'Area 1',
        'grupo' => 'Grupo 1',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'C.B'
      ],
      (object) [
        'id' => 7,
        'nombre' => 'Martín Alvarenga',
        'cedula' => '2787998',
        'telefono' => '455 334 455',
        'area' => 'Area 1',
        'grupo' => 'Grupo 1',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'M.A'
      ],
      (object) [
        'id' => 8,
        'nombre' => 'Rodolgo Nuñez',
        'cedula' => '7889907',
        'telefono' => '455 454 345',
        'area' => 'Area 1',
        'grupo' => 'Grupo 1',
        'estado' => 'activo',
        'disponibilidad' => 'no disponible',
        'abreviatura' => 'R.N'
      ],
      (object) [
        'id' => 9,
        'nombre' => 'Diego Cristaldo',
        'cedula' => '9978445',
        'telefono' => '115 454 455',
        'area' => 'Area 1',
        'grupo' => 'Grupo 1',
        'estado' => 'inactivo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'D.C'
      ],
      (object) [
        'id' => 10,
        'nombre' => 'Jorge Castro',
        'cedula' => '343455',
        'telefono' => '345 454 455',
        'area' => 'Area 1',
        'grupo' => 'Grupo 1',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'J.C'
      ],
      (object) [
        'id' => 11,
        'nombre' => 'Sergio Martinez',
        'cedula' => '453323',
        'telefono' => '',
        'area' => 'Area 1',
        'grupo' => 'Grupo 1',
        'estado' => 'activo',
        'disponibilidad' => 'disponible',
        'abreviatura' => 'S.M'
      ]
    ],
    'equipos' => [
      (object)[
        'id' => 1,
        'titulo' => 'Equipo 1',
        'codigo' => 'equipo1',
        'servicio' => 'Servicio 1'
      ],
      (object)[
        'id' => 2,
        'titulo' => 'Equipo 2',
        'codigo' => 'equipo2',
        'servicio' => 'Servicio 2'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'Equipo 3',
        'codigo' => 'equipo3',
        'servicio' => 'Servicio 3'
      ],
    ],
    'tipos_actividades' => [
      (object)[
        'id' => 1,
        'titulo' => 'Update',
        'codigo' => 'update'
      ],
      (object)[
        'id' => 2,
        'titulo' => 'Mantenimiento correctivo',
        'codigo' => 'mto_correctivo'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'MCR Previsión de repuestos',
        'codigo' => 'prev_repuestos'
      ],
      (object)[
        'id' => 4,
        'titulo' => 'Mantenimiento preventivo',
        'codigo' => 'mto_preventivo'
      ],
      (object)[
        'id' => 5,
        'titulo' => 'Conexión remota',
        'codigo' => 'conex_remota'
      ],
      (object)[
        'id' => 6,
        'titulo' => 'Montaje',
        'codigo' => 'montaje'
      ],
      (object)[
        'id' => 7,
        'titulo' => 'Reunión',
        'codigo' => 'reunion'
      ],
      (object)[
        'id' => 8,
        'titulo' => 'Atención telefónica',
        'codigo' => 'ate_telefonica'
      ],

    ],
    'estados_calibraciones' => [
      (object)[
        'id' => 1,
        'titulo' => 'En espera',
        'codigo' => 'en_espera'
      ],
      (object)[
        'id' => 2,
        'titulo' => 'En proceso',
        'codigo' => 'en_proceso'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'Completadas',
        'codigo' => 'completadas'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'Aprobada',
        'codigo' => 'aprobada'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'Facturada',
        'codigo' => 'facturada'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'Anulada',
        'codigo' => 'anulada'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'En suspensión',
        'codigo' => 'en_suspension'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'Rechazada',
        'codigo' => 'rechazada'
      ],
      (object)[
        'id' => 3,
        'titulo' => 'Prefacturado',
        'codigo' => 'prefacturado'
      ],
    ],

    'clientes' => [
      (object)[
        'id' => 1,
        'razon_social' => 'Condel',
        'documento' => '80023598-3',

      ],
      (object)[
        'id' => 2,
        'razon_social' => 'Inpaco',
        'documento' => '80023598-3',
      ]
    ],


    'clientesContacto' => [
      (object)[
        'id' => 1,
        'razon_social' => 'Condel',
        'documento' => '80023598-3',
        'nombre_contacto' => 'Nombre Apellido',
        'telefono' => '(021) 218 2000',
        'direccion' => 'Lorem ipsum',
        'email' => 'contacto@ejemplo.com'
      ],
      (object)[
        'id' => 2,
        'razon_social' => 'Inpaco',
        'documento' => '80023598-3',
        'nombre_contacto' => 'Nombre Apellido',
        'telefono' => '(021) 218 2000',
        'direccion' => 'Lorem ipsum',
        'email' => 'contacto@ejemplo.com'
      ],
      (object)[
        'id' => 3,
        'razon_social' => 'Alex S.A.',
        'documento' => '80023598-3',
        'nombre_contacto' => 'Nombre Apellido',
        'telefono' => '(021) 218 2000',
        'direccion' => 'Lorem ipsum',
        'email' => 'contacto@ejemplo.com'
      ],
      (object)[
        'id' => 4,
        'razon_social' => 'Tecnoedil S.A.',
        'documento' => '80023598-3',
        'nombre_contacto' => 'Nombre Apellido',
        'telefono' => '(021) 218 2000',
        'direccion' => 'Lorem ipsum',
        'email' => 'contacto@ejemplo.com'
      ],
      (object)[
        'id' => 5,
        'razon_social' => 'Chacomer',
        'documento' => '80023598-3',
        'nombre_contacto' => 'Nombre Apellido',
        'telefono' => '(021) 218 2000',
        'direccion' => 'Lorem ipsum',
        'email' => 'contacto@ejemplo.com'
      ],
      (object)[
        'id' => 6,
        'razon_social' => 'Luminotecnia',
        'documento' => '80023598-3',
        'nombre_contacto' => 'Nombre Apellido',
        'telefono' => '(021) 218 2000',
        'direccion' => 'Lorem ipsum',
        'email' => 'contacto@ejemplo.com'
      ],
      (object)[
        'id' => 7,
        'razon_social' => 'Petrobras',
        'documento' => '80023598-3',
        'nombre_contacto' => 'Nombre Apellido',
        'telefono' => '(021) 218 2000',
        'direccion' => 'Lorem ipsum',
        'email' => 'contacto@ejemplo.com'
      ]
    ],
    'instrumentos' => [
      (object)[
        'id' => 1,
        'nombre' => 'Amperimetro',
        'identificacion' => '0',
        'marca'=>'Amprobe',
        'modelo'=>'AM-100',
        'nro_serie'=>'N10140',
        'intervalo'=>'(0 a 600) A',
        'resolucion'=>'0,01',
        'tipo'=>'Digital',
      ],
      (object)[
        'id' => 2,
        'nombre' => 'Ohmímetros',
        'identificacion' => '0',
        'marca'=>'Amprobe',
        'modelo'=>'AM-100',
        'nro_serie'=>'N10140',
        'intervalo'=>'(0 a 600) A',
        'resolucion'=>'0,01',
        'tipo'=>'Digital',
      ],
    ],
    'patrones' => [
      (object)[
        'id' => 1,
        'identificacion' => 'PCE-07',
        'descripcion' => 'Multicalibrador eléctrico',
        'certificado'=>'C Nº: 37684',
        'prox_calibracion'=> '2021-12',

      ],
      (object)[
        'id' => 2,
        'identificacion' => 'PCT-15',
        'descripcion' => 'Termohigrometro',
        'certificado'=>'LS10072-2020',
        'prox_calibracion'=> '2021-10',

      ],
    ],
    'entrada_instrumentos' =>[
      (object)[
        'id' => 1,
        'nro_expediente' => 'LS-5748',
        'equipo' => 'Equipo 784',
        'servicio' => 'Magnitudes Eléctricas',
        'cantidad' => '1',
        'cliente' => 'Condel',
        'prioridad' => 'Estándar',
        'estado' => 'En espera',
        'observaciones' => 'lorem ipsum'
      ],
      (object)[
        'id' => 2,
        'nro_expediente' => 'LS-8792',
        'equipo' => 'Equipo 144',
        'servicio' => 'Magnitudes Eléctricas',
        'cantidad' => '1',
        'cliente' => 'Alex S.A.',
        'prioridad' => 'Urgente - 24 horas',
        'estado' => 'En proceso',
        'observaciones' => 'lorem ipsum'
      ],
      (object)[
        'id' => 3,
        'nro_expediente' => 'LS-8792',
        'equipo' => 'Equipo 123',
        'servicio' => 'Magnitud Temperatura',
        'cantidad' => '1',
        'cliente' => 'Petrobras',
        'prioridad' => 'Urgente - 24 horas',
        'estado' => 'Completada',
        'observaciones' => 'lorem ipsum'
      ]
    ],

    'facturas' => [
      (object)[
        'id' => 1,
        'numero' => '001-001-000258',
        'razon_social' => 'Condel',
        'fecha_emision' => '11/01/2021',
        'estado' => 'Abonada',
        'total' => 'Gs. 480.000'
      ],
      (object)[
        'id' => 2,
        'numero' => '001-001-000598',
        'razon_social' => 'Alex S.A.',
        'fecha_emision' => '15/03/2021',
        'estado' => 'Abonada',
        'total' => 'Gs. 500.000'
      ],
      (object)[
        'id' => 3,
        'numero' => '001-001-000987',
        'razon_social' => 'Chacomer',
        'fecha_emision' => '15/05/2021',
        'estado' => 'Pendiente',
        'total' => 'Gs. 500.000'
      ],
    ],

    'servicios' => [
      (object)[
        'id' => 1,
        'descripcion' => 'Servicio 1'
      ],
      (object)[
        'id' => 2,
        'descripcion' => 'Servicio 2'
      ],
      (object)[
        'id' => 3,
        'descripcion' => 'Servicio 3'
      ],
    ],

    'expedientes' =>[
      (object)[
        'id' => 1,
        'nro_expediente' => 'LS-5748',
        'instrumento' => 'Instrumento 1',
        'servicio' => 'Servicio 1',
        'prioridad' => 'Estándar',
        'estado' => 'En espera',
        'observaciones' => 'lorem ipsum',
        'tecnicos_asignados' => 'Juan Mendoza',
        'fecha_entrega' => '01/06/2021'
      ],
      (object)[
        'id' => 2,
        'nro_expediente' => 'LS-8792',
        'instrumento' => 'Instrumento 1',
        'servicio' => 'Servicio 4',
        'prioridad' => 'Urgente - 24 horas',
        'estado' => 'Aprobada',
        'observaciones' => 'lorem ipsum',
        'tecnicos_asignados' => NULL,
        'fecha_entrega' => '29/05/2021'
      ],
      (object)[
        'id' => 3,
        'nro_expediente' => 'LS-8791',
        'instrumento' => 'Instrumento 1',
        'servicio' => 'Servicio 1',
        'prioridad' => 'Urgente - 24 horas',
        'estado' => 'Rechazada',
        'observaciones' => 'lorem ipsum',
        'tecnicos_asignados' => NULL,
        'fecha_entrega' => '29/05/2021'
      ]
    ],

    'calibraciones' =>[
      (object)[
        'id' => 1,
        'nro_expediente' => '5748',
        'solicitante' => 'Frigorífico Concepción S.A.',
        'direccion' => 'Ruta 3 Gral Aquino km 18,5 MRA',
        'ruc' => '80023325-5',
        'telefono' => '+59521 286 146',
        'contacto' => '',
        'email' => '',

        'instrumento' =>  'Amperimetro',
        'identificacion' => '0',
        'marca'=>'Amprobe',
        'modelo'=>'AM-100',
        'nro_serie'=>'N10140',
        'intervalo'=>'(0 a 600) A',
        'resolucion'=>'0,01',
        'tipo'=>'Digital',

        'patrones' => 'Multicalibrador eléctrico',

        'fecha_calibracion' => '01/06/2021',
        'lugar' => 'Laboratorio Labsol',
        'temperatura' => '20,5 °C',
        'humedad_relativa' => '58 %',
        'procedimiento' => 'LS-PRO-C03 Rev.00',
        'observaciones' => 'La incertidumbre típica combinada fue determinada en conformidad con el documento Guía para la Expresión de la incertidumbre en las mediciones (GUM).',

        'fecha_fin' => '15/06/2021',
        'temperatura_final' => '20,5 °C',
        'humedad_final' => '58 %',
        'firma' => 'Andrea Fernandez',
      ],
      (object)[
        'id' => 2,
        'nro_expediente' => '7896',
        'solicitante' => 'Frigorífico Concepción S.A.',
        'direccion' => 'Ruta 3 Gral Aquino km 18,5 MRA',
        'ruc' => '80023325-5',
        'telefono' => '+59521 286 146',
        'contacto' => '',
        'email' => '',

        'instrumento' =>  'Amperimetro',
        'identificacion' => '0',
        'marca'=>'Amprobe',
        'modelo'=>'AM-100',
        'nro_serie'=>'N10140',
        'intervalo'=>'(0 a 600) A',
        'resolucion'=>'0,01',
        'tipo'=>'Digital',

        'patrones' => 'Termohigrometro',

        'fecha_calibracion' => '01/06/2021',
        'lugar' => 'Laboratorio Labsol',
        'temperatura' => '20,5 °C',
        'humedad_relativa' => '58 %',
        'procedimiento' => 'LS-PRO-C03 Rev.00',
        'observaciones' => 'La incertidumbre típica combinada fue determinada en conformidad con el documento Guía para la Expresión de la incertidumbre en las mediciones (GUM).',
        'fecha_fin' => '15/06/2021',
        'temperatura_final' => '20,5 °C',
        'humedad_final' => '58 %',
        'firma' => 'Andrea Fernandez',
      ],
      (object)[
        'id' => 3,
        'nro_expediente' => '1235',
        'solicitante' => 'Frigorífico Concepción S.A.',
        'direccion' => 'Ruta 3 Gral Aquino km 18,5 MRA',
        'ruc' => '80023325-5',
        'telefono' => '+59521 286 146',
        'contacto' => '',
        'email' => '',

        'instrumento' =>  'Amperimetro',
        'identificacion' => '0',
        'marca'=>'Amprobe',
        'modelo'=>'AM-100',
        'nro_serie'=>'N10140',
        'intervalo'=>'(0 a 600) A',
        'resolucion'=>'0,01',
        'tipo'=>'Digital',

        'patrones' => 'Multicalibrador eléctrico',

        'fecha_calibracion' => '01/06/2021',
        'lugar' => 'Laboratorio Labsol',
        'temperatura' => '20,5 °C',
        'humedad_relativa' => '58 %',
        'procedimiento' => 'LS-PRO-C03 Rev.00',
        'observaciones' => 'La incertidumbre típica combinada fue determinada en conformidad con el documento Guía para la Expresión de la incertidumbre en las mediciones (GUM).',
        'fecha_fin' => '15/06/2021',
        'temperatura_final' => '20,5 °C',
        'humedad_final' => '58 %',
        'firma' => 'Andrea Fernandez',
      ]
    ],
    'eventos' => [
      (object)[
        'id' => 1,
        'proximo_contacto' => '26/01/2021',
        'motivo' => 'Reunión mensual',
        'cliente' => 'Cliente 1',
        'modalidad' => 'Conexión remota',
        'tipo_equipo' => 'Tomografía',
        'estado_equipo' => 'Operativo',
        'asignado' => 'Sofia Vergara',
        'estado' => 'normal'
      ],
      (object)[
        'id' => 2,
        'proximo_contacto' => '04/01/2021',
        'motivo' => 'Relevamiento de datos',
        'cliente' => 'Cliente 2',
        'modalidad' => 'update',
        'tipo_equipo' => 'Radiografía',
        'estado_equipo' => 'Inoperativo',
        'asignado' => 'Jorge Lopez',
        'estado' => 'atrasado'
      ]
    ],
    'agendamientos' => [
      (object)[
        'id' => 1,
        'fecha' => '17/08/2020',
        'semana' => 34,
        'dia' => 'Lunes',
        'hora_salida' => '08:00 hs',
        'hora_inicio' => '09:30',
        'hora_fin' => '10:30',
        'kit' => NULL,
        'cantidad' => NULL,
        'cliente' => 'Alex S.A.',
        'equipo' => 'Amperimetro',
        'categoria' => 'MC',
        'descripcion' => 'lorem ipsum',
        'observaciones' => 'confirmado',
        'comentarios' => '',
        'estado' => 'vigente',
        'tecnicos_asignados' => [
          (object) [
            'id' => 11,
            'nombre' => 'Sergio Martinez',
            'abreviatura' => 'SM'
          ]
        ]
      ],
      (object)[
        'id' => 1,
        'fecha' => '17/08/2020',
        'semana' => 34,
        'dia' => 'Lunes',
        'hora_salida' => '08:00 hs',
        'hora_inicio' => '09:45',
        'hora_fin' => '17:00',
        'kit' => NULL,
        'cantidad' => NULL,
        'cliente' => 'Tecnoedil S.A.',
        'equipo' => 'Amperimetro',
        'categoria' => 'MC',
        'descripcion' => 'lorem ipsum',
        'estado' => 'cancelado',
        'observaciones' => 'lorem ipsum',
        'comentarios' => 'lorem ipsum',
        'tecnicos_asignados' => [
          (object) [
            'id' => 8,
            'nombre' => 'Rodolfo Nuñez',
            'abreviatura' => 'RN'
          ]
        ]
      ],
      (object)[
        'id' => 1,
        'fecha' => '18/08/2020',
        'semana' => 34,
        'dia' => 'Martes',
        'hora_salida' => '',
        'hora_inicio' => '09:00',
        'hora_fin' => '10:00',
        'kit' => NULL,
        'cantidad' => NULL,
        'cliente' => 'Luminotecnia',
        'equipo' => 'Amperimetro',
        'categoria' => 'MC',
        'descripcion' => 'lorem ipsum',
        'estado' => 'vigente',
        'observaciones' => 'lorem ipsum',
        'comentarios' => '',
        'tecnicos_asignados' => [
          (object) [
            'id' => 5,
            'nombre' => 'Mathías López',
            'abreviatura' => 'ML'
          ]
        ]
      ],
      (object)[
        'id' => 1,
        'fecha' => '17/08/2020',
        'semana' => 34,
        'dia' => 'Lunes',
        'hora_salida' => '06:00 hs',
        'hora_inicio' => '11:00',
        'hora_fin' => '12:00',
        'kit' => NULL,
        'cantidad' => NULL,
        'cliente' => 'Petrobras',
        'equipo' => 'Amperimetro',
        'categoria' => 'MC',
        'descripcion' => 'Verificación',
        'estado' => 'vigente',
        'observaciones' => 'feriado',
        'comentarios' => '',
        'tecnicos_asignados' => [
          (object) [
            'id' => 1,
            'nombre' => 'Gustavo Ayala',
            'abreviatura' => 'GA'
          ]
        ]
      ],
      (object)[
        'id' => 1,
        'fecha' => '17/08/2020',
        'semana' => 34,
        'dia' => 'Lunes',
        'hora_salida' => '08:00 hs',
        'hora_inicio' => '',
        'hora_fin' => '',
        'kit' => NULL,
        'cantidad' => NULL,
        'cliente' => 'Condel',
        'equipo' => 'Amperimetro',
        'categoria' => 'Viaje',
        'descripcion' => 'Encarnación',
        'estado' => 'vigente',
        'observaciones' => '',
        'comentarios' => '',
        'tecnicos_asignados' => [
          (object) [
            'id' => 9,
            'nombre' => 'Diego Cristaldo',
            'abreviatura' => 'DC'
          ],
          (object) [
            'id' => 2,
            'nombre' => 'Marco González',
            'abreviatura' => 'MG'
          ]
        ]
      ]
    ]
  ];
