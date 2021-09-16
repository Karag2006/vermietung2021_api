<?php
/*
 *
 *  (c) Martin Richter - 03/2021
 *
 *
*/


return [
    // Datums Format für die Datenbank. wird von den date input feldern automatisch um geschrieben ins Deutsche Format
    'date_format'         => 'Y-m-d',
    // Für Tüv braucht man nur Jahr und Monat.
    'tuev_format'         => 'Y-m',
    'time_format'         => 'H:i',
    'primary_language'    => 'de',
    'available_languages' => [
        'de' => 'German',
    ],
];
