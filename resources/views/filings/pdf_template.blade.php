<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SVRMS Dossier: {{ $application->reference_no }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #5a189a;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #5a189a;
            margin: 0;
            font-size: 20pt;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 10pt;
            color: #666;
        }

        .section-title {
            background-color: #f3e8ff;
            color: #5a189a;
            padding: 8px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
            border-left: 4px solid #5a189a;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            width: 30%;
            background-color: #fafafa;
            font-weight: bold;
            color: #555;
        }

        .page-break {
            page-break-after: always;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10pt;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-warning {
            background-color: #ffedd5;
            color: #9a3412;
        }

        .prose {
            border: 1px solid #eee;
            padding: 15px;
            background-color: #fafafa;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Site Visit Report Management System (SVRMS)</h1>
        <p>Official Application Dossier</p>
        <p>Generated: {{ now()->format('d M Y, H:i') }}</p>
    </div>

    <!-- 1. Executive Summary / Final Decision -->
    <div class="section-title">1. Executive Summary & Final Decision</div>
    @php $approval = $application->approvals->last(); @endphp
    <table class="data-table">
        <tr>
            <th>Application Ref No.</th>
            <td><strong>{{ $application->reference_no }}</strong></td>
        </tr>
        <tr>
            <th>Final Status</th>
            <td>
                @if($application->status === 'FILED' && $approval)
                    @if($approval->decision === 'APPROVED')
                        <span class="badge badge-success">APPROVED & FILED</span>
                    @else
                        <span class="badge badge-danger">REJECTED & FILED</span>
                    @endif
                @else
                    <strong>{{ $application->status }}</strong>
                @endif
            </td>
        </tr>
        <tr>
            <th>Final Decision By</th>
            <td>{{ $approval ? $approval->director->name : 'N/A' }}</td>
        </tr>
        <tr>
            <th>Decision Date</th>
            <td>{{ $approval ? $approval->created_at->format('d M Y, H:i') : 'N/A' }}</td>
        </tr>
        @if($approval && $approval->conditions)
            <tr>
                <th>Imposed Conditions</th>
                <td>{{ $approval->conditions }}</td>
            </tr>
        @endif
        @if($approval && $approval->remarks)
            <tr>
                <th>General Notes</th>
                <td>{{ $approval->remarks }}</td>
            </tr>
        @endif
    </table>

    <!-- 2. Application & Developer Details -->
    <div class="section-title">2. Application, Location & Developer Details</div>
    <table class="data-table">
        <tr>
            <th>Project Title (Tajuk)</th>
            <td>{{ $application->tajuk }}</td>
        </tr>
        <tr>
            <th>Location Details</th>
            <td>{{ $application->lokasi }}</td>
        </tr>
        @if($application->site)
            <tr>
                <th>Registered Land Information</th>
                <td>
                    Mukim: {{ $application->site->mukim }} | Lot: {{ $application->site->lot }} <br>
                    Area: {{ number_format($application->site->luas, 4) }} | Category:
                    {{ $application->site->kategori_tanah }} <br>
                    Coordinates: {{ $application->site->google_lat }}, {{ $application->site->google_long }}
                </td>
            </tr>
        @endif
        <tr>
            <th>Developer Name</th>
            <td>{{ $application->developer->name }}</td>
        </tr>
        <tr>
            <th>Contact Info</th>
            <td>{{ $application->developer->tel }} | {{ $application->developer->email }}</td>
        </tr>
    </table>

    <div class="page-break"></div>

    <!-- 3. Site Visit Report -->
    <div class="header">
        <h1>Phase 1: Site Investigation</h1>
        <p>Ref: {{ $application->reference_no }}</p>
    </div>

    @php $siteVisit = $application->siteVisits->last(); @endphp
    @if($siteVisit)
        <table class="data-table">
            <tr>
                <th>Inspecting Officer</th>
                <td>{{ $siteVisit->officer->name }}</td>
            </tr>
            <tr>
                <th>Visit Date</th>
                <td>{{ $siteVisit->visit_date->format('d M Y') }}</td>
            </tr>
            @if($siteVisit->location_data)
                <tr>
                    <th>GPS Capture Verification</th>
                    <td>{{ $siteVisit->location_data }}</td>
                </tr>
            @endif
        </table>

        <!-- Site Conditions & Infra -->
        <h4 style="color:#5a189a; margin-top:20px;">Site Conditions & Infrastructure</h4>
        <table class="data-table">
            <tr>
                <th style="width: 25%;">Activity</th>
                <td style="width: 25%;">{{ $siteVisit->activity ?: 'N/A' }}</td>
                <th style="width: 25%;">Facility</th>
                <td style="width: 25%;">{{ $siteVisit->facility ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Entrance Way</th>
                <td>{{ $siteVisit->entrance_way ?: 'N/A' }}</td>
                <th>Drainage (Parit)</th>
                <td>{{ $siteVisit->parit ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Trees Estimated</th>
                <td>{{ $siteVisit->tree ?: 'N/A' }}</td>
                <th>Topography</th>
                <td>{{ $siteVisit->topography ?: 'N/A' }}</td>
            </tr>
        </table>

        <!-- Verification & Others -->
        <h4 style="color:#5a189a; margin-top:20px;">Verification Attributes</h4>
        <table class="data-table">
            <tr>
                <th style="width: 25%;">Land Use Zone</th>
                <td style="width: 25%;">{{ $siteVisit->land_use_zone ?: 'N/A' }}</td>
                <th style="width: 25%;">Density</th>
                <td style="width: 25%;">{{ $siteVisit->density ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Recommend Road</th>
                <td>{{ $siteVisit->recommend_road ? 'YES' : 'NO' }}</td>
                <th>Anjakan (Setback)</th>
                <td>{{ $siteVisit->anjakan ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Social Facility</th>
                <td colspan="3">{{ $siteVisit->social_facility ?: 'N/A' }}</td>
            </tr>
        </table>

        <h4 style="color:#5a189a; margin-top:20px;">Directional Boundary Synthesis & Photos</h4>
        <div class="prose">
            <p><strong>North:</strong> {{ $siteVisit->finding_north ?: 'N/A' }}</p>
            @if($siteVisit->photos_north && is_array($siteVisit->photos_north))
                <div style="margin-top: 10px; margin-bottom: 15px;">
                    @foreach($siteVisit->photos_north as $photo)
                        @php 
                            $path = storage_path('app/public/' . $photo); 
                            $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                        @endphp
                        @if($base64)
                            <img src="{{ $base64 }}" style="max-width: 200px; max-height: 200px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px;">
                        @endif
                    @endforeach
                </div>
            @endif

            <p><strong>South:</strong> {{ $siteVisit->findings_south ?: 'N/A' }}</p>
            @if($siteVisit->photos_south && is_array($siteVisit->photos_south))
                <div style="margin-top: 10px; margin-bottom: 15px;">
                    @foreach($siteVisit->photos_south as $photo)
                        @php 
                            $path = storage_path('app/public/' . $photo); 
                            $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                        @endphp
                        @if($base64)
                            <img src="{{ $base64 }}" style="max-width: 200px; max-height: 200px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px;">
                        @endif
                    @endforeach
                </div>
            @endif

            <p><strong>East:</strong> {{ $siteVisit->findings_east ?: 'N/A' }}</p>
            @if($siteVisit->photo_east && is_array($siteVisit->photo_east))
                <div style="margin-top: 10px; margin-bottom: 15px;">
                    @foreach($siteVisit->photo_east as $photo)
                        @php 
                            $path = storage_path('app/public/' . $photo); 
                            $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                        @endphp
                        @if($base64)
                            <img src="{{ $base64 }}" style="max-width: 200px; max-height: 200px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px;">
                        @endif
                    @endforeach
                </div>
            @endif

            <p><strong>West:</strong> {{ $siteVisit->finding_west ?: 'N/A' }}</p>
            @if($siteVisit->photo_west && is_array($siteVisit->photo_west))
                <div style="margin-top: 10px; margin-bottom: 15px;">
                    @foreach($siteVisit->photo_west as $photo)
                        @php 
                            $path = storage_path('app/public/' . $photo); 
                            $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                        @endphp
                        @if($base64)
                            <img src="{{ $base64 }}" style="max-width: 200px; max-height: 200px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px;">
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <p><em>No Site Visit Report Recorded.</em></p>
    @endif

    <div class="page-break"></div>

    <!-- 4. Review & Recommendation -->
    <div class="header">
        <h1>Phase 2: Review & Recommendation</h1>
        <p>Ref: {{ $application->reference_no }}</p>
    </div>

    @php $review = $application->reviews->firstWhere('is_submitted', true); @endphp
    @if($review)
        <table class="data-table">
            <tr>
                <th>Recommending Officer</th>
                <td>{{ $review->officer->name }}</td>
            </tr>
            <tr>
                <th>Recommendation Date</th>
                <td>{{ $review->updated_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Selected Recommendation</th>
                <td>
                    @if($review->recommendation === 'SOKONG') <span class="badge badge-success">SOKONG</span>
                    @elseif($review->recommendation === 'BERSYARAT') <span class="badge badge-warning">BERSYARAT</span>
                    @else <span class="badge badge-danger">TIDAK SOKONG</span>
                    @endif
                </td>
            </tr>
        </table>

        <h4 style="color:#5a189a; margin-top:20px;">Detailed Review Analysis</h4>
        <div class="prose">
            {{ $review->review_content }}
        </div>
    @else
        <p><em>No Review Submitted.</em></p>
    @endif

    <div class="page-break"></div>

    <!-- 5. Verification -->
    <div class="header">
        <h1>Phase 3: Verification</h1>
        <p>Ref: {{ $application->reference_no }}</p>
    </div>

    @php $verification = $application->verifications->last(); @endphp
    @if($verification)
        <table class="data-table">
            <tr>
                <th>Verifying Assistant Director</th>
                <td>{{ $verification->assistantDirector->name }}</td>
            </tr>
            <tr>
                <th>Verification Date</th>
                <td>{{ $verification->created_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Decision</th>
                <td>
                    @if($verification->status === 'VERIFIED') <span class="badge badge-success">VERIFIED</span>
                    @else <span class="badge badge-danger">REJECTED</span>
                    @endif
                </td>
            </tr>
        </table>

        <h4 style="color:#5a189a; margin-top:20px;">Verification Remarks</h4>
        <div class="prose">
            {{ $verification->remarks ?? 'None provided.' }}
        </div>
    @else
        <p><em>No Verification Recorded.</em></p>
    @endif

    <p style="text-align: center; margin-top: 50px; font-size: 9pt; color: #999;">
        -- End of Official SVRMS Dossier --<br>
        Document uniquely generated by {{ config('app.name') }}
    </p>

</body>

</html>