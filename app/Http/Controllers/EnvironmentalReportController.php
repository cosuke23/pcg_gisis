<?php

namespace App\Http\Controllers;


use App\Models\DumpSite;
use App\Models\OilSpillIncident;
use App\Models\MepVesselInspection;
use App\Models\MepLandInspection;

use PDF;


class EnvironmentalReportController extends Controller
{


    public function pdf()
    {


        $dumpSites = DumpSite::count();


        $oilSpills = OilSpillIncident::count();


        $vesselInspections = MepVesselInspection::count();


        $landInspections = MepLandInspection::count();



        $criticalSpills =
            OilSpillIncident::where(
                'severity_level',
                'Critical'
            )->count();



        $failedVessels =
            MepVesselInspection::where(
                'inspection_status',
                'Failed'
            )->count();



        $nonCompliant =
            MepLandInspection::where(
                'compliance_status',
                'Non-Compliant'
            )->count();



        // AI Risk Score

        $riskScore = 0;


        $riskScore += ($criticalSpills * 10);

        $riskScore += ($oilSpills * 2);

        $riskScore += ($failedVessels * 5);

        $riskScore += ($nonCompliant * 5);



        if ($riskScore > 100) {

            $riskScore = 100;
        }



        if ($riskScore >= 70) {

            $riskLevel = "HIGH";

            $summary =
                "Environmental indicators show elevated risk.
            Immediate monitoring and corrective actions are recommended.";
        } elseif ($riskScore >= 40) {

            $riskLevel = "MODERATE";

            $summary =
                "Environmental conditions require increased monitoring.";
        } else {

            $riskLevel = "LOW";

            $summary =
                "Environmental indicators remain stable.";
        }



        $data = compact(

            'dumpSites',

            'oilSpills',

            'vesselInspections',

            'landInspections',

            'criticalSpills',

            'failedVessels',

            'nonCompliant',

            'riskScore',

            'riskLevel',

            'summary'

        );



        $pdf = PDF::loadView(
            'reports.environmental_pdf',
            $data
        );



        return $pdf->download(
            'PCG_GISIS_Environmental_Report.pdf'
        );
    }
}
