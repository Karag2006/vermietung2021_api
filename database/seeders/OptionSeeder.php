<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'id'                => 1,
            'vat'               => 19,

            'offer_note'        => '<ul><li><strong>+ Anhänger und Zubehör sind Teilkaskoversichert mit 750 € Selbstbeteiligung !</strong></li><li><strong>+ Eine Vollkaskoversicherung besteht nicht !</strong></li><li><strong>+ Spanngurte werden pro Stück mit 2,00 € für die Mietzeit zusätzlich zum Mietpreis berechnet !</strong></li><li><strong>+ Der Vertrag wird erst nach Erhalt der gesamten Mietanzahlung bis u.g. Termin verbindlich !</strong></li><li><strong>+ Bei einer Stornierung wird eine Stornogebühr in Höhe der Anzahlung berechnet !</strong></li></ul>',

            'reservation_note'  => '<ul><li><strong>+ Anhänger und Zubehör sind Teilkaskoversichert mit 750 € Selbstbeteiligung !</strong></li><li><strong>+ Eine Vollkaskoversicherung besteht nicht !</strong></li><li><strong>+ Spanngurte werden pro Stück mit 2,00 € für die Mietzeit zusätzlich zum Mietpreis berechnet !</strong></li><li><strong>+ Das Fahrzeug kann nur zum genannten Abholtermin in Empfang genommen werden.</strong></li><li><strong>+ Bei einer Stornierung wird eine Stornogebühr in Höhe der Anzahlung berechnet !</strong></li></ul><p>&nbsp;</p>',

            'contract_note'     => '<ul><li><strong>+ Anhänger und Zubehör sind Teilkaskoversichert mit 750 € Selbstbeteiligung ! !!</strong></li><li><strong>+ Eine Vollkaskoversicherung besteht nicht !</strong></li><li><strong>+ Der Mieter erkennt die umseitigen Geschäftsbedingungen an !</strong></li><li><strong>+ Bei Verlust des Fahrzeugscheins werden 65 Euro für die Wiederbeschaffung berechnet !</strong></li></ul>',

            'document_footer'   => '<p>Escobar Anhängercenter &nbsp;• &nbsp;Inh. : Torsten Hebenstrick &nbsp;• Industriepark 13 - 15 • D-56593 Horhausen / Westerwald<br>SteuerNr.: 02 / 062 / 51544 • USt-ID : DE 2411 499 64&nbsp;<br>Bankverbindung : Escobar Anhängercenter • VR-Bank Rhein Sieg • DE61 3706 9520 1202 5610 27</p>',

            'contactdata'       => '<p>Escobar Anhängercenter <br>Industriepark 13 - 15 <br>D-56593 Horhausen / Westerwald <br><br>Telefon : 02687 – 9289538</p>',

            'license_classes' => '["B", "BE", "B96", "Klasse 3"]'
        ]);
    }
}
