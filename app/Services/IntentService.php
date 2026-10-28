<?php

namespace App\Services;

class IntentService
{
    /**
     * Keywords for each MEPOIS module.
     */
    protected array $keywords = [

        'oil_spill_incidents' => [
            'oil',
            'spill',
            'spills',
            'crude',
            'diesel',
            'petroleum',
            'fuel',
            'leak',
            'leakage',
            'slick',
            'pollution',
            'response'
        ],

        'water_quality_monitorings' => [
            'water',
            'quality',
            'monitoring',
            'monitorings',
            'sampling',
            'sample',
            'ph',
            'temperature',
            'salinity',
            'conductivity',
            'turbidity',
            'ammonia',
            'nitrate',
            'phosphate',
            'oxygen',
            'dissolved oxygen',
            'do',
            'water quality'
        ],

        'coral_assessments' => [
            'coral',
            'corals',
            'reef',
            'reefs',
            'bleaching',
            'rehabilitation',
            'rehabilitate',
            'marine sanctuary',
            'reef assessment'
        ],

        'contact_points' => [
            'contact',
            'contacts',
            'agency',
            'office',
            'telephone',
            'phone',
            'mobile',
            'email',
            'person',
            'coordinator'
        ],

        'dump_sites' => [
            'dump',
            'dumping',
            'dump site',
            'waste disposal',
            'disposal site'
        ],

        'mep_land_inspections' => [
            'land',
            'facility',
            'factory',
            'plant',
            'terminal',
            'warehouse',
            'inspection',
            'land inspection'
        ],

        'mep_vessel_inspections' => [
            'vessel',
            'ship',
            'boat',
            'tanker',
            'cargo',
            'inspection',
            'vessel inspection'
        ],

        'monitorings' => [
            'observation',
            'environmental monitoring',
            'marine monitoring'
        ],

        'annual_activities' => [
            'annual activity',
            'annual activities',
            'london protocol',
            'activity report'
        ],

        'thematic_mappings' => [
            'map',
            'maps',
            'mapping',
            'gis',
            'location',
            'coordinates',
            'latitude',
            'longitude'
        ],

        'c_o2_storages' => [
            'co2',
            'carbon',
            'carbon dioxide',
            'storage',
            'carbon storage'
        ],

    ];

    /**
     * Words to ignore.
     */
    protected array $ignore = [

        'show',
        'list',
        'display',
        'find',
        'search',
        'give',
        'get',
        'please',
        'can',
        'could',
        'would',
        'tell',
        'me',
        'the',
        'all',
        'of',
        'for',
        'in',
        'on',
        'at',
        'to',
        'is',
        'are',
        'was',
        'were',
        'a',
        'an'

    ];

    /**
     * Detect the most relevant table.
     */
    public function detect(string $question): ?string
    {
        $question = strtolower($question);

        // Remove punctuation
        $question = preg_replace('/[^a-z0-9\s]/', ' ', $question);

        // Remove ignored words
        foreach ($this->ignore as $word) {
            $question = preg_replace('/\b' . preg_quote($word, '/') . '\b/', '', $question);
        }

        $question = trim(preg_replace('/\s+/', ' ', $question));

        $scores = [];

        foreach ($this->keywords as $table => $words) {

            $scores[$table] = 0;

            foreach ($words as $keyword) {

                if (str_contains($question, strtolower($keyword))) {

                    // Longer phrases receive higher weight
                    $scores[$table] += str_word_count($keyword) > 1 ? 3 : 1;
                }
            }
        }

        arsort($scores);

        $bestTable = array_key_first($scores);

        return ($scores[$bestTable] > 0)
            ? $bestTable
            : null;
    }

    /**
     * Return all matching modules with scores.
     */
    public function detectAll(string $question): array
    {
        $question = strtolower($question);

        $matches = [];

        foreach ($this->keywords as $table => $words) {

            foreach ($words as $keyword) {

                if (str_contains($question, strtolower($keyword))) {

                    $matches[$table] = ($matches[$table] ?? 0) + 1;
                }
            }
        }

        arsort($matches);

        return $matches;
    }
}
