<?php

namespace App\Http\Controllers;

use App\Models\DumpSite;
use App\Models\OilSpillIncident;
use App\Models\MepVesselInspection;
use App\Models\MepLandInspection;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        // ================================
        // KPI CARDS
        // ================================

        $dumpSites = DumpSite::count();

        $oilSpills = OilSpillIncident::count();

        $vesselInspections = MepVesselInspection::count();

        $landInspections = MepLandInspection::count();



        // ================================
        // OIL SPILL TREND
        // ================================

        $oilTrend = OilSpillIncident::selectRaw("
            MONTH(incident_date) as month,
            COUNT(*) as total
        ")
            ->groupByRaw("MONTH(incident_date)")
            ->pluck('total', 'month');


        $oilTrendData = [];

        for ($i = 1; $i <= 12; $i++) {

            $oilTrendData[] = $oilTrend[$i] ?? 0;
        }



        // ================================
        // SPILL SEVERITY
        // ================================

        $severity = OilSpillIncident::selectRaw("
            severity_level,
            COUNT(*) total
        ")
            ->groupBy('severity_level')
            ->pluck('total', 'severity_level');



        // ================================
        // VESSEL STATUS
        // ================================

        $vesselStatus = MepVesselInspection::selectRaw("
            inspection_status,
            COUNT(*) total
        ")
            ->groupBy('inspection_status')
            ->pluck('total', 'inspection_status');



        // ================================
        // LAND COMPLIANCE
        // ================================

        $landStatus = MepLandInspection::selectRaw("
            compliance_status,
            COUNT(*) total
        ")
            ->groupBy('compliance_status')
            ->pluck('total', 'compliance_status');



        // ================================
        // DUMP SITES
        // ================================

        $dumpProvince = DumpSite::selectRaw("
            site_name,
            COUNT(*) total
        ")
            ->groupBy('site_name')
            ->pluck('total', 'site_name');




        // =====================================================
        // AI ENVIRONMENTAL RISK ENGINE - PHASE 3A
        // =====================================================


        $criticalSpills = OilSpillIncident::where(
            'severity_level',
            'Critical'
        )->count();


        $failedVessels = MepVesselInspection::where(
            'inspection_status',
            'Failed'
        )->count();


        $nonCompliantFacilities = MepLandInspection::where(
            'compliance_status',
            'Non-Compliant'
        )->count();



        // Risk Score

        $riskScore = 0;


        // Oil Spill Risk 40%

        if ($oilSpills > 0) {

            $riskScore += min(
                ($criticalSpills / $oilSpills) * 40,
                40
            );
        }



        // Vessel Risk 25%

        if ($vesselInspections > 0) {

            $riskScore += min(
                ($failedVessels / $vesselInspections) * 25,
                25
            );
        }



        // Land Risk 25%

        if ($landInspections > 0) {

            $riskScore += min(
                ($nonCompliantFacilities / $landInspections) * 25,
                25
            );
        }



        // Dump Site Risk 10%

        if ($dumpSites == 0) {

            $riskScore += 10;
        }



        $riskScore = round($riskScore);



        // Risk Level

        if ($riskScore >= 75) {

            $riskLevel = "Critical";
        } elseif ($riskScore >= 50) {

            $riskLevel = "High";
        } elseif ($riskScore >= 25) {

            $riskLevel = "Moderate";
        } else {

            $riskLevel = "Low";
        }



        // ================================
        // AI FINDINGS
        // ================================


        $aiFindings = [];

        $aiRecommendation = [];



        if ($criticalSpills > 0) {

            $aiFindings[] =
                "{$criticalSpills} critical oil spill incident(s) detected requiring immediate monitoring.";


            $aiRecommendation[] =
                "Increase oil spill response readiness and monitor affected coastal areas.";
        }



        if ($failedVessels > 0) {

            $aiFindings[] =
                "{$failedVessels} vessel(s) failed environmental inspection.";


            $aiRecommendation[] =
                "Conduct follow-up vessel inspection and verify corrective actions.";
        }



        if ($nonCompliantFacilities > 0) {

            $aiFindings[] =
                "{$nonCompliantFacilities} land-based facility(ies) are currently non-compliant.";


            $aiRecommendation[] =
                "Schedule compliance verification and enforcement activities.";
        }



        if ($dumpSites == 0) {

            $aiFindings[] =
                "No registered marine dump sites detected in the system.";


            $aiRecommendation[] =
                "Validate authorized disposal areas and update GIS records.";
        }



        if (empty($aiFindings)) {


            $aiFindings[] =
                "Environmental indicators are within acceptable operational conditions.";


            $aiRecommendations[] =
                "Continue routine monitoring and scheduled environmental inspections.";
        }




        // Main Risk Status

        $aiStatus = $riskLevel . " Environmental Risk";




        return view('reports.index', compact(

            'dumpSites',

            'oilSpills',

            'vesselInspections',

            'landInspections',


            // Charts

            'oilTrendData',

            'severity',

            'vesselStatus',

            'landStatus',

            'dumpProvince',


            // AI Engine

            'aiStatus',

            'riskScore',

            'riskLevel',

            'aiFindings',

            'aiRecommendations'

        ));
    }
}
