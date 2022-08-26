<?php
return [
    // Datums Format für die Datenbank. wird von den date input feldern automatisch um geschrieben ins Deutsche Format
    'date_format'         => 'd.m.Y',
    // Für Tüv braucht man nur Jahr und Monat.
    'tuev_format'         => 'm/y',
    'time_format'         => 'H:i',
    'primary_language'    => 'de',
    'available_languages' => [
        'de' => 'German',
    ],
];
