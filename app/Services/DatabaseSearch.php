<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSearch
{
    protected $tables = [
        'annual_activities',
        'c_o2_storages',
        'contact_points',
        'coral_assessments',
        'dump_sites',
        'mep_land_inspections',
        'mep_vessel_inspections',
        'monitorings',
        'oil_spill_incidents',
        'thematic_mappings',
        'water_quality_monitorings',
    ];

    public function search($keyword)
    {
        $results = [];

        foreach ($this->tables as $table) {

            $columns = Schema::getColumnListing($table);

            $query = DB::table($table);

            foreach ($columns as $column) {

                try {
                    $query->orWhere($column, 'LIKE', "%{$keyword}%");
                } catch (\Exception $e) {
                    // Ignore unsupported column types
                }
            }

            $records = $query->limit(5)->get();

            if ($records->count()) {
                $results[$table] = $records;
            }
        }

        return $results;
    }
    public function searchTable($table, $keyword)
    {
        $keyword = strtolower(trim($keyword));

        // If the user only asked for the module, return the latest records
        $moduleOnly = [
            'contact',
            'contacts',
            'contact point',
            'contact points',

            'oil',
            'oil spill',
            'oil spills',

            'water',
            'water quality',

            'coral',
            'corals',

            // ADD THEM HERE
            'dump site',
            'dump sites',
            'dumpsite',
            'dumpsites',
            'disposal site',
            'disposal sites',

            'land',
            'land inspection',
            'land inspections',
            'facility',
            'facilities',

            // Vessel Inspection
            'vessel',
            'vessels',
            'ship',
            'ships',
            'boat',
            'boats',
            'craft',
            'vessel inspection',
            'vessel inspections',
            'port state control',

            'inspection',
            'inspections',
        ];

        if (in_array($keyword, $moduleOnly)) {

            return [
                $table => DB::table($table)
                    ->latest('id')
                    ->limit(10)
                    ->get()
            ];
        }

        // Normal search
        $columns = Schema::getColumnListing($table);

        $query = DB::table($table);

        $first = true;

        foreach ($columns as $column) {

            try {

                if ($first) {

                    $query->where($column, 'LIKE', "%{$keyword}%");

                    $first = false;
                } else {

                    $query->orWhere($column, 'LIKE', "%{$keyword}%");
                }
            } catch (\Exception $e) {
                // Ignore unsupported column types
            }
        }

        return [
            $table => $query->limit(10)->get()
        ];
    }
}
