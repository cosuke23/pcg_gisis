<?php

namespace App\Services;

class AISummaryService
{
    public function summarize($table, $records)
    {
        if (empty($records) || count($records) == 0) {
            return "I couldn't find any matching records.";
        }

        return match ($table) {

            'oil_spill_incidents' =>
            $this->oilSpillSummary($records),

            'water_quality_monitorings' =>
            $this->waterQualitySummary($records),

            'coral_assessments' =>
            $this->coralSummary($records),

            'contact_points' =>
            $this->contactSummary($records),

            'dump_sites' =>
            $this->dumpSiteSummary($records),

            'mep_land_inspections' =>
            $this->landInspectionSummary($records),

            'mep_vessel_inspections' =>
            $this->vesselInspectionSummary($records),

            default =>
            $this->genericSummary($table, $records),
        };
    }

    private function genericSummary($table, $records)
    {
        return "I found " . count($records) . " record(s) in " .
            str_replace('_', ' ', $table) . ".";
    }

    private function oilSpillSummary($records)
    {
        $count = count($records);

        $latest = $records[0];

        return
            "I found <b>{$count}</b> oil spill incident(s).<br><br>

            The latest incident is <b>{$latest->incident_number}</b>.

            It involved a <b>{$latest->spill_type}</b> spill originating from a
            <b>{$latest->spill_source}</b>.

            The severity level is
            <b>{$latest->severity_level}</b> and the current response status is
            <b>{$latest->response_status}</b>.";
    }

    private function waterQualitySummary($records)
    {
        $count = count($records);

        $latest = $records[0];

        return
            "I found <b>{$count}</b> water quality monitoring report(s).<br><br>

            The latest report was collected at
            <b>{$latest->monitoring_station}</b>.

            Water quality is classified as
            <b>{$latest->water_quality_status}</b>.

            The recorded pH level is
            <b>{$latest->ph_level}</b>
            with dissolved oxygen at
            <b>{$latest->dissolved_oxygen}</b> mg/L.";
    }

    private function coralSummary($records)
    {
        $count = count($records);

        $coral = $records[0];

        $summary = "
    I found <b>{$count}</b> coral assessment record(s).<br><br>

    The most recent assessment is <b>{$coral->assessment_number}</b>,
    conducted on <b>" . date('F d, Y', strtotime($coral->assessment_date)) . "</b>
    at <b>{$coral->site_name}</b>,
    {$coral->municipality}, {$coral->province}.<br><br>

    The reef is classified as a <b>{$coral->reef_type}</b> and was assessed using the
    <b>{$coral->assessment_method}</b> method.<br><br>

    The assessment recorded:
    <ul>
        <li>🌿 Live Coral Cover: <b>{$coral->live_coral_cover}%</b></li>
        <li>🪸 Dead Coral Cover: <b>{$coral->dead_coral_cover}%</b></li>
        <li>🌱 Algae Cover: <b>{$coral->algae_cover}%</b></li>
        <li>🏖️ Sand Cover: <b>{$coral->sand_cover}%</b></li>
    </ul>

    Overall reef condition is assessed as
    <b>{$coral->reef_condition}</b>.<br><br>";

        if ($coral->rehabilitation_required == 'Yes') {

            $summary .= "
        <b>Rehabilitation is required.</b><br>

        Planned rehabilitation period:
        <b>" . date('F d, Y', strtotime($coral->rehabilitation_start)) . "</b>
        to
        <b>" . date('F d, Y', strtotime($coral->rehabilitation_end)) . "</b>.

        The proposed rehabilitation method is
        <b>{$coral->rehabilitation_method}</b>,
        to be implemented by
        <b>{$coral->implementing_agency}</b>.
        ";
        } else {

            $summary .= "
        Based on the latest assessment, rehabilitation is
        <b>not currently required</b>.
        ";
        }

        $summary .= "

    <br><br>

    Assessment Team Leader:
    <b>{$coral->team_leader}</b>.<br><br>

    Remarks:<br>
    {$coral->remarks}
    ";

        return $summary;
    }

    private function contactSummary($records)
    {
        $count = count($records);

        if ($count === 0) {
            return "I couldn't find any contact point records.";
        }

        $summary = "I found <b>{$count}</b> contact point record(s).<br><br>";

        if ($count === 1) {

            $contact = $records[0];

            $status = $contact->is_active ? "Active" : "Inactive";

            $summary .= "
        Contact Name: <b>{$contact->name}</b><br>
        Position: <b>{$contact->position}</b><br>
        Agency: <b>{$contact->agency}</b><br>
        Country: <b>{$contact->country}</b><br>
        Email: <b>{$contact->email}</b><br>
        Telephone: <b>{$contact->telephone}</b><br>
        Status: <b>{$status}</b>
        ";
        } else {

            $summary .= "
        These contact points belong to various agencies responsible for marine environmental protection, coordination, and emergency response.<br><br>

        <b>Sample Contacts:</b><br><br>";

            foreach (array_slice($records, 0, 5) as $contact) {

                $summary .= "• <b>{$contact->name}</b> – {$contact->position}, {$contact->agency}<br>";
            }

            if ($count > 5) {
                $summary .= "<br>...and <b>" . ($count - 5) . "</b> more contact point(s).";
            }

            $summary .= "<br><br>You can search by a person's name, agency, or country for more specific results.";
        }

        return $summary;
    }

    private function dumpSiteSummary($records)
    {
        $count = count($records);

        if ($count === 0) {
            return "I couldn't find any dump site records.";
        }

        $summary = "I found <b>{$count}</b> dump site record(s).<br><br>";

        if ($count === 1) {

            $site = $records[0];

            $status = $site->is_active ? "Active" : "Inactive";

            $summary .= "
        Site Name: <b>{$site->site_name}</b><br>
        Country: <b>{$site->country}</b><br>
        Location: <b>{$site->location}</b><br>
        Coordinates: <b>{$site->latitude}, {$site->longitude}</b><br>
        Description: <b>{$site->description}</b><br>
        Status: <b>{$status}</b>
        ";
        } else {

            $summary .= "
        These dump sites are designated marine disposal areas used for approved dumping activities under environmental regulations.<br><br>

        <b>Sample Dump Sites:</b><br><br>";

            foreach (array_slice($records, 0, 5) as $site) {

                $summary .= "• <b>{$site->site_name}</b> – {$site->location}, {$site->country}<br>";
            }

            if ($count > 5) {
                $summary .= "<br>...and <b>" . ($count - 5) . "</b> more dump site(s).";
            }

            $summary .= "<br><br>You can search by site name, location, or country for more specific results.";
        }

        return $summary;
    }

    private function landInspectionSummary($records)
    {
        $count = count($records);

        if ($count === 0) {
            return "I couldn't find any land-based inspection records.";
        }

        $summary = "I found <b>{$count}</b> land-based inspection record(s).<br><br>";

        // Single record
        if ($count === 1) {

            $inspection = $records[0];

            $summary .= "
        Inspection Number: <b>{$inspection->inspection_number}</b><br>
        Inspection Date: <b>" . date('F d, Y', strtotime($inspection->inspection_date)) . "</b><br>
        Facility Name: <b>{$inspection->facility_name}</b><br>
        Facility Type: <b>{$inspection->facility_type}</b><br>
        Owner: <b>{$inspection->owner}</b><br>
        Permit Number: <b>{$inspection->permit_number}</b><br>
        Location: <b>{$inspection->inspection_location}, {$inspection->city_municipality}, {$inspection->province}</b><br>
        Inspector: <b>{$inspection->inspector_name}</b><br>
        Compliance Status: <b>{$inspection->compliance_status}</b><br><br>

        <b>Inspection Findings</b><br>
        {$inspection->findings}<br><br>

        <b>Recommendations</b><br>
        {$inspection->recommendations}<br><br>

        <b>Remarks</b><br>
        {$inspection->remarks}<br><br>
        ";

            // AI-style summary
            $summary .= "<hr>";

            if (strtolower($inspection->compliance_status) === 'compliant') {

                $summary .= "
            <b>🤖 AI Summary</b><br><br>

            Based on the latest inspection, <b>{$inspection->facility_name}</b> is currently
            <b>compliant</b> with the applicable marine environmental regulations.
            No major compliance issues were identified during the inspection.
            Continued monitoring and routine inspections are recommended to maintain compliance.
            ";
            } elseif (strtolower($inspection->compliance_status) === 'non-compliant') {

                $summary .= "
            <b>🤖 AI Summary</b><br><br>

            The inspection indicates that <b>{$inspection->facility_name}</b> is
            <b>non-compliant</b> with one or more regulatory requirements.
            The documented findings should be addressed promptly, and the recommended corrective actions should be implemented to improve environmental compliance and reduce potential risks.
            ";
            } else {

                $summary .= "
            <b>🤖 AI Summary</b><br><br>

            The inspection has been completed with a compliance status of
            <b>{$inspection->compliance_status}</b>.
            Users are encouraged to review the findings and recommendations for additional details regarding the facility's environmental performance.
            ";
            }
        } else {

            $summary .= "
        These records represent land-based facilities inspected for compliance with marine environmental protection regulations.<br><br>

        <b>Recent Inspections:</b><br><br>";

            foreach (array_slice($records, 0, 5) as $inspection) {

                $summary .= "• <b>{$inspection->facility_name}</b> ({$inspection->facility_type}) - {$inspection->city_municipality}, {$inspection->province} <b>[{$inspection->compliance_status}]</b><br>";
            }

            if ($count > 5) {
                $summary .= "<br>...and <b>" . ($count - 5) . "</b> more inspection record(s).";
            }

            $summary .= "<br><br><hr>";

            $summary .= "
        <b>🤖 AI Summary</b><br><br>

        The search returned <b>{$count}</b> land-based inspection records covering various facilities.
        These inspections help monitor environmental compliance, verify permit conditions, identify operational issues, and recommend corrective actions where necessary.
        You can narrow your search by facility name, owner, province, city/municipality, inspection number, or compliance status to view more specific inspection records.
        ";
        }

        return $summary;
    }

    private function vesselInspectionSummary($records)
    {
        $count = count($records);

        if ($count === 0) {
            return "I couldn't find any vessel inspection records.";
        }

        $summary = "I found <b>{$count}</b> vessel inspection record(s).<br><br>";

        // Single Record
        if ($count === 1) {

            $vessel = $records[0];

            $summary .= "
        Inspection Number: <b>{$vessel->inspection_number}</b><br>
        Inspection Date: <b>" . date('F d, Y', strtotime($vessel->inspection_date)) . "</b><br>
        Vessel Name: <b>{$vessel->vessel_name}</b><br>
        Vessel Type: <b>{$vessel->vessel_type}</b><br>
        Flag State: <b>{$vessel->flag}</b><br>
        Official Number: <b>{$vessel->official_number}</b><br>
        IMO Number: <b>{$vessel->imo_number}</b><br>
        Call Sign: <b>{$vessel->call_sign}</b><br>
        Owner: <b>{$vessel->owner}</b><br>
        Master: <b>{$vessel->master}</b><br>
        Inspection Location: <b>{$vessel->inspection_location}</b><br>
        Inspector: <b>{$vessel->inspector_name}</b><br>
        Inspection Status: <b>{$vessel->inspection_status}</b><br><br>

        <b>Remarks</b><br>
        {$vessel->remarks}
        ";

            $summary .= "<br><br><hr><br>";

            $status = strtolower($vessel->inspection_status);

            if (str_contains($status, 'passed') || str_contains($status, 'compliant')) {

                $summary .= "
            <b>🤖 AI Summary</b><br><br>

            Based on the inspection results, <b>{$vessel->vessel_name}</b> successfully met the applicable inspection requirements.
            The vessel appears to be in satisfactory condition for the inspected items. Continued compliance with maritime safety and marine environmental protection regulations is recommended through routine maintenance and periodic inspections.
            ";
            } elseif (str_contains($status, 'failed') || str_contains($status, 'non-compliant')) {

                $summary .= "
            <b>🤖 AI Summary</b><br><br>

            The inspection identified deficiencies affecting the vessel's compliance status.
            Appropriate corrective actions should be completed before the vessel's next inspection or operational clearance.
            The inspection remarks should be reviewed carefully to ensure all deficiencies are addressed.
            ";
            } else {

                $summary .= "
            <b>🤖 AI Summary</b><br><br>

            The vessel inspection has been completed with a status of
            <b>{$vessel->inspection_status}</b>.
            Users are encouraged to review the inspection remarks for additional information regarding the vessel's condition and any recommended actions.
            ";
            }
        } else {

            $summary .= "
        These records represent vessel inspections conducted to verify compliance with maritime safety and marine environmental protection requirements.<br><br>

        <b>Recent Vessel Inspections:</b><br><br>";

            foreach (array_slice($records, 0, 5) as $vessel) {

                $summary .= "• <b>{$vessel->vessel_name}</b> ({$vessel->vessel_type}) - {$vessel->flag} <b>[{$vessel->inspection_status}]</b><br>";
            }

            if ($count > 5) {
                $summary .= "<br>...and <b>" . ($count - 5) . "</b> more vessel inspection record(s).";
            }

            $summary .= "<br><br><hr><br>";

            $summary .= "
        <b>🤖 AI Summary</b><br><br>

        The search returned <b>{$count}</b> vessel inspection records covering different vessel types and flag states.
        These inspections are conducted to verify compliance with maritime safety requirements and marine environmental protection regulations.
        You can refine your search by vessel name, vessel type, flag state, owner, inspection number, inspection location, or inspection status to obtain more specific results.
        ";
        }

        return $summary;
    }
}
