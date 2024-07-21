<?php
// exports/Exporter.php

class Exporter {
    public static function exportToCSV($clients) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=clients.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Nom', 'Adresse', 'Email', 'Sexe', 'Statut']);
        
        foreach ($clients as $client) {
            fputcsv($output, $client);
        }
        fclose($output);
    }

    public static function exportToPDF($clients) {
        //bash monsieur initialiser dompdf(?)
    }
}
?>