<!DOCTYPE html>

<html>

<head>

    <title>
        PCG MEPIOS Environmental Report
    </title>


    <style>
        body {

            font-family: Arial;

        }


        .header {

            text-align: center;

        }


        table {

            width: 100%;

            border-collapse: collapse;

            margin-top: 20px;

        }


        td,
        th {

            border: 1px solid #ccc;

            padding: 8px;

        }


        .title {

            background: #0033A0;

            color: white;

            padding: 10px;

        }
    </style>


</head>


<body>


    <div class="header">


        <h2>
            Philippine Coast Guard
        </h2>


        <h3>
            Marine Environmental Protection Command
        </h3>


        <h4>
            Marine Environmental Protection Integrated Operation System
        </h4>


    </div>



    <hr>


    <h3 class="title">
        Executive Environmental Assessment
    </h3>



    <p>

        <strong>
            AI Risk Level:
        </strong>

        {{ $riskLevel }}

    </p>



    <p>

        <strong>
            Risk Score:
        </strong>

        {{ $riskScore }}%

    </p>



    <p>

        {{ $summary }}

    </p>




    <h3 class="title">

        Environmental Statistics

    </h3>


    <table>


        <tr>

            <th>
                Module
            </th>

            <th>
                Total Records
            </th>


        </tr>


        <tr>

            <td>
                Dump Sites
            </td>

            <td>
                {{ $dumpSites }}
            </td>

        </tr>



        <tr>

            <td>
                Oil Spill Incidents
            </td>

            <td>
                {{ $oilSpills }}
            </td>

        </tr>



        <tr>

            <td>
                Vessel Inspections
            </td>

            <td>
                {{ $vesselInspections }}
            </td>

        </tr>



        <tr>

            <td>
                Land-Based Inspections
            </td>

            <td>
                {{ $landInspections }}
            </td>

        </tr>


    </table>




    <h3 class="title">

        AI Findings

    </h3>


    <ul>


        <li>
            Critical Oil Spills:
            {{ $criticalSpills }}

        </li>


        <li>
            Failed Vessel Inspections:
            {{ $failedVessels }}

        </li>


        <li>
            Non-Compliant Facilities:
            {{ $nonCompliant }}

        </li>


    </ul>



    <h3 class="title">

        Recommended Actions

    </h3>


    <ul>

        <li>
            Increase environmental monitoring activities.
        </li>

        <li>
            Prioritize high-risk inspection areas.
        </li>

        <li>
            Conduct compliance validation.
        </li>


    </ul>



</body>

</html>
