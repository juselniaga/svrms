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
        .reference-block {
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: right;
            line-height: 1.05;
            font-size: 9pt;
            width: auto;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #5a189a;
            padding: 20px 0 15px 0;
            margin: 0 auto 20px auto;
            width: 100%;
            display: block;
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

        .findings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
            margin-bottom: 20px;
            width: 100%;
        }

        .finding-card {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 12px;
            background-color: #fff;
            page-break-inside: avoid;
            width: 100%;
            overflow: hidden;
        }

        .finding-card-header {
            background-color: #5a189a;
            color: white;
            padding: 8px;
            margin: -12px -12px 10px -12px;
            border-radius: 4px 4px 0 0;
            font-weight: bold;
            font-size: 10pt;
            text-transform: uppercase;
        }

        .finding-text {
            font-size: 10pt;
            line-height: 1.3;
            margin-bottom: 10px;
            color: #374151;
            min-height: 40px;
        }

        .photos-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 12px;
            margin-left: -12px;
            margin-right: -12px;
            margin-bottom: -12px;
            padding: 0;
            width: calc(100% + 24px);
            page-break-inside: avoid;
        }

        .photo-thumb {
            width: 100%;
            height: 300px;
            object-fit: contain;
            object-position: center;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            display: block;
            page-break-inside: avoid;
            background-color: #f9fafb;
        }
    </style>
</head>

<body>
    <div class="reference-block">
        <p><strong>MPJ-JPB-01-K02-P00-L2</strong></p>
        <p><strong>No.Pindaan : 02</strong></p>
    </div>
    
    <div class="header" style="clear: both;">
        <div style="text-align: center; margin-bottom: 15px; width: 100%;">
            <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('images/assets/logo_MPJ.svg'))) }}"
                 alt="Logo MPJ"
                 style="height: 80px; width: auto; display: inline-block;">
        </div>
        <h1 style="margin: 10px 0 5px 0;">Majlis Perbandaran Jasin</h1>
        <p style="margin: 3px 0;">Jabatan Perancang Bandar</p>
        <p style="margin: 3px 0;">Generated: {{ now()->format('d M Y, H:i') }}</p>
        <p style="margin: 3px 0;font-size: 14pt;font-weight: bold;font-color: #000;"><strong>Borang Lawatan Tapak</strong></p>
    </div>

    <!-- 1. Executive Summary / Final Decision -->
    <div class="section-title">1. Ringkasan</div>
    @php $approval = $application->approvals->last(); @endphp
    <table class="data-table">
        <tr>
            <th>No Permohonan</th>
            <td><strong>{{ $application->reference_no }}</strong></td>
        </tr>
        <tr>
            <th>Status Permohonan</th>
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
            <th>Disahkan Oleh</th>
            <td>{{ $approval ? $approval->director->name : 'N/A' }}</td>
        </tr>
        <tr>
            <th>Tarikh Disahkan</th>
            <td>{{ $approval ? $approval->created_at->format('d M Y, H:i') : 'N/A' }}</td>
        </tr>
        @if($approval && $approval->conditions)
            <tr>
                <th>Keadaan yang Dikenakan</th>
                <td>{{ $approval->conditions }}</td>
            </tr>
        @endif
        @if($approval && $approval->remarks)
            <tr>
                <th>Nota</th>
                <td>{{ $approval->remarks }}</td>
            </tr>
        @endif
    </table>

    <!-- 2. Maklumat Permohonan  -->
    <div class="section-title">2. Maklumat Permohonan</div>
    <table class="data-table">
        <tr>
            <th>Tajuk</th>
            <td>{{ $application->tajuk }}</td>
        </tr>
        <tr>
            <th>Lokasi</th>
            <td>{{ $application->lokasi }}</td>
        </tr>
        @if($application->site)
            <tr>
                <th>Maklumat Tanah Berdaftar</th>
                <td style="font-size: 10pt; line-height: 1.6;">
                    <strong>Mukim:</strong> {{ $application->site->mukim }}
                    @if($application->site->mukim_relation)
                        ({{ $application->site->mukim_relation->mukim }})
                    @endif
                    <br>
                    <strong>Lot:</strong> {{ $application->site->lot }} <br>
                    <strong>Area (Luas):</strong> {{ number_format($application->site->luas, 4) }} <br>
                    <strong>Category (Kategori):</strong> {{ $application->site->kategori_tanah ?? 'N/A' }} <br>
                    <strong>Land Status (Status Tanah):</strong> {{ $application->site->status_tanah ?? 'N/A' }} <br>
                    <strong>Map Sheet (Lembaran):</strong> {{ $application->site->lembaran ?? 'N/A' }} <br>
                    <strong>Block Perancang (BP):</strong>
                    @if($application->site->bp)
                        {{ $application->site->bp }}
                        @if($application->site->bp_relation)
                            ({{ $application->site->bp_relation->bp_name }})
                        @endif
                    @else
                        N/A
                    @endif
                    <br>
                    <strong>Block Perancang Kecil (BPK):</strong>
                    @if($application->site->bpk)
                        {{ $application->site->bpk }}
                        @if($application->site->bpk_relation)
                            ({{ $application->site->bpk_relation->bpk_name }})
                        @endif
                    @else
                        N/A
                    @endif
                    <br>
                    <strong>Coordinates (GPS):</strong> {{ $application->site->google_lat ?? 'N/A' }}, {{ $application->site->google_long ?? 'N/A' }}
                </td>
            </tr>
        @endif
        <tr>
            <th>Nama Pemohon</th>
            <td>{{ $application->developer->name }}</td>
        </tr>
        <tr>
            <th>Telefon / Emel</th>
            <td>{{ $application->developer->tel }} | {{ $application->developer->email }}</td>
        </tr>
    </table>

    <div class="page-break"></div>

    <!-- 3. Site Visit Report -->
    <div class="header">
        <h1>Fasa 1: Sisatan Tapak</h1>
        <p>No Permohonan: {{ $application->reference_no }}</p>
    </div>

    @php $siteVisit = $application->siteVisits->last(); @endphp
    @if($siteVisit)
        <table class="data-table">
            <tr>
                <th>pegawai pemeriksa</th>
                <td>{{ $siteVisit->officer->name }}</td>
            </tr>
            <tr>
                <th>Tarikh Lawatan</th>
                <td>{{ $siteVisit->visit_date->format('d M Y') }}</td>
            </tr>
            @if($siteVisit->location_data)
                <tr>
                    <th>Verifikasi Pengambilan GPS</th>
                    <td>{{ $siteVisit->location_data }}</td>
                </tr>
            @endif
        </table>

        <!-- Site Conditions & Infra -->
        <h4 style="color:#5a189a; margin-top:20px;">Keadaan Tapak & Infrastruktur</h4>
        <table class="data-table">
            <tr>
                <th style="width: 25%;">Aktiviti</th>
                <td style="width: 25%;">{{ $siteVisit->activity ?: 'N/A' }}</td>
                <th style="width: 25%;">Fasiliti</th>
                <td style="width: 25%;">{{ $siteVisit->facility ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Jalan Masuk</th>
                <td>{{ $siteVisit->entrance_way ?: 'N/A' }}</td>
                <th>Saluran (Parit)</th>
                <td>{{ $siteVisit->parit ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Pokok</th>
                <td>{{ $siteVisit->tree ?: 'N/A' }}</td>
                <th>Topografi</th>
                <td>{{ $siteVisit->topography ?: 'N/A' }}</td>
            </tr>
        </table>

        <!-- Verification & Others -->
        <h4 style="color:#5a189a; margin-top:20px;">Verifikasi & Lain-lain</h4>
        <table class="data-table">
            <tr>
                <th style="width: 25%;">Zon Guna Tanah (Land Use Zone)</th>
                <td style="width: 25%;">{{ $siteVisit->land_use_zone ?: 'N/A' }}</td>
                <th style="width: 25%;">Kepadatan</th>
                <td style="width: 25%;">{{ $siteVisit->density ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Cadangan Jalan</th>
                <td>{{ $siteVisit->recommend_road ? 'YES' : 'NO' }}</td>
                <th>Anjakan (Setback)</th>
                <td>{{ $siteVisit->anjakan ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Kemudahan Sosial</th>
                <td colspan="3">{{ $siteVisit->social_facility ?: 'N/A' }}</td>
            </tr>
        </table>

        <h4 style="color:#5a189a; margin-top:20px;">Directional Boundary Synthesis & Site Documentation</h4>
        <div class="findings-grid">
            <!-- North -->
            <div class="finding-card">
                <div class="finding-card-header">North</div>
                <div class="finding-text">{{ $siteVisit->finding_north ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photos_north && is_array($siteVisit->photos_north) && count($siteVisit->photos_north) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photos_north as $photo)
                            @if($loop->index < 2)
                                @php
                                    $path = storage_path('app/public/' . $photo);
                                    $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                                @endphp
                                @if($base64)
                                    <img src="{{ $base64 }}" class="photo-thumb" alt="Photo">
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if(count($siteVisit->photos_north) > 2)
                        <p style="font-size: 9pt; color: #999; margin-top: 5px; text-align: right;">+{{ count($siteVisit->photos_north) - 2 }} more photos</p>
                    @endif
                @endif
            </div>

            <!-- South -->
            <div class="finding-card">
                <div class="finding-card-header">South</div>
                <div class="finding-text">{{ $siteVisit->findings_south ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photos_south && is_array($siteVisit->photos_south) && count($siteVisit->photos_south) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photos_south as $photo)
                            @if($loop->index < 2)
                                @php
                                    $path = storage_path('app/public/' . $photo);
                                    $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                                @endphp
                                @if($base64)
                                    <img src="{{ $base64 }}" class="photo-thumb" alt="Photo">
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if(count($siteVisit->photos_south) > 2)
                        <p style="font-size: 9pt; color: #999; margin-top: 5px; text-align: right;">+{{ count($siteVisit->photos_south) - 2 }} more photos</p>
                    @endif
                @endif
            </div>

            <!-- East -->
            <div class="finding-card">
                <div class="finding-card-header">East</div>
                <div class="finding-text">{{ $siteVisit->findings_east ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photo_east && is_array($siteVisit->photo_east) && count($siteVisit->photo_east) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photo_east as $photo)
                            @if($loop->index < 2)
                                @php
                                    $path = storage_path('app/public/' . $photo);
                                    $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                                @endphp
                                @if($base64)
                                    <img src="{{ $base64 }}" class="photo-thumb" alt="Photo">
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if(count($siteVisit->photo_east) > 2)
                        <p style="font-size: 9pt; color: #999; margin-top: 5px; text-align: right;">+{{ count($siteVisit->photo_east) - 2 }} more photos</p>
                    @endif
                @endif
            </div>

            <!-- West -->
            <div class="finding-card">
                <div class="finding-card-header">West</div>
                <div class="finding-text">{{ $siteVisit->finding_west ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photo_west && is_array($siteVisit->photo_west) && count($siteVisit->photo_west) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photo_west as $photo)
                            @if($loop->index < 2)
                                @php
                                    $path = storage_path('app/public/' . $photo);
                                    $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                                @endphp
                                @if($base64)
                                    <img src="{{ $base64 }}" class="photo-thumb" alt="Photo">
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if(count($siteVisit->photo_west) > 2)
                        <p style="font-size: 9pt; color: #999; margin-top: 5px; text-align: right;">+{{ count($siteVisit->photo_west) - 2 }} more photos</p>
                    @endif
                @endif
            </div>

            <!-- Jalan (Road) -->
            <div class="finding-card">
                <div class="finding-card-header">Jalan (Road)</div>
                <div class="finding-text">{{ $siteVisit->finding_jalan ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photos_jalan && is_array($siteVisit->photos_jalan) && count($siteVisit->photos_jalan) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photos_jalan as $photo)
                            @if($loop->index < 2)
                                @php
                                    $path = storage_path('app/public/' . $photo);
                                    $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                                @endphp
                                @if($base64)
                                    <img src="{{ $base64 }}" class="photo-thumb" alt="Photo">
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if(count($siteVisit->photos_jalan) > 2)
                        <p style="font-size: 9pt; color: #999; margin-top: 5px; text-align: right;">+{{ count($siteVisit->photos_jalan) - 2 }} more photos</p>
                    @endif
                @endif
            </div>

            <!-- Location -->
            <div class="finding-card">
                <div class="finding-card-header">Lokasi (Location)</div>
                <div class="finding-text">{{ $siteVisit->finding_location ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photos_location && is_array($siteVisit->photos_location) && count($siteVisit->photos_location) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photos_location as $photo)
                            @if($loop->index < 2)
                                @php
                                    $path = storage_path('app/public/' . $photo);
                                    $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                                @endphp
                                @if($base64)
                                    <img src="{{ $base64 }}" class="photo-thumb" alt="Photo">
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if(count($siteVisit->photos_location) > 2)
                        <p style="font-size: 9pt; color: #999; margin-top: 5px; text-align: right;">+{{ count($siteVisit->photos_location) - 2 }} more photos</p>
                    @endif
                @endif
            </div>
        </div>
    @else
        <p><em>No Site Visit Report Recorded.</em></p>
    @endif

    <div class="page-break"></div>

    <!-- 4. Review & Recommendation -->
    <div class="header">
        <h1>Phase 2: cadangan dan ulasan Pegawai Penyiasat</h1>
        <p>Ref: {{ $application->reference_no }}</p>
    </div>

    @php $review = $application->reviews->firstWhere('self_check_completed', true); @endphp
    @if($review)
        <table class="data-table">
            <tr>
                <th>Cadangan Oleh</th>
                <td>{{ $review->officer->name }}</td>
            </tr>
            <tr>
                <th>Tarikh Cadangan</th>
                <td>{{ $review->updated_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Cadangan</th>
                <td>
                    @if($review->recommendation === 'SUPPORTED') <span class="badge badge-success">SOKONG</span>
                    {{-- @elseif($review->recommendation === 'BERSYARAT') <span class="badge badge-warning">BERSYARAT</span> --}}
                    @else <span class="badge badge-danger">TIDAK SOKONG</span>
                    @endif
                </td>
            </tr>
        </table>

        <h4 style="color:#5a189a; margin-top:20px;">Ulasan Detail</h4>
        <div class="prose">
            {{ $review->review_content }}
        </div>
    @else
        <p><em>No Review Submitted.</em></p>
    @endif

    <div class="page-break"></div>

    <!-- 5. Verification -->
    <div class="header">
        <h1>Phase 3: Penelitian Oleh Pen.Pengarah</h1>
        <p>Ref: {{ $application->reference_no }}</p>
    </div>

    @php $verification = $application->verifications->last(); @endphp
    @if($verification)
        <table class="data-table">
            <tr>
                <th>Peneliti</th>
                <td>{{ $verification->assistantDirector->name }}</td>
            </tr>
            <tr>
                <th>Tarikh Semakan</th>
                <td>{{ $verification->created_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Keputusan</th>
                <td>
                    @if($verification->verification_status === 'VERIFIED') <span class="badge badge-success">VERIFIED</span>
                    @else <span class="badge badge-danger">REJECTED</span>
                    @endif
                </td>
            </tr>
        </table>

        <h4 style="color:#5a189a; margin-top:20px;">Ulasan Semakan</h4>
        <div class="prose">
            {{ $verification->remarks ?? 'None provided.' }}
        </div>
    @else
        <p><em>No Verification Recorded.</em></p>
    @endif


     <!-- 6. Director's Approval -->
    <div class="header">
        <h1>Phase 4: Pengesahan Pengarah</h1>
        <p>Ref: {{ $application->reference_no }}</p>
    </div>

    @php $approval = $application->approvals->last(); @endphp
    @if($approval)
        <table class="data-table">
            <tr>
                <th>Pengarah yang Mengesahkan</th>
                <td>{{ $approval->director->name }}</td>
            </tr>
            <tr>
                <th>Tarikh Pengesahan</th>
                <td>{{ $approval->created_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Keputusan </th>
                <td>
                    @if($approval->approval_status === 'APPROVED') <span class="badge badge-success">APPROVED</span>
                    @else <span class="badge badge-danger">REJECTED</span>
                    @endif
                </td>
            </tr>
        </table>

        <h4 style="color:#5a189a; margin-top:20px;">Ulasan Pengesahan</h4>
        <div class="prose">
            {{ $approval->remarks ?? 'None provided.' }}
        </div>
    @else
        <p><em>No Approval Recorded.</em></p>
    @endif

    <p style="text-align: center; margin-top: 50px; font-size: 9pt; color: #999;">
        -- End of Official SVRMS Dossier --<br>
        Document uniquely generated by {{ config('app.name') }}
    </p>

</body>

</html>