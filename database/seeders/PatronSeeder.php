<?php

namespace Database\Seeders;

use App\Models\Patron;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


            Patron::create([
              'code' => 'PCD-01',
              'description' => 'Juego de bloques patrón',
              'rank' => ['2,5 mm - 75 mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['Grado 0']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '3',
              'certificate_no' => '59844Y18',
              'last_calibration' => '2018/06/26',
              'condition_id' => 1,
              'next_calibration' => '2021/06/26',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-02',
              'description' => 'Bloque de 125 mm',
              'rank' => ['125 mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['Grado AS1']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '3',
              'certificate_no' => '25P42318',
              'last_calibration' => '2018-06-26',
              'condition_id' => 1,
              'next_calibration' => '2021-06-26',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-03',
              'description' => 'Regla patrón de longitud',
              'rank' => ['0 mm - 1000 mm'],
              'brand' => 'Trofeo',
              'precision' => [['title' => 'precision', 'value' => ['0,50 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-04',
              'description' => 'Regla de cristal',
              'rank' => ['0 mm - 200 mm'],
              'brand' => 'Easson',
              'precision' => [['title' => 'precision', 'value' => ['1 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS7587-2019',
              'last_calibration' => '2019-11-01',
              'condition_id' => 1,
              'next_calibration' => '2021-11-14',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-05',
              'description' => 'Patrón de cuentametro',
              'rank' => ['0 mm - 100 mm'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['1 m']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-07',
              'description' => 'Regla digital',
              'rank' => ['0 mm - 1000 mm'],
              'brand' => 'ASC',
              'precision' => [['title' => 'precision', 'value' => ['0,001 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 %']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-08',
              'description' => 'Cinta Métrica',
              'rank' => ['0 mm - 30000 mm'],
              'brand' => 'Profield',
              'precision' => [['title' => 'precision', 'value' => ['0,001 m']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS8797-2020',
              'last_calibration' => '2020-03-02',
              'condition_id' => 1,
              'next_calibration' => '2022-03-02',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-09',
              'description' => 'Juego de Bloques Patrón',
              'rank' => ['125mm - 150mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['B89 0']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,03 %']]],
              'calibration_period' => '5',
              'condition_id' => 2,
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-10',
              'description' => 'Cinta métrica',
              'rank' => ['0 mm - 15000 mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['1 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 %']]],
              'calibration_period' => '3',
              'certificate_no' => 'Nº 3919-109',
              'last_calibration' => '2019-01-22',
              'condition_id' => 1,
              'next_calibration' => '2022-01-14',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-11',
              'description' => 'Lupa graduada',
              'rank' => ['0 mm - 6 mm'],
              'brand' => 'Precision',
              'precision' => [['title' => 'precision', 'value' => ['0,05 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '3',
              'certificate_no' => 'X8LY9A18',
              'last_calibration' => '2018-06-29',
              'condition_id' => 1,
              'next_calibration' => '2021-06-26',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-12',
              'description' => 'Micrometro digital',
              'rank' => ['0 mm - 25 mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['0,001 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,01 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS6950-2019',
              'last_calibration' => '2019-04-01',
              'condition_id' => 1,
              'next_calibration' => '2021-04-05',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-13',
              'description' => 'Regla Patron',
              'rank' => ['0 mm - 1000 mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['1 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,03 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'UMCI-DMEC-LLO Nº 1170',
              'last_calibration' => '2018-09-05',
              'condition_id' => 1,
              'next_calibration' => '2021-09-05',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-14',
              'description' => 'Planos ópticos',
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['0,0005 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,01 %']]],
              'certificate_no' => '11-79920-B',
              'last_calibration' => '2011-07-03',
              'condition_id' => 1,
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-15',
              'description' => 'Cabezal micrométrico',
              'rank' => ['0 mm - 25 mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['0,001 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '3',
              'certificate_no' => '9LCJ6W18',
              'last_calibration' => '2018-06-26',
              'condition_id' => 1,
              'next_calibration' => '2021-06-26',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-16',
              'description' => 'Cabezal micrométrico',
              'rank' => ['0 pol- 1 pol'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['0,00005 pol']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-17',
              'description' => 'Mesa de planitud',
              'rank' => ['N/A'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['Clase 0']]],
              'certificate_no' => '0089/15',
              'last_calibration' => '2015-12-10',
              'condition_id' => 1,
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-18',
              'description' => 'Galgas de espesor',
              'rank' => ['0 mm - 1 mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['0,05 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,03 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS8798-2020',
              'last_calibration' => '2020-03-02',
              'condition_id' => 1,
              'next_calibration' => '2022-03-02',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-19',
              'description' => 'Micrómetro de interior',
              'rank' => ['7,9mm - 25,4mm'],
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['0,001 mm']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,005 mm']]],
              'calibration_period' => '3',
              'certificate_no' => 760.01,
              'last_calibration' => '2019-02-04',
              'condition_id' => 1,
              'next_calibration' => '2022-02-04',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCD-20',
              'description' => 'Cinta métrica',
              'brand' => 'Starrett',
              'precision' => [['title' => 'precision', 'value' => ['Clase I']]],
              'error_max' => [['title' => 'error', 'value' => ['± 10,1 mm']]],
              'calibration_period' => '1',
              'certificate_no' => 'LS9820-2020',
              'last_calibration' => '2020-08-31',
              'condition_id' => 1,
              'next_calibration' => '2021-08-08',
              'magnitude_id' => 3,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCE-08',
              'description' => 'Adaptador de pinzas amperométricas',
              'rank' => ['N/A'],
              'brand' => 'Transmille',
              'error_max' => [['title' => 'error', 'value' => ['± 2,00 %']]],
              'calibration_period' => '3',
              'certificate_no' => 37692,
              'last_calibration' => '2018-12-20',
              'condition_id' => 1,
              'next_calibration' => '2021-12-20',
              'magnitude_id' => 5,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCE-09',
              'description' => 'Punta Atenuadora de Tensión',
              'rank' => ['0 V - 40 KV (DC), 0 V - 28 KV (AC)'],
              'brand' => 'Fluke',
              'precision' => [['title' => 'precision', 'value' => ['DC: ± 2% / AC: ± 5 %']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2,00 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'J2ETKD20',
              'last_calibration' => '2020-02-20',
              'condition_id' => 1,
              'next_calibration' => '2022-02-04',
              'magnitude_id' => 5,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCM-01',
              'description' => 'Juego de pesas patrón',
              'rank' => ['10mg - 100g'],
              'brand' => 'Dolz Hnos. SRL',
              'precision' => [['title' => 'precision', 'value' => ['Clase E2']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,01 %']]],
              'calibration_period' => '3',
              'certificate_no' => 1419,
              'last_calibration' => '2018-08-24',
              'condition_id' => 1,
              'next_calibration' => '2021-08-08',
              'magnitude_id' => 9,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCM-02',
              'description' => 'Pesa de 100 g',
              'rank' => ['100g'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['Clase E2']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,01 %']]],
              'calibration_period' => '3',
              'certificate_no' => 1418,
              'last_calibration' => '2018-08-23',
              'condition_id' => 1,
              'next_calibration' => '2021-08-08',
              'magnitude_id' => 9,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCM-03',
              'description' => 'Juego de pesas patrón',
              'rank' => ['1g - 2kg'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['Clase F2']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'UMCI-DMAS-LMA Nº 1242',
              'last_calibration' => '2020-09-14',
              'condition_id' => 1,
              'next_calibration' => '2022-09-14',
              'magnitude_id' => 9,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCM-04',
              'description' => 'Pesa de 5 kg',
              'rank' => ['5kg'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['Clase M1']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'UMCI-DMAS-LMA Nº 1243',
              'last_calibration' => '2020-09-14',
              'condition_id' => 1,
              'next_calibration' => '2022-09-14',
              'magnitude_id' => 9,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCM-05',
              'description' => 'Pesa de 10 kg',
              'rank' => ['10kg'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['Clase M1']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'UMCI-DMAS-LMA Nº 1244',
              'last_calibration' => '2020-09-14',
              'condition_id' => 1,
              'next_calibration' => '2022-09-14',
              'magnitude_id' => 9,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCM-06',
              'description' => 'Pesa de 20 kg',
              'rank' => ['20kg'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['Clase M1']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'UMCI-DMAS-LMA Nº 1245',
              'last_calibration' => '2020-09-14',
              'condition_id' => 1,
              'next_calibration' => '2022-09-14',
              'magnitude_id' => 9,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCM-07',
              'description' => 'Balanza',
              'rank' => ['0kg - 150kg'],
              'brand' => 'OHAUS',
              'precision' => [['title' => 'precision', 'value' => ['± 0,01']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '1',
              'certificate_no' => 'LS9069-2020',
              'last_calibration' => '2020-04-30',
              'condition_id' => 1,
              'next_calibration' => '2021-04-05',
              'magnitude_id' => 9,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-02',
              'description' => 'Multicalibrador de 14',
              'rank' => ['0°C - 150°C'],
              'brand' => 'Ecil',
              'precision' => [['title' => 'precision', 'value' => ['± 0,02 %']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '3',
              'certificate_no' => '7489/18',
              'last_calibration' => '2018-08-08',
              'condition_id' => 1,
              'next_calibration' => '2021-08-08',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-03',
              'description' => 'Termorresistecia PT 100 Ω',
              'rank' => ['-25 °C a 375 °C'],
              'brand' => 'Consistec',
              'precision' => [['title' => 'precision', 'value' => ['Clase A']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,02 %']]],
              'calibration_period' => '3',
              'certificate_no' => 'LS4498-2018',
              'last_calibration' => '2018-02-07',
              'condition_id' => 1,
              'next_calibration' => '2021-02-07',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-04',
              'description' => 'Pirómetro laser',
              'rank' => ['14 °C a 180 °C'],
              'brand' => 'Titantemp',
              'precision' => [['title' => 'precision', 'value' => ['± ( 2,00 % o + 2) oC']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2,00 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS8289-2019',
              'last_calibration' => '2019-12-11',
              'condition_id' => 1,
              'next_calibration' => '2021-12-20',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-05',
              'description' => 'Horno isotérmico',
              'rank' => ['0 °C a 300 °C'],
              'brand' => 'Visomes',
              'precision' => [['title' => 'precision', 'value' => ['± 0,10 oC']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,10 oC']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-09',
              'description' => 'Datalogger - S/N: 216419',
              'rank' => ['0 °C - 140 °C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 oC']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 oC']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-10',
              'description' => 'Datalogger - S/N: 216416',
              'rank' => ['0 °C - 140 °C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 oC']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 oC']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-11',
              'description' => 'Datalogger - S/N: 216413',
              'rank' => ['0 °C - 140 °C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 oC']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 oC']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-12',
              'description' => 'Horno isotérmico',
              'rank' => ['-30 °C - 140 °C'],
              'brand' => 'Isotech',
              'precision' => [['title' => 'precision', 'value' => ['± 0,03 oC']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,03 oC']]],
              'calibration_period' => '3',
              'certificate_no' => 'LS5546-2018',
              'last_calibration' => '2018-07-31',
              'condition_id' => 1,
              'next_calibration' => '2021-07-31',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-14',
              'description' => 'Termorresistecia PT 100 Ω',
              'rank' => ['-200 °C - 850 °C'],
              'brand' => 'Isotech',
              'precision' => [['title' => 'precision', 'value' => ['Clase A']]],
              'error_max' => [['title' => 'error', 'value' => ['Clase A']]],
              'calibration_period' => '3',
              'certificate_no' => 'UMCI-DTER-LTE Nº 4114',
              'last_calibration' => '2018-09-24',
              'condition_id' => 1,
              'next_calibration' => '2021-09-05',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-18',
              'description' => 'Datalogger - S/N: 326576',
              'rank' => ['-30°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-19',
              'description' => 'Datalogger - S/N: 327913',
              'rank' => ['-30°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-20',
              'description' => 'Datalogger - S/N: 328029',
              'rank' => ['-30°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-21',
              'description' => 'Datalogger - S/N: 326142',
              'rank' => ['-30°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-22',
              'description' => 'Datalogger - S/N; 326353',
              'rank' => ['-30°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-23',
              'description' => 'Datalogger - S/N: 327912',
              'rank' => ['-30°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-24',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 70°C'],
              'brand' => 'Testo',
              'precision' => [['title' => 'precision', 'value' => ['0,1 °C / 0,1 %']]],
              'error_max' => [['title' => 'error', 'value' => ['± 1 °C / ± 5 %']]],
              'calibration_period' => '1',
              'certificate_no' => 'LS8786-2020',
              'last_calibration' => '2020-03-04',
              'condition_id' => 1,
              'next_calibration' => '2021-03-04',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-25',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 70°C'],
              'brand' => 'Testo',
              'precision' => [['title' => 'precision', 'value' => ['0,1 °C / 0,1 %']]],
              'error_max' => [['title' => 'error', 'value' => ['± 1 °C / ± 5 %']]],
              'calibration_period' => '1',
              'certificate_no' => 'LS8787-2020',
              'last_calibration' => '2020-03-04',
              'condition_id' => 1,
              'next_calibration' => '2021-03-04',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-26',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 70°C'],
              'brand' => 'Testo',
              'precision' => [['title' => 'precision', 'value' => ['0,1 °C / 0,1 %']]],
              'error_max' => [['title' => 'error', 'value' => ['± 1 °C / ± 5 %']]],
              'calibration_period' => '1',
              'certificate_no' => 'LS8788-2020',
              'last_calibration' => '2020-03-04',
              'condition_id' => 1,
              'next_calibration' => '2021-03-04',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-44',
              'description' => 'Datalogger - S/N: 452708',
              'rank' => ['0°C - 400°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'certificate_no' => 'TMP-346328-1',
              'last_calibration' => '2019-07-04',
              'condition_id' => 1,
              'next_calibration' => '2021-07-31',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-57',
              'description' => 'Datalogger - S/N: 447199',
              'rank' => ['-80°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'certificate_no' => 'TMP-357736-1',
              'last_calibration' => '2019-10-01',
              'condition_id' => 1,
              'next_calibration' => '2021-10-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-58',
              'description' => 'Datalogger - S/N: 447202',
              'rank' => ['-80°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'certificate_no' => 'TMP-357737-1',
              'last_calibration' => '2019-10-01',
              'condition_id' => 1,
              'next_calibration' => '2021-10-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-59',
              'description' => 'Datalogger - S/N: 447213',
              'rank' => ['-80°C - 140°C'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,05 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,05 °C']]],
              'calibration_period' => '2',
              'certificate_no' => 'TMP-357738-1',
              'last_calibration' => '2019-10-01',
              'condition_id' => 1,
              'next_calibration' => '2021-10-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-60',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 60°C'],
              'brand' => 'Elitech',
              'precision' => [['title' => 'precision', 'value' => ['± 0,5 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS9164-2020',
              'last_calibration' => '2020-05-01',
              'condition_id' => 1,
              'next_calibration' => '2022-05-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-61',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 60°C'],
              'brand' => 'Elitech',
              'precision' => [['title' => 'precision', 'value' => ['± 0,5 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS9165-2020',
              'last_calibration' => '2020-05-01',
              'condition_id' => 1,
              'next_calibration' => '2022-05-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-62',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 60°C'],
              'brand' => 'Elitech',
              'precision' => [['title' => 'precision', 'value' => ['± 0,5 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS9166-2020',
              'last_calibration' => '2020-05-01',
              'condition_id' => 1,
              'next_calibration' => '2022-05-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-63',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 60°C'],
              'brand' => 'Elitech',
              'precision' => [['title' => 'precision', 'value' => ['± 0,5 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS9161-2020',
              'last_calibration' => '2020-05-01',
              'condition_id' => 1,
              'next_calibration' => '2022-05-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-64',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 60°C'],
              'brand' => 'Elitech',
              'precision' => [['title' => 'precision', 'value' => ['± 0,5 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS9163-2020',
              'last_calibration' => '2020-05-01',
              'condition_id' => 1,
              'next_calibration' => '2022-05-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-65',
              'description' => 'Datalogger',
              'rank' => ['-20°C - 60°C'],
              'brand' => 'Elitech',
              'precision' => [['title' => 'precision', 'value' => ['± 0,5 °C']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'LS9162-2020',
              'last_calibration' => '2020-05-01',
              'condition_id' => 1,
              'next_calibration' => '2022-05-01',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-72',
              'description' => 'Datalogger',
              'brand' => 'Peaktech',
              'calibration_period' => '1',
              'certificate_no' => 'LS10682-2021',
              'last_calibration' => '2021-01-09',
              'condition_id' => 1,
              'next_calibration' => '2022-01-14',
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCT-73',
              'description' => 'Termopar tipo K',
              'brand' => 'S/D',
              'condition_id' => 2,
              'magnitude_id' => 14,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCP-01',
              'description' => 'Datalogger 13',
              'rank' => ['0 °C - 140 °C, -0,95 bar - 5 bar'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,25 %']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,25 %']]],
              'calibration_period' => '3',
              'certificate_no' => 'LS6687-2019',
              'last_calibration' => '2019-02-05',
              'condition_id' => 1,
              'next_calibration' => '2022-02-04',
              'magnitude_id' => 13,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCP-02',
              'description' => 'Transmisor de 13',
              'rank' => ['0 bar - 25 bar'],
              'brand' => 'Wika',
              'precision' => [['title' => 'precision', 'value' => ['0,010 bar']]],
              'error_max' => [['title' => 'error', 'value' => ['0,2 % FS']]],
              'calibration_period' => '3',
              'certificate_no' => 'UMCI-DTER-LTE Nº 1525',
              'last_calibration' => '2020-02-06',
              'condition_id' => 1,
              'next_calibration' => '2023-02-06',
              'magnitude_id' => 13,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCP-03',
              'description' => 'Transmisor de 13',
              'rank' => ['-19,99 mbar - 25 mbar'],
              'brand' => 'Wika',
              'precision' => [['title' => 'precision', 'value' => ['0,010 mbar']]],
              'error_max' => [['title' => 'error', 'value' => ['0,2 % FS']]],
              'calibration_period' => '3',
              'certificate_no' => 'UMCI-DTER-LTE Nº 1527',
              'last_calibration' => '2020-02-10',
              'condition_id' => 1,
              'next_calibration' => '2023-02-06',
              'magnitude_id' => 13,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCP-04',
              'description' => 'Transmisor de 13',
              'rank' => ['0 mbar - 250 mbar'],
              'brand' => 'Wika',
              'precision' => [['title' => 'precision', 'value' => ['0,1 mbar']]],
              'error_max' => [['title' => 'error', 'value' => ['0,2 % FS']]],
              'calibration_period' => '3',
              'certificate_no' => 'UMCI-DTER-LTE Nº 1526',
              'last_calibration' => '2020-02-12',
              'condition_id' => 1,
              'next_calibration' => '2023-02-06',
              'magnitude_id' => 13,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCP-05',
              'description' => 'Datalogger 13',
              'rank' => ['-30 °C - 60 °C, -1 mbar - 1000 mbar'],
              'brand' => 'Ellab',
              'precision' => [['title' => 'precision', 'value' => ['± 0,25 %']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,25 %']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 13,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCP-06',
              'description' => 'Transmisor de 13',
              'rank' => ['-1 bar - 3 bar'],
              'brand' => 'Wika',
              'precision' => [['title' => 'precision', 'value' => ['0,004 bar']]],
              'error_max' => [['title' => 'error', 'value' => ['0,1 % FS']]],
              'calibration_period' => '3',
              'certificate_no' => 3511355,
              'last_calibration' => '2018-03-15',
              'condition_id' => 1,
              'next_calibration' => '2021-03-04',
              'magnitude_id' => 13,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCI-01',
              'description' => 'Lámpara patrón',
              'brand' => 'Osram',
              'precision' => [['title' => 'precision', 'value' => ['Clase 1']]],
              'error_max' => [['title' => 'error', 'value' => ['Clase 1']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 18,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCI-03',
              'description' => 'Lámpara patrón',
              'brand' => 'Osram',
              'precision' => [['title' => 'precision', 'value' => ['Clase 1']]],
              'error_max' => [['title' => 'error', 'value' => ['Clase 1']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 8,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCI-04',
              'description' => 'Lámpara patrón',
              'brand' => 'Osram',
              'precision' => [['title' => 'precision', 'value' => ['Clase 1']]],
              'error_max' => [['title' => 'error', 'value' => ['Clase 1']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 8,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCI-05',
              'description' => 'Lámpara patrón',
              'brand' => 'Osram',
              'precision' => [['title' => 'precision', 'value' => ['Clase 1']]],
              'error_max' => [['title' => 'error', 'value' => ['Clase 1']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 8,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCI-06',
              'description' => 'Lámpara patrón',
              'brand' => 'Osram',
              'precision' => [['title' => 'precision', 'value' => ['Clase 1']]],
              'error_max' => [['title' => 'error', 'value' => ['Clase 1']]],
              'calibration_period' => '3',
              'condition_id' => 2,
              'magnitude_id' => 8,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCI-07',
              'description' => 'Lámpara patrón',
              'rank' => ['750 lumen'],
              'brand' => 'Osram',
              'precision' => [['title' => 'precision', 'value' => ['Clase 1']]],
              'error_max' => [['title' => 'error', 'value' => ['Clase 1']]],
              'calibration_period' => '3',
              'certificate_no' => '222-00471',
              'last_calibration' => '2019-08-12',
              'condition_id' => 1,
              'next_calibration' => '2022-08-12',
              'magnitude_id' => 8,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PTI-01',
              'description' => 'Cronometro',
              'rank' => ['N/A'],
              'brand' => 'RadioShack',
              'precision' => [['title' => 'precision', 'value' => ['± 0,10 %']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,10 %']]],
              'calibration_period' => '2',
              'certificate_no' => 'UMCI-DTER-LTF No. 123',
              'last_calibration' => '2020-04-27',
              'condition_id' => 1,
              'next_calibration' => '2022-04-27',
              'magnitude_id' => 8,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCH-01',
              'description' => 'Patron de 4',
              'rank' => ['52 IRHD - 86,9 IRHD'],
              'brand' => 'Bareiss',
              'calibration_period' => '5',
              'certificate_no' => '9143-01',
              'last_calibration' => '2016-02-07',
              'condition_id' => 1,
              'next_calibration' => '2021-02-07',
              'magnitude_id' => 4,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCH-02',
              'description' => 'Patron de 4',
              'rank' => ['50,9 Shore A - 72,5 Shore A'],
              'brand' => 'Bareiss',
              'calibration_period' => '5',
              'certificate_no' => '9144-01',
              'last_calibration' => '2016-02-07',
              'condition_id' => 1,
              'next_calibration' => '2021-02-07',
              'magnitude_id' => 4,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCA-01',
              'description' => 'Calibrador acústico',
              'rank' => ['94 dB - 114 dB'],
              'brand' => 'TES',
              'precision' => [['title' => 'precision', 'value' => ['Clase 2']]],
              'error_max' => [['title' => 'error', 'value' => ['Clase 2']]],
              'calibration_period' => '3',
              'certificate_no' => '1,80E-06',
              'last_calibration' => '2018-01-09',
              'condition_id' => 4,
              'next_calibration' => '2021-01-09',
              'magnitude_id' => 2,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PCF-01',
              'description' => 'Patrón de Torque',
              'rank' => ['0 Nm - 200 Nm'],
              'brand' => 'KIWAV',
              'precision' => [['title' => 'precision', 'value' => ['0,1 N.m']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2 %']]],
              'calibration_period' => '1',
              'certificate_no' => 'LS10096-2020',
              'last_calibration' => '2020-10-03',
              'condition_id' => 1,
              'next_calibration' => '2021-10-01',
              'magnitude_id' => 6,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-01',
              'description' => 'Solución de 1 413 µS/cm',
              'rank' => ['1 413 µS/cm'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-02',
              'description' => 'Solución de 84 µS/cm',
              'rank' => ['84 µS/cm'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-03',
              'description' => 'Solución de pH 4',
              'rank' => ['pH 4'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'certificate_no' => '1.094.351.000',
              'last_calibration' => '2018-10-01',
              'condition_id' => 1,
              'next_calibration' => '2021-10-01',
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-04',
              'description' => 'Solución de pH 7',
              'rank' => ['pH 7'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'certificate_no' => '1.094.391.000',
              'last_calibration' => '2019-11-01',
              'condition_id' => 1,
              'next_calibration' => '2022-11-01',
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-05',
              'description' => 'Solución de pH 10',
              'rank' => ['pH 10'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'certificate_no' => '1.094.381.000',
              'last_calibration' => '2019-04-01',
              'condition_id' => 1,
              'next_calibration' => '2022-04-27',
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-06',
              'description' => 'Solución de NaCl 2 %',
              'rank' => ['NaCl 2 %'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,3 %']]],
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-07',
              'description' => 'Solución de NaCl 4 %',
              'rank' => ['NaCl 4 %'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,3 %']]],
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-08',
              'description' => 'Solución de NaCl 6 %',
              'rank' => ['NaCl 6 %'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,3 %']]],
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-09',
              'description' => 'Solución de NaCl 8 %',
              'rank' => ['NaCl 8 %'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,3 %']]],
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-10',
              'description' => 'Solución de NaCl 10 %',
              'rank' => ['NaCl 10 %'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['± 0,3 %']]],
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-11',
              'description' => 'Solución de 10 µS/cm',
              'rank' => ['10 µS/cm'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'certificate_no' => 2006933,
              'last_calibration' => '2020-06-26',
              'condition_id' => 1,
              'next_calibration' => '2021-06-26',
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-12',
              'description' => 'Solución de 1,3 µS/cm',
              'rank' => ['1,3 µS/cm'],
              'brand' => 'HAMILTON',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'certificate_no' => '238973/111129814',
              'last_calibration' => '2020-05-01',
              'condition_id' => 1,
              'next_calibration' => '2021-04-05',
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'PRC-13',
              'description' => 'Solución de 132 µS/cm',
              'rank' => ['132 µS/cm'],
              'brand' => 'INYMA',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['± 2 µS/cm']]],
              'certificate_no' => '12-0130-2 / R110-1',
              'last_calibration' => '2021-02-07',
              'condition_id' => 1,
              'next_calibration' => '2021-08-08',
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'HI93703-0',
              'description' => 'Patrón de turbidez 0,0 FTU',
              'rank' => ['0,0 FTU'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'calibration_period' => '1',
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'HI93703-10',
              'description' => 'Patrón de turbidez 10 FTU',
              'rank' => ['10 FTU'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'calibration_period' => '1',
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'HI93703-05',
              'description' => 'Patrón de turbidez 500 FTU',
              'rank' => ['500 FTU'],
              'brand' => 'S/D',
              'precision' => [['title' => 'precision', 'value' => ['N/A']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'calibration_period' => '1',
              'condition_id' => 2,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);

            Patron::create([
              'code' => 'HI 38054',
              'description' => 'Medidor colorimétrico de Ozono',
              'rank' => ['N/A'],
              'brand' => 'HANNA',
              'precision' => [['title' => 'precision', 'value' => ['±0,01']]],
              'error_max' => [['title' => 'error', 'value' => ['N/A']]],
              'condition_id' => 1,
              'magnitude_id' => 11,
              'alert_calibration_id' => 3,
            ],);
    }
}
